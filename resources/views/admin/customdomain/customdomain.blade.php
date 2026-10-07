@extends('admin.layout.default')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">{{ trans('labels.custom_domains') }}</h5>
        <div class="col-sm-auto col-12 mt-2 mt-sm-0">
            @if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1))
                <a href="{{ URL::to('admin/custom_domain/add') }}"
                    class="btn btn-secondary px-sm-4 w-100 {{ Auth::user()->type == 4 ? (helper::check_access('role_custom_domains', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">{{ trans('labels.request_custom_domain') }}</a>
            @endif
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                @include('admin.customdomain.setting_form')
            @endif

            @if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1))
                @include('admin.customdomain.partials.guide')
            @endif

            <div class="card border-0 mb-3 box-shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        @if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1))
                            @include('admin.customdomain.customdomain_table')
                        @endif
                        @if (Auth::user()->type == 1 || (Auth::user()->type == 4 && Auth::user()->vendor_id == 1))
                            @include('admin.customdomain.listcustomdomain_table')
                        @endif
                    </div>
                    @if (Auth::user()->type == 2 || (Auth::user()->type == 4 && Auth::user()->vendor_id != 1))
                        @if (!empty($setting->cname_title) || !empty($setting->cname_text))
                            <div class="card mt-4 border">
                                <div class="card-header border-bottom color-changer">
                                    {{ $setting->cname_title ?: trans('labels.read_before_sending_custom_domain_request') }}
                                </div>
                                <div class="card-body color-changer fs-7">
                                    <div class="card-text">{!! $setting->cname_text !!}</div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.12.1/ckeditor.js"></script>
    <script>
        if (document.getElementById('cname_text')) {
            CKEDITOR.replace('cname_text');
        }
    </script>
@endsection
