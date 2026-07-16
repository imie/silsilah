@extends('layouts.app')

@section('content')
<h2 class="page-header">
     {{ $couple->husband->name }} &amp; {{ $couple->wife->name }} <small>{{ trans('couple.edit') }}</small>
</h2>

@include('couples.partials.stat')

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="card card bg-light">
            <div class="card-header"><h3 class="card-title">{{ trans('couple.update') }}</h3></div>
            <form method="POST" action="{{ route('couples.update', $couple) }}">
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="marriage_date" class="control-label">{{ trans('couple.marriage_date') }}</label>
                            <input type="date" name="marriage_date" id="marriage_date" class="form-control" value="{{ old('marriage_date', $couple->marriage_date) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="divorce_date" class="control-label">{{ trans('couple.divorce_date') }}</label>
                            <input type="date" name="divorce_date" id="divorce_date" class="form-control" value="{{ old('divorce_date', $couple->divorce_date) }}">
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="address" class="control-label">{{ trans('app.address') }}</label>
                    <textarea name="address" id="address" class="form-control">{{ old('address', $couple->address) }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">{{ trans('couple.update') }}</button>
                {{ link_to_route('couples.show', trans('app.cancel'), [$couple], ['class' => 'btn btn-secondary']) }}
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
