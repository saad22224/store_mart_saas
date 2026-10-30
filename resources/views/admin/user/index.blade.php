@extends('admin.layout.default')

@section('content')
    @php
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
    @endphp
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
        <h5 class="text-capitalize fw-600 color-changer text-dark fs-4">{{ trans('labels.users') }}</h5>

        <div class="d-flex flex-wrap gap-2 align-items-center">
            <div class="position-relative" style="min-width: 250px;">
                <input type="text" id="vendorSearchInput" class="form-control rounded-pill pe-5 ps-3"
                    placeholder="بحث سريع (الاسم، الجوال، الإيميل)..." autocomplete="off">
                <span class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted">
                    <i style="transform: translateX(-200px);" class="fa-solid fa-magnifying-glass"></i>
                </span>
            </div>

            @if (@helper::checkaddons('vendor_import'))
                <a href="{{ URL::to('admin/users/import') }}" class="btn btn-secondary px-sm-4 d-flex">
                    <i class="fa-solid fa-file-import mx-1"></i>{{ trans('labels.import') }}</a>

                @if ($getuserslist->count() > 0)
                    <a href="{{ URL::to('admin/users/exportvendor') }}" class="btn btn-secondary px-sm-4 d-flex">
                        <i class="fa-solid fa-file-export mx-1"></i>{{ trans('labels.export') }}</a>
                @endif
            @endif

            <a href="{{ URL::to('admin/users/add') }}"
                class="btn btn-secondary px-sm-4 d-flex {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">
                <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}</a>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="table-responsive" id="table-display">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fw-500 fs-15">
                                    <td>{{ trans('labels.id') }}</td>
                                    <td>{{ trans('labels.image') }}</td>
                                    <td>{{ trans('labels.name') }}</td>
                                    <td>{{ trans('labels.email') }}</td>
                                    <td>{{ trans('labels.mobile') }}</td>
                                    <td>{{ trans('labels.login_type') }}</td>
                                    <td>{{ trans('labels.status') }}</td>
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.updated_date') }}</td>
                                    <td>{{ trans('labels.action') }}</td>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($getuserslist as $user)
                                    <tr class="fs-7 align-middle">
                                        <td>{{ $user->id }}</td>
                                        <td> <img src="{{ helper::image_path($user->image) }}"
                                                class="img-fluid rounded hw-50" alt="" srcset=""> </td>
                                        <td> {{ $user->name }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td> {{ $user->mobile }} </td>
                                        <td>
                                            @if ($user->login_type == 'normal')
                                                {{ trans('labels.normal') }}
                                            @elseif ($user->login_type == 'google')
                                                {{ trans('labels.google') }}
                                            @elseif ($user->login_type == 'facebook')
                                                {{ trans('labels.facebook') }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1">
                                                @if ($user->is_available == 1)
                                                    <a class="btn btn-sm btn-outline-success hov {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                        tooltip="{{ trans('labels.active') }}"
                                                        @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/users/status-' . $user->id . '/2') }}')" @endif>
                                                        <i class="fa-sharp fa-solid fa-check"></i>
                                                    </a>
                                                @else
                                                    <a class="btn btn-sm btn-outline-danger hov {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                        tooltip="{{ trans('labels.inactive') }}"
                                                        @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/users/status-' . $user->id . '/1') }}')" @endif>
                                                        <i class="fa-sharp fa-solid fa-xmark"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ helper::date_format($user->created_at, $vendor_id) }}<br>
                                            {{ helper::time_format($user->created_at, $vendor_id) }}
                                        </td>
                                        <td>{{ helper::date_format($user->updated_at, $vendor_id) }}<br>
                                            {{ helper::time_format($user->updated_at, $vendor_id) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 flex-wrap">
                                                <a class="btn btn-sm btn-info hov {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                    tooltip="{{ trans('labels.edit') }}"
                                                    href="{{ URL::to('admin/users/edit-' . $user->id) }}">
                                                    <i class="fa fa-pen-to-square"></i>
                                                </a>
                                                <a class="btn btn-sm btn-dark hov" tooltip="{{ trans('labels.login') }}"
                                                    href="{{ URL::to('admin/users/login-' . $user->id) }}">
                                                    <i class="fa-regular fa-arrow-right-to-bracket"></i>
                                                </a>
                                                <a class="btn btn-sm btn-secondary hov"
                                                    tooltip="{{ trans('labels.view') }}"
                                                    href="@if ($user->custom_domain == null) {{ URL::to('/' . $user->slug) }} @else https://{{ $user->custom_domain }} @endif"
                                                    target="_blank"><i class="fa-regular fa-eye"></i>
                                                </a>
                                                <button type="button" id="btn_password{{ $user->id }}"
                                                    tooltip="{{ trans('labels.reset_password') }}"
                                                    onclick="myfunction({{ $user->id }})"
                                                    class="btn btn-sm btn-success hov {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                                    data-vendor_id="{{ $user->id }}" data-type="1">
                                                    <i class="fa-light fa-key"></i>
                                                </button>
                                                <a href="javascript:void(0)" tooltip="{{ trans('labels.delete') }}"
                                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/users/delete-' . $user->id) }}')" @endif
                                                    class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}">
                                                    <i class="fa-regular fa-trash"></i>
                                                </a>
                                                @if (@helper::checkaddons('store_clone'))
                                                    <a href="{{ URL::to('admin/users/add-' . $user->id) }}"
                                                        tooltip="{{ trans('labels.clone') }}"
                                                        class="btn btn-warning hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">
                                                        <i class="fa-regular fa-clone"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div id="vendorCardsContainer" class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-1 g-3 pb-3">
        @foreach ($getuserslist as $user)
            <div class="col vendor-col" data-search="{{ mb_strtolower($user->name . ' ' . $user->email . ' ' . $user->mobile) }}">
                <div class="vendor_card card border bg-change rounded-4 h-100 box-shadow">
                    <div class="card-body p-3">
                        <div class="d-flex gap-3 mb-3 align-items-center border-bottom pb-2">
                            <div class="col-auto">
                                <img src="{{ helper::image_path($user->image) }}" class="img-fluid rounded hw-50"
                                    alt="" srcset="">
                            </div>
                            <div>
                                <p class="fs-6 fw-600 mt-1 color-changer">
                                    {{ $user->name }}
                                </p>
                                <p class="fs-7 mt-1 color-changer">
                                    {{ $user->mobile }}
                                </p>
                            </div>
                        </div>
                        <p class="fs-7 mt-1 color-changer">
                            {{ trans('labels.status') }} :
                            @if ($user->is_available == 1)
                                <a class="fw-500 text-success {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/users/status-' . $user->id . '/2') }}')" @endif>
                                    <i class="fa-sharp fa-solid fa-check"></i> {{ trans('labels.active') }}
                                </a>
                            @else
                                <a class="fw-500 text-danger {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                    @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/users/status-' . $user->id . '/1') }}')" @endif>
                                    <i class="fa-sharp fa-solid fa-xmark"></i> {{ trans('labels.inactive') }}
                                </a>
                            @endif
                        </p>
                        <p class="fs-7 mt-1 color-changer">
                            {{ trans('labels.login_type') }} :
                            @if ($user->login_type == 'normal')
                                {{ trans('labels.normal') }}
                            @elseif ($user->login_type == 'google')
                                {{ trans('labels.google') }}
                            @elseif ($user->login_type == 'facebook')
                                {{ trans('labels.facebook') }}
                            @endif
                        </p>
                        <p class="fs-7 mt-1 color-changer">
                            {{ trans('labels.email') }} :
                            {{ $user->email }}
                        </p>
                        <div class="d-flex flex-wrap justify-content-center mt-3 gap-2">
                            <a class="btn btn-sm btn-info hov {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                tooltip="{{ trans('labels.edit') }}"
                                href="{{ URL::to('admin/users/edit-' . $user->id) }}">
                                <i class="fa fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-sm btn-dark hov" tooltip="{{ trans('labels.login') }}"
                                href="{{ URL::to('admin/users/login-' . $user->id) }}">
                                <i class="fa-regular fa-arrow-right-to-bracket"></i>
                            </a>
                            <a class="btn btn-sm btn-secondary hov" tooltip="{{ trans('labels.view') }}"
                                href="@if ($user->custom_domain == null) {{ URL::to('/' . $user->slug) }} @else https://{{ $user->custom_domain }} @endif"
                                target="_blank"><i class="fa-regular fa-eye"></i>
                            </a>
                            <button type="button" id="btn_password{{ $user->id }}"
                                tooltip="{{ trans('labels.reset_password') }}" onclick="myfunction({{ $user->id }})"
                                class="btn btn-sm btn-success hov {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                data-vendor_id="{{ $user->id }}" data-type="1">
                                <i class="fa-light fa-key"></i>
                            </button>
                            <a href="javascript:void(0)" tooltip="{{ trans('labels.delete') }}"
                                @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/users/delete-' . $user->id) }}')" @endif
                                class="btn btn-danger hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'delete') == 1 ? '' : 'd-none') : '' }}">
                                <i class="fa-regular fa-trash"></i>
                            </a>
                            @if (@helper::checkaddons('store_clone'))
                                <a href="{{ URL::to('admin/users/add-' . $user->id) }}"
                                    tooltip="{{ trans('labels.clone') }}"
                                    class="btn btn-warning hov btn-sm {{ Auth::user()->type == 4 ? (helper::check_access('role_vendors', Auth::user()->role_id, $vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}">
                                    <i class="fa-regular fa-clone"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div id="noVendorFound" class="d-none text-center py-5">
        <div class="card border-0 box-shadow rounded-4 p-5">
            <i class="fa-solid fa-magnifying-glass fa-3x text-muted mb-3"></i>
            <h5 class="text-muted fw-bold">لا يوجد بائعون يطابقون بحثك</h5>
            <p class="text-muted fs-7 mb-0">جرب البحث بكلمات أخرى أو برقم الجوال أو البريد الإلكتروني.</p>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="changepasswordModal" tabindex="-1" aria-labelledby="changepasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ URL::to('/admin/settings/change-password') }}" method="post" class="w-100">
                @csrf
                <div class="modal-content">
                    <div class="modal-header justify-content-between">
                        <h5 class="modal-title" id="changepasswordModalLabel">
                            {{ trans('labels.change_password') }}
                        </h5>
                        <button type="button" class="btn-close m-0" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="card p-1 border-0">
                            <input type="hidden" class="form-control" name="modal_vendor_id" id="modal_vendor_id"
                                value="">
                            <input type="hidden" class="form-control" name="type" id="type" value="1">
                            <div class="form-group">
                                <label for="new_password" class="form-label">{{ trans('labels.new_password') }}</label>
                                <input type="password" class="form-control" name="new_password" required
                                    placeholder="{{ trans('labels.new_password') }}">

                            </div>
                            <div class="form-group">
                                <label for="confirm_password"
                                    class="form-label">{{ trans('labels.confirm_password') }}</label>
                                <input type="password" class="form-control" name="confirm_password" required
                                    placeholder="{{ trans('labels.confirm_password') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary px-sm-4">{{ trans('labels.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function myfunction(id) {
            $('#modal_vendor_id').val($('#btn_password' + id).attr("data-vendor_id"));
            $('#changepasswordModal').modal('show');
        }

        // Real-time vendor search
        $(document).ready(function() {
            $('#vendorSearchInput').on('input', function() {
                var query = $(this).val().trim().toLowerCase();
                var visibleCount = 0;

                $('.vendor-col').each(function() {
                    var searchData = $(this).attr('data-search') || '';
                    if (query === '' || searchData.indexOf(query) !== -1) {
                        $(this).removeClass('d-none');
                        visibleCount++;
                    } else {
                        $(this).addClass('d-none');
                    }
                });

                if (visibleCount === 0 && $('.vendor-col').length > 0) {
                    $('#noVendorFound').removeClass('d-none');
                } else {
                    $('#noVendorFound').addClass('d-none');
                }
            });
        });
    </script>
@endsection
