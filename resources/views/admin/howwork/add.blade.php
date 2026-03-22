@extends('admin.layout.default')

@section('content')
    <div class="d-flex justify-content-between align-items-center">

        <h5 class="text-capitalize fw-600 text-dark color-changer fs-4">{{ trans('labels.add_new') }}</h5>

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb m-0">

                <li class="breadcrumb-item text-dark"><a
                        href="{{ URL::to('admin/how_it_works') }}" class="color-changer">{{ trans('labels.how_it_works') }}</a></li>

                <li class="breadcrumb-item active {{ session()->get('direction') == 2 ? 'breadcrumb-rtl' : '' }}"
                    aria-current="page">{{ trans('labels.add') }}</li>

            </ol>

        </nav>

    </div>

    <div class="row mt-3">

        <div class="col-12">

            <div class="card border-0 box-shadow">

                <div class="card-body">

                    <form action="{{ URL::to('/admin/how_it_works/save') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            <div class="form-group col-md-6">

                                <label class="form-label">{{ trans('labels.title') }}<span class="text-danger"> *

                                    </span></label>

                                <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                    placeholder="{{ trans('labels.title') }}" required>



                            </div>

                            <div class="form-group col-md-6">

                                <label class="form-label">{{ trans('labels.image') }}<span class="text-danger"> *

                                    </span></label>

                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class="form-group">

                                <label class="form-label">{{ trans('labels.description') }}<span class="text-danger"> *

                                    </span></label>

                                <textarea name="description" class="form-control" rows="5" placeholder="{{ trans('labels.description') }}"
                                    required></textarea>



                            </div>



                        </div>

                        <div class="mt-3 {{ session()->get('direction') == '2' ? 'text-start' : 'text-end' }}">

                            <a href="{{ URL::to('admin/how_it_works') }}"
                                class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>

                            <button
                                @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif
                                class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_how_it_works', Auth::user()->role_id, Auth::user()->vendor_id, 'add') == 1 ? '' : 'd-none') : '' }}">{{ trans('labels.save') }}</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
