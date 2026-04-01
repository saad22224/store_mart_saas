<?php

namespace App\Http\Controllers\addons;

use App\Helpers\helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\Settings;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Two\FacebookProvider;

class FacebookLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //  admin side settings

    public function facebookloginsettings(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settings = Settings::where('vendor_id', $vendor_id)->first();
        $settings->facebook_client_id = $request->facebook_client_id;
        $settings->facebook_client_secret = $request->facebook_client_secret;
        $settings->facebook_redirect_url = $request->facebook_redirect_url;
        $settings->facebook_mode = isset($request->facebook_mode) ? 1 : 2;
        $settings->save();
        return redirect('/admin/settings')->with('success', trans('messages.success'));
    }


    // facebook login
    public function redirectToFacebook(Request $request)
    {

        $storeinfo = helper::storeinfo($request->vendor_slug);
        session()->put('slug', $storeinfo->slug);
        session()->put('id', $storeinfo->id);
        if ($request->type == "user") {
            session()->put('logintype', 'user');
            $facebook = $this->configDriver($request->type, 'facebook', $storeinfo->id);
        }
        if ($request->type == "vendor") {
            $facebook = $this->configDriver($request->type, 'facebook', $storeinfo->id);
            session()->put('logintype', 'vendor');
        }
        return $facebook->redirect();
    }
    private function configDriver($type, $login_type, $id)
    {


        if ($login_type == "facebook") {
            if ($type == "vendor") {

                $config['client_id'] = helper::appdata('')->facebook_client_id;
                $config['client_secret'] = helper::appdata('')->facebook_client_secret;
                $config['redirect'] = helper::appdata('')->facebook_redirect_url;
            }
            if ($type == "user") {
                $user = User::where('id', $id)->first();
                $config['client_id'] = helper::appdata($user->id)->facebook_client_id;
                $config['client_secret'] = helper::appdata($user->id)->facebook_client_secret;
                $config['redirect'] = helper::appdata($user->id)->facebook_redirect_url;
            }
            return Socialite::buildProvider(FacebookProvider::class, $config);
        }
    }

    public function check_login(Request $request)
    {
        $vendor = User::where('id', session()->get('id'))->where('is_available', 1)->where('is_deleted', 2)->first();
        try {

            if (session()->get('logintype') == "user") {


                if ($request->logintype == "facebook") {
                    if (!$request->has('code') || $request->has('denied')) {
                        return redirect('/' . session()->get('slug') . '/login');
                    }

                    $facebookuserdata = $this->configDriver('user', 'facebook', session()->get('id'))->stateless()->user();

                    $checkuser = User::where('email', '=', $facebookuserdata->email)->where('type', '3')->where('facebook_id', $facebookuserdata->id)->first();
                    session()->put('user_login', 1);
                    if (!empty($checkuser)) {
                        Auth::login($checkuser);
                        if (Auth::user()->type == 3) {
                            if (Auth::user()->is_available == 1) {
                                return redirect('/' . session()->get('slug'))->with('sucess', trans('messages.success'));
                            } else {
                                Auth::logout();
                                return redirect()->back()->with('error', trans('messages.block'));
                            }
                        } else {
                            Auth::logout();
                            return redirect('/' . session()->get('slug') . '/login')->with('error', trans('messages.email_password_not_match'));
                        }
                    } else {
                        $checkemail = User::where('email', $facebookuserdata->email)->first();
                        if ($facebookuserdata->email != null) {
                            if (!empty($checkemail)) {
                                return redirect('/' . session()->get('slug') . '/login')->with('error', trans('messages.unique_email'));
                            }
                        }
                        $newuser = new User();
                        $newuser->name = $facebookuserdata->name;
                        $newuser->email = $facebookuserdata->email;
                        $newuser->facebook_id = $facebookuserdata->id;
                        $newuser->type = "3";
                        $newuser->vendor_id = $vendor->id;
                        $newuser->login_type = "facebook";
                        $newuser->image = "default.png";
                        $newuser->is_available = "1";
                        $newuser->is_verified = "1";
                        $newuser->save();
                        session()->put('user_login', 1);
                        Auth::login($newuser);
                        if (Auth::user()->type == 3) {
                            if (Auth::user()->is_available == 1) {
                                return redirect('/' . session()->get('slug'))->with('sucess', trans('messages.success'));
                            } else {
                                Auth::logout();
                                return redirect()->back()->with('error', trans('messages.block'));
                            }
                        } else {
                            Auth::logout();
                            return redirect('/' . session()->get('slug') . '/login')->with('error', trans('messages.email_password_not_match'));
                        }
                    }
                }
            }

            if (session()->get('logintype') == "vendor") {

                if ($request->logintype == "facebook") {
                    if (!$request->has('code') || $request->has('denied')) {
                        return redirect('/admin');
                    }
                    $facebookuserdata =  $this->configDriver('vendor', 'facebook', session()->get('id'))->stateless()->user();
                    $checkuser = User::where('email', '=', $facebookuserdata->email)->where('type', '2')->where('facebook_id', $facebookuserdata->id)->first();
                    session()->put('user_login', 1);
                    if (!empty($checkuser)) {
                        Auth::login($checkuser);
                        if (Auth::user()->type == 2) {
                            if (Auth::user()->is_available == 1) {
                                return redirect('/admin/dashboard');
                            } else {
                                Auth::logout();
                                return redirect('/admin')->with('error', trans('messages.block'));
                            }
                        } else {
                            Auth::logout();
                            return redirect('/admin')->with('error', trans('messages.email_password_not_match'));
                        }
                    } else {
                        $checkemail = User::where('email', $facebookuserdata->email)->first();
                        $checkmobile = User::where('mobile', $facebookuserdata->mobile)->first();
                        if ($facebookuserdata->email != null) {
                            if (!empty($checkemail)) {
                                return redirect('/admin')->with('error', trans('messages.unique_email'));
                            }
                        }
                        if ($facebookuserdata->mobile != null) {
                            if (!empty($checkmobile)) {
                                return redirect('/admin')->with('error', trans('messages.unique_mobile'));
                            }
                        }
                        $data = helper::vendor_register($facebookuserdata->name, $facebookuserdata->email, '', '', '', '', '', $facebookuserdata->id, '', '', '', '');
                        $newuser = User::select('id', 'name', 'email', 'mobile', 'image')->where('id', $data)->first();
                        Auth::login($newuser);
                        return redirect('admin/dashboard')->with('success', trans('messages.success'));
                    }
                }
            }
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    // api=========================================================
    // vendor app
    public function socialfacebooklogin_vendor(Request $request)
    {
        if ($request->name == "") {
            return response()->json(["status" => 0, "message" => trans('messages.name_required')], 200);
        }


        if ($request->facebook_id != "") {
            $checkuser = User::where('email', '=', $request->email)->where('type', '2')->where('facebook_id', $request->facebook_id)->first();
            if (!empty($checkuser)) {
                if ($checkuser->is_available == '1') {
                    $checkuser->token = $request->token;
                    $checkuser->save();
                    $checkuser = $checkuser::select('id', 'name', 'email', 'mobile', 'image', 'login_type')->where('id', $checkuser->id)->first();
                    $checkuser->image = helper::image_path($checkuser->image);
                    return response()->json(['status' => 1, 'message' => trans('messages.success'), 'data' => $checkuser], 200);
                } else {
                    return response()->json(['status' => 0, 'message' => trans('messages.blocked')], 200);
                }
            } else {
                $checkemail = User::where('email', $request->email)->first();
                if (!empty($checkemail)) {
                    return response()->json(['status' => 0, 'message' => trans('messages.unique_email')], 200);
                }
                $data = helper::vendor_register($request->name, $request->email, $request->mobile, '', $request->token, '', '', $request->facebook_id, '', '', '', '');
                if (!empty($data)) {
                    $newuser = User::select('id', 'name', 'email', 'mobile', 'image', 'login_type')->where('id', $data)->first();
                    $newuser->image = helper::image_path($newuser->image);

                    return response()->json(['status' => 1, 'message' => trans('messages.success'), 'data' => $newuser], 200);
                } else {
                    return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
                }
            }
        }
    }
    // user app
    public function facebookloginuser(Request $request)
    {

        if ($request->name == "") {
            return response()->json(["status" => 0, "message" => trans('messages.name_required')], 200);
        }


        if ($request->facebook_id != "") {
            $checkuser = User::where('email', '=', $request->email)->where('type', '3')->where('facebook_id', $request->facebook_id)->first();
            if (!empty($checkuser)) {
                if ($checkuser->is_available == '1') {
                    $checkuser->token = $request->token;
                    $checkuser->save();
                    $checkuser = $checkuser::select('id', 'name', 'email', 'mobile', 'image', 'login_type')->where('id', $checkuser->id)->first();
                    $checkuser->image = helper::image_path($checkuser->image);
                    return response()->json(['status' => 1, 'message' => trans('messages.success'), 'data' => $checkuser], 200);
                } else {
                    return response()->json(['status' => 0, 'message' => trans('messages.blocked')], 200);
                }
            } else {
                $checkemail = User::where('email', $request->email)->first();
                if (!empty($checkemail)) {
                    return response()->json(['status' => 0, 'message' => trans('messages.unique_email')], 200);
                }
                $data = new User();
                $otp = rand(111111, 999999);
                $data->name = $request->name;
                $data->email = $request->email;
                $data->password = '';
                $data->google_id = '';
                $data->facebook_id = $request->facebook_id;
                $data->mobile = $request->mobile;
                $data->login_type = 'facebook';
                $data->type = 3;
                $data->image = "default.png";
                $data->token = $request->token;
                $data->slug = '';
                $data->is_available = "1";
                $data->is_verified = "1";
                $data->otp = $otp;
                $data->country_id = '';
                $data->city_id = '';
                $data->save();

                if (!empty($data)) {
                    $newuser = User::select('id', 'name', 'email', 'mobile', 'image', 'login_type')->where('id', $data->id)->first();
                    $newuser->image = helper::image_path($newuser->image);

                    return response()->json(['status' => 1, 'message' => trans('messages.success'), 'data' => $newuser], 200);
                } else {
                    return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
                }
            }
        }
    }
}
