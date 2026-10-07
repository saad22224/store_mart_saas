@extends('admin.layout.default')
@section('content')
    @php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $isMerchant = Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1);
        $activeCode = strtolower((string) (helper::appdata($vendor_id)->default_currency ?? ''));
        helper::ensure_base_currencies();
        if ($isMerchant) {
            $getcurrency = \App\Models\CurrencySettings::where('is_available', 1)
                ->orderByRaw("CASE WHEN LOWER(code)='syp' THEN 0 WHEN LOWER(code)='usd' THEN 1 ELSE 2 END")
                ->orderBy('name')
                ->get()
                ->unique(function ($row) {
                    return strtolower((string) $row->code);
                })
                ->values();
        }
    @endphp

    @if ($isMerchant)
        {{-- Simplified merchant currency manager --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="text-capitalize fw-600 text-dark color-changer fs-4 mb-1">{{ trans('labels.currency-settings') }}</h5>
                <p class="text-muted mb-0 small">اختر عملة واحدة فقط لعرض الأسعار في متجرك. لا يتم تحويل الأسعار تلقائياً.</p>
            </div>
            <a href="{{ URL::to('admin/currency-settings/add') }}"
                class="btn btn-secondary px-sm-4 d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_currency_settings', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">
                <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}
            </a>
        </div>

        <div class="row mt-3 g-3">
            @foreach ($getcurrency as $currency)
                @php $isActive = $activeCode === strtolower((string) $currency->code); @endphp
                <div class="col-md-6 col-xl-4">
                    <div class="card border-0 box-shadow h-100 {{ $isActive ? 'border border-success' : '' }}">
                        <div class="card-body d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <div>
                                    <h5 class="mb-1 fw-700 color-changer">{{ $currency->name }}</h5>
                                    <div class="text-muted small">{{ strtoupper($currency->code) }} · {{ $currency->currency }}</div>
                                </div>
                                @if ($isActive)
                                    <span class="badge bg-success px-3 py-2">{{ trans('labels.active_currency') }}</span>
                                @endif
                            </div>
                            <div class="mt-auto pt-2">
                                @if ($isActive)
                                    <button type="button" class="btn btn-outline-success w-100" disabled>
                                        {{ trans('labels.active_currency') }}
                                    </button>
                                @else
                                    <a href="javascript:void(0)"
                                        @if (env('Environment') == 'sendbox') onclick="myFunction()"
                                        @else onclick="statusupdate('{{ URL::to('admin/currency-settings/setdefault-' . $currency->code . '/1') }}')" @endif
                                        class="btn btn-dark w-100 {{ Auth::user()->type == 4 ? (helper::check_access('role_currency_settings', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">
                                        {{ trans('labels.activate_currency') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Keep existing admin table UI --}}
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">{{ trans('labels.currency-settings') }}</h5>
            <div class="d-flex align-items-center" style="gap: 10px;">
                @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                    @if (@helper::checkaddons('bulk_delete'))
                        <button id="bulkDeleteBtn"
                            @if (env('Environment')=='sendbox' ) onclick="myFunction()" @else onclick="deleteSelected('{{ URL::to('admin/currency-settings/bulk_delete') }}')" @endif class="btn btn-danger hov btn-sm d-none d-flex" tooltip="{{ trans('labels.delete') }}">
                            <i class="fa-regular fa-trash"></i>
                        </button>
                    @endif
                @endif
                @if (helper::checkaddons('currency_settigns'))
                    <a href="{{ URL::to('admin/currency-settings/add') }}"
                        class="btn btn-secondary px-sm-4 d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_currency_settings', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">
                        <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}
                    </a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border-0 my-3 box-shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                                <thead>
                                    <tr class="text-capitalize fw-500 fs-15">
                                        <td></td>
                                        @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                                            @if (@helper::checkaddons('bulk_delete'))
                                                @if($getcurrency->count() > 0)
                                                    <td> <input type="checkbox" id="selectAll" class="form-check-input checkbox-style"></td>
                                                @endif
                                            @endif
                                        @endif
                                        <td>{{ trans('labels.srno') }}</td>
                                        <td>{{ trans('labels.name') }}</td>
                                        <td>{{ trans('labels.currency') }}</td>
                                        <td>{{ trans('labels.status') }}</td>
                                        <td>{{ trans('labels.is_default') }}</td>
                                        <td>{{ trans('labels.created_date') }}</td>
                                        <td>{{ trans('labels.updated_date') }}</td>
                                        @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                                            <td>{{ trans('labels.action') }}</td>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody id="tabledetails" data-url="">
                                    @php $i = 1; @endphp
                                    @foreach ($getcurrency as $currency)
                                        <tr class="fs-7 row1 align-middle" id="dataid{{ $currency->id }}" data-id="{{ $currency->id }}">
                                            <td><a tooltip="{{ trans('labels.move') }}"><i class="fa-light fa-up-down-left-right mx-2"></i></a></td>
                                            @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                                                @if (@helper::checkaddons('bulk_delete'))
                                                    @if (Strtoupper($currency->name) != 'USD')
                                                        <td><input type="checkbox" class="row-checkbox form-check-input checkbox-style" value="{{ $currency->id }}"></td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                @endif
                                            @endif
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $currency->name }}</td>
                                            <td>{{ $currency->currency }}</td>
                                            <td>
                                                @if ($currency->is_available == '1')
                                                    <a tooltip="{{ trans('labels.active') }}"
                                                        @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/currency-settings/changestatus-' . $currency->code . '/2') }}')" @endif
                                                        class="btn btn-sm btn-outline-success hov"><i class="fas fa-check"></i></a>
                                                @else
                                                    <a tooltip="{{ trans('labels.inactive') }}"
                                                        @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/currency-settings/changestatus-' . $currency->code . '/1') }}')" @endif
                                                        class="btn btn-sm btn-outline-danger hov"><i class="fas fa-close mx-1"></i></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if (strtolower((string) helper::appdata($vendor_id)->default_currency) == strtolower((string) $currency->code))
                                                    <span class="badge bg-success">{{ trans('labels.active_currency') }}</span>
                                                @else
                                                    <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/currency-settings/setdefault-' . $currency->code . '/1') }}')" @endif
                                                        class="btn btn-sm btn-outline-dark hov"
                                                        tooltip="{{ trans('labels.activate_currency') }}">{{ trans('labels.activate_currency') }}</a>
                                                @endif
                                            </td>
                                            <td>{{ helper::date_format($currency->created_at, $vendor_id) }}<br>{{ helper::time_format($currency->created_at, $vendor_id) }}</td>
                                            <td>{{ helper::date_format($currency->updated_at, $vendor_id) }}<br>{{ helper::time_format($currency->updated_at, $vendor_id) }}</td>
                                            @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                                                <td>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <a href="{{ URL::to('admin/currency-settings/currency/edit-' . $currency->id) }}"
                                                            class="btn btn-info hov btn-sm" tooltip="{{ trans('labels.edit') }}">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                        @if (Strtoupper($currency->name) != 'USD' && strtolower($currency->code) != 'syp')
                                                            <a class="btn btn-danger hov"
                                                                tooltip="{{ trans('labels.delete') }}"
                                                                @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/currency-settings/delete-' . $currency->id . '/1') }}')" @endif>
                                                                <i class="fa-regular fa-trash"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
