<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="yod" class="control-label">{{ __('user.yod') }}</label>
            <input type="text" name="yod" id="yod" class="form-control" placeholder="{{ __('app.example').' 2003' }}" value="{{ old('yod', $user->yod) }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="dod" class="control-label">{{ __('user.dod') }}</label>
            <input type="date" name="dod" id="dod" class="form-control" placeholder="{{ __('app.example').' 2003-10-17' }}" value="{{ old('dod', $user->dod) }}">
        </div>
    </div>
</div>

<fieldset>
    <legend>{{ __('user.cemetery_location') }}</legend>
    <div class="form-group">
        <label for="cemetery_location_name" class="control-label">{{ __('address.location_name') }}</label>
        <input type="text" name="cemetery_location_name" id="cemetery_location_name" class="form-control" value="{{ old('cemetery_location_name', $user->getMetadata('cemetery_location_name')) }}">
    </div>
    <div class="form-group">
        <label for="cemetery_location_address" class="control-label">{{ __('address.address') }}</label>
        <textarea name="cemetery_location_address" id="cemetery_location_address" class="form-control">{{ old('cemetery_location_address', $user->getMetadata('cemetery_location_address')) }}</textarea>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="cemetery_location_latitude" class="control-label">{{ __('address.latitude') }}</label>
                <input type="text" name="cemetery_location_latitude" id="cemetery_location_latitude" class="form-control" value="{{ old('cemetery_location_latitude', $user->getMetadata('cemetery_location_latitude')) }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="cemetery_location_longitude" class="control-label">{{ __('address.longitude') }}</label>
                <input type="text" name="cemetery_location_longitude" id="cemetery_location_longitude" class="form-control" value="{{ old('cemetery_location_longitude', $user->getMetadata('cemetery_location_longitude')) }}">
            </div>
        </div>
    </div>
</fieldset>
