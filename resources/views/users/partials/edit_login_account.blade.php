<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">{{ __('app.login_account') }}</h3></div>
    <div class="panel-body">
        <div class="form-group">
            <label for="email" class="control-label">{{ __('auth.email') }}</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('app.example').' nama@mail.com' }}" value="{{ old('email', $user->email) }}">
        </div>
        <div class="form-group">
            <label for="password" class="control-label">{{ __('auth.password') }}</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="******">
        </div>
    </div>
</div>
