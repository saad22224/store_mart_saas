<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\helper;
use App\Models\Category;
use App\Models\Tax;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportProduct;
use App\Exports\ExportProduct;
use PDF;

class ImportController extends Controller
{
    public function import()
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $checkplan = helper::checkplan($vendor_id, '');
        $v = json_decode(json_encode($checkplan));
        if (@$v->original->status == 2) {
            return redirect('admin/products')->with('error', @$v->original->message);
        }
        return view('admin.import.import');
    }
    public function generatepdf()
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $categorylist = Category::where('is_available', 1)->where('is_deleted', 2)->where('vendor_id',$vendor_id )->orderBy('reorder_id')->get();
        $pdf = PDF::loadView('admin.product.categorylist', ['categorylist' => $categorylist]);
        return $pdf->download('category.pdf');
    }
    public function generatetaxpdf()
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $taxlist = Tax::where('is_available', 1)->where('is_deleted', 2)->where('vendor_id',$vendor_id )->orderBy('reorder_id')->get();
        $pdf = PDF::loadView('admin.product.taxlist', ['taxlist' => $taxlist]);
        return $pdf->download('taxlist.pdf');
    }
    public function importproduct(Request $request)
    {
        try {
            Excel::import(new ImportProduct(), $request->file('importfile')->store('files'));
            return redirect('/admin/products')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect('/admin/products')->with('error', trans('messages.wrong'));
        }
    }
    public function exportproduct(Request $request){
        return Excel::download(new ExportProduct, 'Products.xlsx');
    }
}
