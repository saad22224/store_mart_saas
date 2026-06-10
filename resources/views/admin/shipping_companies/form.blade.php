<form action="{{ $action }}" method="POST">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label class="form-label">{{ trans('labels.name') }}<span class="text-danger"> *</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name', $shippingCompany->name ?? '') }}" placeholder="{{ trans('labels.name') }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">رقم واتساب الشركة<span class="text-danger"> *</span></label>
            <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror" name="whatsapp_number"
                value="{{ old('whatsapp_number', $shippingCompany->whatsapp_number ?? '') }}" placeholder="01000000000" required>
            @error('whatsapp_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">مدة التوصيل<span class="text-danger"> *</span></label>
            <input type="text" class="form-control @error('delivery_duration') is-invalid @enderror" name="delivery_duration"
                value="{{ old('delivery_duration', $shippingCompany->delivery_duration ?? '') }}" placeholder="24 ساعة، 3 أيام، 5-7 أيام" required>
            @error('delivery_duration') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-label d-block">{{ trans('labels.status') }}</label>
            <input type="hidden" name="is_active" value="0">
            <input id="shipping-company-status" type="checkbox" class="checkbox-switch" name="is_active" value="1"
                {{ old('is_active', $shippingCompany->is_active ?? true) ? 'checked' : '' }}>
            <label for="shipping-company-status" class="switch">
                <span class="switch__circle"><span class="switch__circle-inner"></span></span>
                <span class="switch__left ps-2">{{ trans('labels.active') }}</span>
                <span class="switch__right pe-2">{{ trans('labels.inactive') }}</span>
            </label>
        </div>
        <div class="mt-3 {{ session()->get('direction') == '2' ? 'text-start' : 'text-end' }}">
            <a href="{{ URL::to('admin/shipping-companies') }}" class="btn btn-danger px-sm-4">{{ trans('labels.cancel') }}</a>
            <button class="btn btn-primary px-sm-4" @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save') }}</button>
        </div>
    </div>
</form>
