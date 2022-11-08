@extends('layouts.app')

@section('title', __('imovel.create'))

@section('content')
<br>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('imovel.create') }}</div>
            <form method="POST" action="{{ route('imoveis.store') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="card-body">

                    <div class="form-row">
                      <div class="col-md-4">
                            <label for="tpImovel" class="control-label">{{ __('imovel.tpImovel') }}</label>
                            <div class="form-check">
                               <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="building">
                                <label class="form-check-label" for="flexRadioDefault1">
                                Predial
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="territory">
                                <label class="form-check-label" for="flexRadioDefault2">
                                Territorial
                                </label>
                            </div>
                    </div> 

                        <div class="form-group col-md-8">
                            <label for="sequencial" class="control-label">{{ __('imovel.seq') }}</label>
                            <input id="seq" type="number" class="form-control{{ $errors->has('seq') ? ' é inválido' : '' }}" name="seq" value="{{ old('seq') }}" required>
                            {!! $errors->first('seq', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>

                    </div><br> 
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="setor" class="control-label">{{ __('imovel.setor') }}</label>
                            <input id="setor" type="number" class="form-control{{ $errors->has('setor') ? ' é inválido' : '' }}" name="setor" value="{{ old('setor') }}" required>
                            {!! $errors->first('setor', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label for="quadra" class="control-label">{{ __('imovel.quadra') }}</label>
                            <input id="quadra" type="number" type="text" class="form-control{{ $errors->has('quadra') ? ' é inválido' : '' }}" name="quadra" value="{{ old('quadra') }}" required>
                            {!! $errors->first('quadra', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lote" class="control-label">{{ __('imovel.lote') }}</label>
                            <input id="lote" type="number" class="form-control{{ $errors->has('lote') ? ' é inválido' : '' }}" name="lote" value="{{ old('lote') }}" required>
                            {!! $errors->first('lote', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                    </div> 
                    
                    <div class="form-group">
                        <label for="cpf" class="control-label">{{ __('imovel.cpf') }}</label>
                        <input id="cpf" type="text" class="form-control{{ $errors->has('cpf') ? ' é inválido' : '' }}" name="cpf" value="{{ old('owner.cpf') }}" required>
                        {!! $errors->first('cpf', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="name_owner" class="control-label">{{ __('imovel.name_owner') }}</label>
                        <input id="name_owner" type="text" class="form-control{{ $errors->has('name_owner') ? ' é inválido' : '' }}" name="name_owner" value="{{ old('owner.name_owner') }}" required>
                        {!! $errors->first('name_owner', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude" class="control-label">{{ __('imovel.latitude') }}</label>
                                <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' é inválido' : '' }}" name="latitude" value="{{ old('latitude', request('latitude')) }}" required>
                                {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude" class="control-label">{{ __('imovel.longitude') }}</label>
                                <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' é inválido' : '' }}" name="longitude" value="{{ old('longitude', request('longitude')) }}" required>
                                {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    
                    <div id="mapid"></div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('imovel.create') }}" class="btn btn-success">
                    <a href="{{ route('imoveis.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
crossorigin=""/>

<style>
    #mapid { height: 300px; }
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
   integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
   crossorigin=""></script>
<script>
    var mapCenter = [{{ request('latitude', config('leaflet.map_center_latitude')) }}, {{ request('longitude', config('leaflet.map_center_longitude')) }}];
    var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);
    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Localização:  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#latitude').val() , $('#longitude').val());
    }
    $('#latitude').on('input', updateMarkerByInputs);
    $('#longitude').on('input', updateMarkerByInputs);

    
</script>
@endpush
