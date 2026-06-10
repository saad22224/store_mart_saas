@extends('admin.layout.default')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">شركات الشحن</h5>
        <a href="{{ URL::to('admin/shipping-companies/add') }}" class="btn btn-secondary px-sm-4 d-flex">
            <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 box-shadow my-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered py-3 zero-configuration w-100">
                            <thead>
                                <tr class="text-capitalize fw-500 fs-15">
                                    <td>{{ trans('labels.srno') }}</td>
                                    <td>{{ trans('labels.name') }}</td>
                                    <td>رقم واتساب</td>
                                    <td>مدة التوصيل</td>
                                    <td>{{ trans('labels.status') }}</td>
                                    <td>{{ trans('labels.created_date') }}</td>
                                    <td>{{ trans('labels.action') }}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shippingCompanies as $key => $shippingCompany)
                                    <tr class="fs-7 align-middle">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $shippingCompany->name }}</td>
                                        <td>{{ $shippingCompany->whatsapp_number }}</td>
                                        <td>{{ $shippingCompany->delivery_duration }}</td>
                                        <td>
                                            @if ($shippingCompany->is_active)
                                                <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/shipping-companies/change_status-' . $shippingCompany->id . '/2') }}')" @endif
                                                    class="btn btn-sm btn-outline-success hov" tooltip="{{ trans('labels.active') }}">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            @else
                                                <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="statusupdate('{{ URL::to('admin/shipping-companies/change_status-' . $shippingCompany->id . '/1') }}')" @endif
                                                    class="btn btn-sm btn-outline-danger hov" tooltip="{{ trans('labels.inactive') }}">
                                                    <i class="fas fa-close"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{ helper::date_format($shippingCompany->created_at, Auth::user()->id) }}<br>
                                            {{ helper::time_format($shippingCompany->created_at, Auth::user()->id) }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 flex-wrap">
                                                <a href="{{ URL::to('admin/shipping-companies/edit-' . $shippingCompany->id) }}"
                                                    class="btn btn-info hov btn-sm" tooltip="{{ trans('labels.edit') }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="deletedata('{{ URL::to('admin/shipping-companies/delete-' . $shippingCompany->id) }}')" @endif
                                                    class="btn btn-danger hov btn-sm" tooltip="{{ trans('labels.delete') }}">
                                                    <i class="fa-regular fa-trash"></i>
                                                </a>
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
    </div>
@endsection
