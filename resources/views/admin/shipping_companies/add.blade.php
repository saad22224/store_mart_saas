@extends('admin.layout.default')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">{{ trans('labels.add_new') }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a href="{{ URL::to('admin/shipping-companies') }}" class="color-changer">شركات الشحن</a></li>
                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}" aria-current="page">{{ trans('labels.add') }}</li>
            </ol>
        </nav>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    @include('admin.shipping_companies.form', [
                        'action' => URL::to('admin/shipping-companies/save'),
                        'shippingCompany' => null,
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection
