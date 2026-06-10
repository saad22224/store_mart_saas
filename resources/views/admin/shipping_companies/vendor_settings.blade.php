@extends('admin.layout.default')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">شركة الشحن الخاصة بمتجري</h5>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="{{ URL::to('admin/my-shipping-companies/save') }}" method="POST">
                        @csrf
                        <div class="row">
                            @forelse ($shippingCompanies as $shippingCompany)
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <label class="border rounded p-3 w-100 h-100">
                                        <div class="d-flex align-items-start gap-2">
                                            <input class="form-check-input mt-1" type="radio" name="shipping_company_id"
                                                value="{{ $shippingCompany->id }}"
                                                {{ (int) old('shipping_company_id', $selectedShippingCompanyId) === (int) $shippingCompany->id ? 'checked' : '' }}
                                                required>
                                            <div>
                                                <div class="fw-600 text-dark">{{ $shippingCompany->name }}</div>
                                                <div class="text-muted fs-7">{{ $shippingCompany->delivery_duration }}</div>
                                                <div class="text-muted fs-7">{{ $shippingCompany->whatsapp_number }}</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            @empty
                                <div class="col-12">
                                    @include('admin.layout.no_data')
                                </div>
                            @endforelse
                        </div>
                        @error('shipping_company_id') <div class="text-danger fs-7">{{ $message }}</div> @enderror

                        <div class="mt-3 {{ session()->get('direction') == '2' ? 'text-start' : 'text-end' }}">
                            <button class="btn btn-primary px-sm-4" @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
