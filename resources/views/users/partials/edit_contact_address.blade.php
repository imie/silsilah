<div class="card bg-light mb-4">
    <div class="card-header"><h3 class="card-title">{{ __('app.address') }} &amp; {{ __('app.contact') }}</h3></div>
    <div class="card-body">
        <div class="form-group">
            <label for="address" class="control-label">{{ __('app.address') }}</label>
            <textarea name="address" id="address" class="form-control">{{ old('address', $user->address) }}</textarea>
        </div>
        <div class="form-group">
            <label for="city" class="control-label">{{ __('app.city') }}</label>
            <input type="text" name="city" id="city" class="form-control" placeholder="{{ __('app.example').' Jakarta' }}" value="{{ old('city', $user->city) }}">
        </div>
        <div class="form-group">
            <label for="phone" class="control-label">{{ __('app.phone') }}</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="{{ __('app.example').' 081234567890' }}" value="{{ old('phone', $user->phone) }}">
        </div>
    </div>
</div>
