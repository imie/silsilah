@extends('layouts.app')

@section('title', __('app.settings'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('app.settings') }}</div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    <div class="mb-3 row">
                        <label for="religion" class="col-md-4 col-form-label text-md-end">{{ __('app.religion') }}</label>

                        <div class="col-md-6">
                            <select id="religion" class="form-control" name="religion" required>
                                <option value="islam" {{ $religion === 'islam' ? 'selected' : '' }}>Islam</option>
                                <option value="buddha" {{ $religion === 'buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="christian" {{ $religion === 'christian' ? 'selected' : '' }}>Christian</option>
                                <option value="other" {{ $religion === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <small class="form-text text-muted">
                                {{ __('app.religion_help') }}
                            </small>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('app.save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
