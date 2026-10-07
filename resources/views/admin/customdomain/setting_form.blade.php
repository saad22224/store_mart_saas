<div id="custom_domain">
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 box-shadow">
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('admin/settings/updatecustomedomain') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info fs-7 mb-3">
                                    {{ trans('labels.custom_domain_admin_help') }}
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ trans('labels.custom_domain_server_ip') }}
                                        <span class="text-danger"> * </span>
                                    </label>
                                    <input type="text" class="form-control" name="server_ip" required
                                        value="{{ old('server_ip', @$setting->server_ip ?: env('SERVER_IP')) }}"
                                        placeholder="203.0.113.10" pattern="^(\d{1,3}\.){3}\d{1,3}$">
                                    <small class="text-muted">{{ trans('labels.custom_domain_server_ip_hint') }}</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.cname_section_title') }}
                                        <span class="text-danger"> * </span> </label>
                                    <input type="text" class="form-control" name="cname_title" required
                                        value="{{ @$setting->cname_title }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">{{ trans('labels.cname_section_text') }}
                                        <span class="text-danger"> * </span> </label>
                                    <textarea class="form-control" rows="3" id="cname_text" required name="cname_text">{!! $setting->cname_text !!}</textarea>
                                </div>
                            </div>
                            <div
                                class="mt-3 {{ session()->get('direction') == '2' ? 'text-start' : 'text-end' }}">
                                <button
                                    class="btn btn-primary px-sm-4 {{ Auth::user()->type == 4 ? (helper::check_access('role_custom_domains', Auth::user()->role_id, Auth::user()->vendor_id, 'edit') == 1 ? '' : 'd-none') : '' }}"
                                    @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
