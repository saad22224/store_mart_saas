@extends('admin.layout.default')
@section('content')
    @php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $isMerchant = Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1);
    @endphp
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">{{ trans('labels.add_new') }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark">
                    <a href="{{ URL::to('admin/currency-settings') }}" class="color-changer">{{ trans('labels.currency-settings') }}</a>
                </li>
                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.add') }}</li>
            </ol>
        </nav>
    </div>

    <div class="row mt-3">
        <div class="col-12 col-lg-8">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form action="{{ URL::to('admin/currency-settings/store') }}" method="POST">
                        @csrf
                        @if ($isMerchant)
                            <p class="text-muted mb-3">أدخل اسم العملة ورمزها ورمز العرض فقط. لن يتم تحويل أسعار المنتجات.</p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">{{ trans('labels.currency_name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        placeholder="Syrian Pound" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ trans('labels.currency_code') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="code" class="form-control" value="{{ old('code') }}"
                                        placeholder="SYP" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">{{ trans('labels.currency_symbol_label') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="currency_symbol" class="form-control"
                                        value="{{ old('currency_symbol') }}" placeholder="ل.س" required>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="hidden" name="name" id="currency_name">
                                    <label for="code" class="col-form-label">{{ trans('labels.code') }} <span class="text-danger">*</span></label>
                                    <select name="code" class="form-select code-dropdown" id="code" required>
                                        <option value="" selected>{{ trans('labels.select') }}</option>
                                        @foreach ($currencys as $currency)
                                            <option value="{{ $currency->code }}"
                                                {{ old('code') == $currency->code ? 'selected' : '' }}
                                                data-currency-name="{{ $currency->currency }}">{{ $currency->currency }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="currency_symbol" class="col-form-label">{{ trans('labels.currency_symbol') }}
                                        <span class="text-danger">*</span></label>
                                    <select name="currency_symbol" class="form-select currency_symbol-dropdown"
                                        id="currency_symbol" required>
                                        <option value="" selected>{{ trans('labels.select') }}</option>
                                        @foreach ($currencys as $currency)
                                            <option value="{{ $currency->currency_symbol }}"
                                                {{ old('currency_symbol') == $currency->currency_symbol ? 'selected' : '' }}>
                                                {{ $currency->currency_symbol }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">{{ trans('labels.exchange_rate') }}</label>
                                    <input type="text" class="form-control" name="exchange_rate" value="{{ old('exchange_rate', 1) }}"
                                        placeholder="1">
                                </div>
                                <div class="form-group col-sm-3">
                                    <p class="form-label">{{ trans('labels.currency_position') }}</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="currency_position" value="1" checked />
                                        <label class="form-check-label">{{ trans('labels.left') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="currency_position" value="2" />
                                        <label class="form-check-label">{{ trans('labels.right') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <p class="form-label">{{ trans('labels.currency_space') }}</p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="currency_space" value="1" />
                                        <label class="form-check-label">{{ trans('labels.yes') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="currency_space" value="2" checked />
                                        <label class="form-check-label">{{ trans('labels.no') }}</label>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form-label">{{ trans('labels.currency_formate') }}</label>
                                    <input type="text" class="form-control" name="currency_formate" value="1">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="form-label">{{ trans('labels.decimal_separator') }}</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="decimal_separator" value="1" checked />
                                        <label class="form-check-label">.</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="decimal_separator" value="2" />
                                        <label class="form-check-label">,</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ URL::to('admin/currency-settings') }}" class="btn btn-outline-secondary">{{ trans('labels.cancel') ?? 'Cancel' }}</a>
                            <button type="submit" class="btn btn-primary px-4">{{ trans('labels.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
