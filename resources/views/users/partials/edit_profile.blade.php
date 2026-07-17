<div class="card card bg-light">
    <div class="card-header"><h3 class="card-title">{{ __('user.edit') }}</h3></div>
    <div class="card-body">
        <div class="form-group">
            <label for="name" class="control-label">{{ __('user.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
        </div>
        <div class="form-group">
            <label for="nickname" class="control-label">{{ __('user.nickname') }}</label>
            <input type="text" name="nickname" id="nickname" class="form-control" value="{{ old('nickname', $user->nickname) }}">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">{{ __('user.gender') }}</label>
                    <div>
                        <label class="radio-inline"><input type="radio" name="gender_id" value="1" {{ old('gender_id', $user->gender_id) == 1 ? 'checked' : '' }}> {{ __('app.male_code') }}</label>
                        <label class="radio-inline"><input type="radio" name="gender_id" value="2" {{ old('gender_id', $user->gender_id) == 2 ? 'checked' : '' }}> {{ __('app.female_code') }}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="birth_order" class="control-label">{{ __('user.birth_order') }}</label>
                    <input type="number" name="birth_order" id="birth_order" class="form-control" min="1" value="{{ old('birth_order', $user->birth_order) }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="is_deceased" class="control-label">Deceased</label>
                    <div style="margin-top: 8px;">
                        <input type="hidden" name="is_deceased" value="0">
                        <input type="checkbox" name="is_deceased" id="is_deceased" value="1" {{ old('is_deceased', $user->is_deceased) ? 'checked' : '' }}>
                        <label for="is_deceased" style="font-weight: normal; margin-left: 5px;">Yes</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="yob" class="control-label">{{ __('user.yob') }}</label>
                    <input type="text" name="yob" id="yob" class="form-control" placeholder="{{ __('app.example').' 1959' }}" value="{{ old('yob', $user->yob) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="dob" class="control-label">{{ __('user.dob') }}</label>
                    <input type="date" name="dob" id="dob" class="form-control" placeholder="{{ __('app.example').' 1959-07-20' }}" value="{{ old('dob', $user->dob) }}">
                </div>
            </div>
        </div>
        <div class="row" id="death_fields" style="display: {{ old('is_deceased', $user->is_deceased) ? 'flex' : 'none' }};">
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
    </div>
</div>
