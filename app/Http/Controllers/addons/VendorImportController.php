<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\ExportVendor;
use App\Models\City;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportVendor;
use PDF;

class VendorImportController extends Controller
{
    public function index()
    {
        return view('admin.import_vendor.import');
    }


    public function generatepdf()
    {
        try {

            $cities = City::join('country', 'city.country_id', '=', 'country.id')
                ->select('city.*', 'country.name as country_name', 'country.id as country_id')
                ->get();

            $pdf = PDF::loadView('admin.import_vendor.citieslist', ['citieslist' => $cities]);

            return $pdf->download('cities.pdf');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to generate PDF.'], 200);
        }
    }

    public function import(Request $request)
    {
        try {
            Excel::import(new ImportVendor(), $request->file('importfile')->store('files'));
            return redirect('/admin/users')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            dd($th);
            return redirect('/admin/users')->with('error', trans('messages.wrong'));
        }
    }

    public function exportvendor(Request $request)
    {
        return Excel::download(new ExportVendor, 'vendors.xlsx');
    }
}
