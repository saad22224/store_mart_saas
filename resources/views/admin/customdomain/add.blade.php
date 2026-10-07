@php
    if (Auth::user()->type == 4) {
        $vendor_id = Auth::user()->vendor_id;
    } else {
        $vendor_id = Auth::user()->id;
    }
    $currentDomain = helper::appdata($vendor_id)->custom_domain ?? null;
    $hasConnectedDomain = !empty($currentDomain) && $currentDomain !== '-';
@endphp
@extends('admin.layout.default')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">{{ trans('labels.request_custom_domain') }}</h5>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item text-dark"><a href="{{ URL::to('admin/custom_domain') }}"
                        class="color-changer">{{ trans('labels.custom_domains') }}</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">{{ trans('labels.add') }}</li>
            </ol>
        </nav>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            @include('admin.customdomain.partials.guide')

            <div class="card border-0 my-3 box-shadow">
                <div class="card-body">
                    @if ($hasConnectedDomain)
                        <div class="alert alert-warning">
                            <small>{{ trans('labels.custom_domain_already_connected', ['domain' => $currentDomain]) }}</small>
                        </div>
                    @endif
                    <form class="col-md-12 my-2" action="{{ URL::to('admin/custom_domain/save') }}">
                        <div class="my-2">
                            <label for="custom_domain">{{ trans('labels.custom_domain') }}</label>
                            <input type="text" name="custom_domain" id="custom_domain" class="form-control"
                                placeholder="mystore.com" required>
                        </div>
                        <p class="mb-0 mb-2 color-changer">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ trans('labels.custom_domain_format_hint') }}
                        </p>
                        <div class="mt-3 {{ session()->get('direction') == '2' ? 'text-start' : 'text-end' }}">
                            <a href="{{ URL::to('admin/custom_domain') }}"
                                class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>
                            <button @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif
                                class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_custom_domains', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 || helper::check_access('role_custom_domains', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">{{ trans('labels.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
