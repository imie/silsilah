@extends('layouts.user-profile')

@section('subtitle', trans('user.profile'))

@section('user-content')
    <div class="row">
        <div class="col-md-4">
            @include('users.partials.profile')
        </div>
        <div class="col-md-8">
            @include('users.partials.parent-spouse')
            @include('users.partials.childs')
            @include('users.partials.siblings')
        </div>
    </div>
@endsection

@section ('ext_css')
<link rel="stylesheet" href="{{ asset('css/plugins/select2.min.css') }}">
@endsection

@section ('ext_js')
<script src="{{ asset('js/plugins/select2.min.js') }}"></script>
@endsection

@section ('script')
<script type="module">
(function () {
    $('select').select2();
})();
</script>
@endsection
