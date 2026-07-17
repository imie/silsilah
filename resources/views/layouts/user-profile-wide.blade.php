@extends('layouts.app')

@section('content')
</div>
<div class="container-fluid">
    @include('users.partials.action-buttons', ['user' => $user])
    <h2 class="page-header">
        @if (in_array(app()->getLocale(), ['id', 'ms']))
            <small>@yield('subtitle')</small> {{ $user->name }}
        @else
            {{ $user->name }} <small>@yield('subtitle')</small>
        @endif
    </h2>
    @yield('user-content')
@endsection
