@extends('layouts.app')

@section('content')
@if (request('action') == 'delete' && $user)
    @can('delete', $user)
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('users.partials.delete_confirmation')
            </div>
        </div>
    @endcan
@else
    <div class="float-end">
        {{ link_to_route('users.show', __('app.show_profile').' '.$user->name, [$user->id], ['class' => 'btn btn-secondary']) }}
    </div>
    <h2 class="page-header">
        {{ __('user.edit') }} {{ $user->profileLink() }}
    </h2>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    @include('users.partials.update_photo')
                </div>
                <div class="col-md-8">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" autocomplete="off">
                    @csrf
                    @method('patch')
                    @include('users.partials.edit_profile')
                    @include('users.partials.edit_contact_address')
                    @include('users.partials.edit_login_account')
                    <div class="text-end mt-4">
                        <button id="update_profile_button" type="submit" class="btn btn-primary">{{ __('app.update') }}</button>
                        {{ link_to_route('users.show', __('app.cancel'), [$user->id], ['class' => 'btn btn-secondary']) }}
                        @can('delete', $user)
                            <div class="mt-3">
                                {{ link_to_route('users.edit', __('user.delete'), [$user, 'action' => 'delete'], ['class' => 'btn btn-danger', 'id' => 'del-user-'.$user->id]) }}
                            </div>
                        @endcan
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@section('ext_css')
<link href="{{ asset('css/plugins/jquery.datetimepicker.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/plugins/select2.min.css') }}">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
@endsection

@section('script')
<script src="{{ asset('js/plugins/jquery.datetimepicker.js') }}"></script>
<script src="{{ asset('js/plugins/select2.min.js') }}"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

<script type="module">
    (function() {
        $('select').select2();

        $(document).on('change', '#is_deceased', function() {
            if ($(this).is(':checked')) {
                $('#death_fields').css('display', 'flex');
                if (typeof map !== 'undefined') {
                    map.invalidateSize();
                }
            } else {
                $('#death_fields').hide();
            }
        });
    })();

    var mapCenter = [{{ $mapCenterLatitude }}, {{ $mapCenterLongitude }}];
    var map = L.map('mapid').setView(mapCenter, {{ $mapZoomLevel }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);
    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Your location :  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);
        $('#cemetery_location_latitude').val(latitude);
        $('#cemetery_location_longitude').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#cemetery_location_latitude').val() , $('#cemetery_location_longitude').val());
    }
    $('#cemetery_location_latitude').on('input', updateMarkerByInputs);
    $('#cemetery_location_longitude').on('input', updateMarkerByInputs);
</script>
@endsection
