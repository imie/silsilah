@extends('layouts.app')

@section('content')
<h2 class="page-header">
    {{ trans('app.search_your_family') }}
    @if (request('q'))
    <small class="float-end">{!! trans('app.user_found', ['total' => $users->total(), 'keyword' => request('q')]) !!}</small>
    @endif
</h2>


<form method="GET" action="">
<div class="input-group">
    <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="{{ trans('app.search_your_family_placeholder') }}">
    <span class="input-group-btn">
        <button type="submit" class="btn btn-secondary">{{ trans('app.search') }}</button>
        {{ link_to_route('users.search', 'Reset', [], ['class' => 'btn btn-secondary']) }}
    </span>
</div>
</form>

@if (request('q'))
<br>
{{ $users->appends(Request::except('page'))->render() }}
@foreach ($users->chunk(4) as $chunkedUser)
<div class="row">
    @foreach ($chunkedUser as $user)
    <div class="col-md-3">
        <div class="card card bg-light">
            <div class="card-header text-center">
                {{ userPhoto($user, ['style' => 'width:100%;max-width:300px']) }}
                @if ($user->age)
                    {!! $user->age_string !!}
                @endif
            </div>
            <div class="card-body">
                <h3 class="card-title">{{ $user->profileLink() }} ({{ $user->gender }})</h3>
                <div>{{ trans('user.nickname') }} : {{ $user->nickname }}</div>
                <hr style="margin: 5px 0;">
                <div>{{ trans('user.father') }} : {{ $user->father_id ? $user->father->name : '' }}</div>
                <div>{{ trans('user.mother') }} : {{ $user->mother_id ? $user->mother->name : '' }}</div>
            </div>
            <div class="card-footer">
                {{ link_to_route('users.show', trans('app.show_profile'), [$user->id], ['class' => 'btn btn-secondary btn-xs']) }}
                {{ link_to_route('users.chart', trans('app.show_family_chart'), [$user->id], ['class' => 'btn btn-secondary btn-xs']) }}
            </div>
        </div>
    </div>
    @endforeach
</div>
@endforeach

{{ $users->appends(Request::except('page'))->render() }}
@endif
@endsection
