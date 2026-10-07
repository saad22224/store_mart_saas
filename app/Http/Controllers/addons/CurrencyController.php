<?php

namespace App\Http\Controllers\addons;

use App\Helpers\helper;
use App\Http\Controllers\Controller;
use App\Models\Currencies;
use App\Models\CurrencySettings;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class CurrencyController extends Controller
{
    public function add(Request $request)
    {
        $currencys = Currencies::get();
        return view('admin.currency_settings.add', compact('currencys'));
    }
    public function store(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $isMerchant = Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1);

        if ($isMerchant) {
            $request->validate([
                'name' => 'required|string|max:100',
                'code' => 'required|string|max:20',
                'currency_symbol' => 'required|string|max:20',
            ]);
            $code = strtolower(trim($request->code));
            if (CurrencySettings::whereRaw('LOWER(code) = ?', [$code])->exists()) {
                return redirect()->back()->with('error', trans('messages.unique_currency') ?? 'Currency already exists')->withInput();
            }
            $currency = new CurrencySettings();
            $currency->code = $code;
            $currency->name = trim($request->name);
            $currency->currency = trim($request->currency_symbol);
            $currency->exchange_rate = 1; // kept for schema compatibility; unused in storefront
            $currency->currency_position = '2';
            $currency->currency_space = 1;
            $currency->currency_formate = 1;
            $currency->decimal_separator = 1;
            $currency->is_available = 1;
            $currency->save();

            // Make newly added currency selectable; do not auto-activate.
            $settingdata = Settings::where('vendor_id', $vendor_id)->first();
            if ($settingdata) {
                $codes = array_filter(explode('|', (string) $settingdata->currencies));
                $codesLower = array_map('strtolower', $codes);
                if (! in_array($code, $codesLower, true)) {
                    $codes[] = $code;
                    $settingdata->currencies = implode('|', $codes);
                    $settingdata->save();
                }
            }

            return redirect('admin/currency-settings/')->with('success', trans('messages.success'));
        }

        $currency = new CurrencySettings();
        $currency->code = $request->code;
        $currency->name = $request->name;
        $currency->currency = $request->currency_symbol;
        $currency->exchange_rate = $request->exchange_rate ?? 1;
        $currency->currency_position = $request->currency_position ?? 1;
        $currency->currency_space = $request->currency_space ?? 2;
        $currency->currency_formate = $request->currency_formate ?? 1;
        $currency->decimal_separator = $request->decimal_separator ?? 1;
        $currency->is_available = 1;
        $currency->save();
        return redirect('admin/currency-settings/')->with('success', trans('messages.success'));
    }
    public function delete(Request $request)
    {
        try {
            $currency = CurrencySettings::find($request->id);
            $getdefault = Settings::get();
            $setactive = CurrencySettings::where('code', 'usd')->first();
            $setactive->is_available = 1;
            $setactive->update();
            foreach ($getdefault as $default) {
                $code = explode('|', $default->currencies);
                $key = array_search($currency->code, $code);
                if ($key !== false) {
                    unset($code[$key]);
                }
                Settings::where('vendor_id', $default->vendor_id)->update(array('currencies' => implode('|', $code)));
                Settings::where('default_currency', $currency->code)->update(array('default_currency' => "usd"));
                $currency->delete();
            }
            return redirect('admin/currency-settings')->with('success', trans('messages.success'))->withCookie(cookie()->forget('code'));
        } catch (\Throwable $th) {
            return redirect('admin/currency-settings')->with('error', trans('messages.wrong'));
        }
    }
    public function bulk_delete(Request $request)
    {
        try {
            foreach ($request->id as $id) {
                $currency = CurrencySettings::find($id);
                $getdefault = Settings::get();
                $setactive = CurrencySettings::where('code', 'usd')->first();
                $setactive->is_available = 1;
                $setactive->update();
                foreach ($getdefault as $default) {
                    $code = explode('|', $default->currencies);
                    $key = array_search($currency->code, $code);
                    if ($key !== false) {
                        unset($code[$key]);
                    }
                    Settings::where('vendor_id', $default->vendor_id)->update(array('currencies' => implode('|', $code)));
                    Settings::where('default_currency', $currency->code)->update(array('default_currency' => "usd"));
                    $currency->delete();
                }
            }
            return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => trans('messages.error')], 200);
        }
    }

    public function changestatus(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        if ($request->code == helper::appdata($vendor_id)->default_currency) {
            return redirect()->back()->with('error', trans('messages.remove_default_currency'));
        } else {
            if ($request->status == 2) {
                $getdefault = Settings::get();
                foreach ($getdefault as $default) {
                    $code = explode('|', $default->currencies);
                    $key = array_search($request->code, $code);
                    if ($key !== false) {
                        unset($code[$key]);
                    }
                    Settings::where('vendor_id', $default->vendor_id)->update(array('currencies' => implode('|', $code)));
                    Settings::where('default_currency', $request->code)->update(array('default_currency' => "usd"));
                }
            }
            CurrencySettings::where('code', $request->code)->update(['is_available' => $request->status]);
            return redirect('admin/currency-settings')->with('success', trans('messages.success'));
        }
    }

    public function currency_setting_status(Request $request)
    {

        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $settingdata = Settings::where('vendor_id', $vendor_id)->first();
        if ($request->status == 2) {
            $code = explode('|', helper::appdata($vendor_id)->currencies);

            if (count($code) == 1) {
                return redirect()->back()->with('error', trans('messages.currency_required_msg'));
            }
            if ($request->code == helper::appdata($vendor_id)->default_currency) {
                return redirect()->back()->with('error', trans('messages.remove_default_currency'));
            }
            $key = array_search($request->code, $code);
            if ($key !== false) {
                unset($code[$key]);
                $settingdata->currencies = implode('|', $code);
            }
        }
        if ($request->status == 1) {
            if (helper::appdata($vendor_id)->currencies != "") {
                $code = explode('|', helper::appdata($vendor_id)->currencies);
                array_push($code, $request->code);
                $settingdata->currencies = implode('|', $code);
            } else {
                $settingdata->currencies = $request->code;
            }
        }
        $settingdata->update();
        return redirect('admin/currency-settings')->with('success', trans('messages.success'));
    }

    public function setdefault(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingdata = Settings::where('vendor_id', $vendor_id)->first();
        $code = strtolower(trim((string) $request->code));
        $currency = CurrencySettings::whereRaw('LOWER(code) = ?', [$code])->first();
        if (! $currency || (int) $currency->is_available === 2) {
            return redirect()->back()->with('error', trans('messages.not_available_currency'));
        }

        // Single active currency source of truth.
        $settingdata->default_currency = $currency->code;

        $codes = array_values(array_filter(explode('|', (string) $settingdata->currencies)));
        $codesLower = array_map('strtolower', $codes);
        if (! in_array(strtolower($currency->code), $codesLower, true)) {
            $codes[] = $currency->code;
        }
        $settingdata->currencies = implode('|', $codes);
        $settingdata->update();

        session()->put('currency', $currency->currency);

        return redirect()->back()->with('success', trans('messages.success'))
            ->withCookie(cookie('code', $currency->code, 60 * 24 * 365));
    }



    //-------------------------------------------- Currencies Add Edit Delete Start -----------------------------------------------//

    public function currency_data(Request $request)
    {
        $getcurrency = Currencies::get();
        return view('admin.currency_settings.currencys.index', compact('getcurrency'));
    }
    public function currency_add(Request $request)
    {
        return view('admin.currency_settings.currencys.add');
    }
    public function currency_store(Request $request)
    {
        $validator = Validator::make(['currency' => $request->currency], [
            'currency' => 'required|unique:currencies',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', trans('messages.unique_currency'));
        }
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $currency = new Currencies();
        $currency->currency = $request->currency;
        $slug = Str::slug($request->currency);
        $currency->code = $slug;
        $currency->currency_symbol = $request->currency_symbol;
        $currency->save();
        return redirect('admin/currencys/')->with('success', trans('messages.success'));
    }

    public function currency_edit(Request $request)
    {

        $editcurrency = Currencies::where('id', $request->id)->first();
        return view('admin.currency_settings.currencys.edit', compact("editcurrency"));
    }

    public function currency_update(Request $request, $id)
    {
        try {
            $currency = Currencies::where('id', $id)->first();
            $currency->currency = $request->currency;
            $slug = Str::slug($request->currency);
            $currency->code = $slug;
            $currency->currency_symbol = $request->currency_symbol;
            $currency->update();
            return redirect('admin/currencys')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect('admin/currencys')->with('error', trans('messages.wrong'));
        }
    }
    public function currency_delete(Request $request)
    {
        try {
            $currency = Currencies::find($request->id);

            $currency->delete();
            return redirect('admin/currencys')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect('admin/currencys')->with('error', trans('messages.wrong'));
        }
    }
    public function currencystatus(Request $request)
    {
        $currency = Currencies::where('code', $request->code)->first();
        if ($request->status == 2) {
            if ($request->code == 'usd') {
                $currency->is_available = 1;
            } else {
                $currency->is_available = $request->status;
            }
        }
        if ($request->status == 1) {
            $currency->is_available = $request->status;
        }
        $currency->update();


        return redirect('admin/currencys')->with('success', trans('messages.success'));
    }
    public function currency_bulk_delete(Request $request)
    {
        try {
            foreach ($request->id as $id) {
                $currency = Currencies::find($id);
                $currency->delete();
            }
            return response()->json(['status' => 1, 'msg' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => trans('messages.error')], 200);
        }
    }
    //-------------------------------------------- Currencies Add Edit Delete End -----------------------------------------------//

    public function change(Request $request)
    {
        $currency = CurrencySettings::where('code', $request->currency)->first();
        session()->put('currency', $currency->currency);
        
        if (Auth::check() && in_array(Auth::user()->type, [1, 2, 4])) {
            $vendor_id = (Auth::user()->type == 4) ? Auth::user()->vendor_id : Auth::user()->id;
            $settingdata = Settings::where('vendor_id', $vendor_id)->first();
            if ($settingdata) {
                $settingdata->default_currency = $request->currency;
                $settingdata->save();
            }
        }

        return redirect()->back()->withCookie(cookie('code', $currency->code, 60 * 24 * 365));
    }
}
