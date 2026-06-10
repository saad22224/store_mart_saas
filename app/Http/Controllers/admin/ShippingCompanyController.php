<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShippingCompanyRequest;
use App\Http\Requests\Admin\VendorShippingCompanyRequest;
use App\Models\ShippingCompany;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ShippingCompanyController extends Controller
{
    public function index()
    {
        $shippingCompanies = ShippingCompany::latest()->get();

        return view('admin.shipping_companies.index', compact('shippingCompanies'));
    }

    public function add()
    {
        return view('admin.shipping_companies.add');
    }

    public function save(ShippingCompanyRequest $request)
    {
        ShippingCompany::create($this->validatedData($request));

        return redirect('admin/shipping-companies')->with('success', trans('messages.success'));
    }

    public function edit($id)
    {
        $shippingCompany = ShippingCompany::findOrFail($id);

        return view('admin.shipping_companies.edit', compact('shippingCompany'));
    }

    public function update(ShippingCompanyRequest $request, $id)
    {
        $shippingCompany = ShippingCompany::findOrFail($id);
        $shippingCompany->update($this->validatedData($request));

        return redirect('admin/shipping-companies')->with('success', trans('messages.success'));
    }

    public function change_status($id, $status)
    {
        ShippingCompany::where('id', $id)->update(['is_active' => (int) $status === 1]);

        return redirect('admin/shipping-companies')->with('success', trans('messages.success'));
    }

    public function delete($id)
    {
        ShippingCompany::findOrFail($id)->delete();

        return redirect('admin/shipping-companies')->with('success', trans('messages.success'));
    }

    public function vendorSettings()
    {
        $vendor = $this->currentVendor();
        $shippingCompanies = ShippingCompany::active()->orderBy('name')->get();
        $selectedShippingCompanyId = $vendor->shippingCompanies()->value('shipping_companies.id');

        return view('admin.shipping_companies.vendor_settings', compact('shippingCompanies', 'selectedShippingCompanyId'));
    }

    public function saveVendorSettings(VendorShippingCompanyRequest $request)
    {
        $vendor = $this->currentVendor();
        $vendor->shippingCompanies()->sync([$request->validated()['shipping_company_id']]);

        return redirect('admin/my-shipping-companies')->with('success', trans('messages.success'));
    }

    private function validatedData(ShippingCompanyRequest $request): array
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function currentVendor()
    {
        return Auth::user()->type == 4
            ? User::findOrFail(Auth::user()->vendor_id)
            : Auth::user();
    }
}
