@extends('layouts.app')

@section('title', __('imovel.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $imovel)
        @can('delete', $imovel)
            <div class="card">
                <div class="card-header">{{ __('imovel.delete') }}</div>
                <div class="card-body">
                    <label class="control-label text-primary">{{ __('imovel.seq') }}</label>
                    <p>{{ $imovel->seq}}</p>
                    <label class="control-label text-primary">{{ __('imovel.setor') }}</label>
                    <p>{{ $imovel->setor}}</p>
                    <label class="control-label text-primary">{{ __('imovel.quadra') }}</label>
                    <p>{{ $imovel->quadra }}</p>
                    <label class="control-label text-primary">{{ __('imovel.lote') }}</label>
                    <p>{{ $imovel->lote}}</p>
                    <label class="control-label text-primary">{{ __('imovel.name_owner') }}</label>
                    <p>{{ $imovel->owner->name_owner}}</p>
                    <label class="control-label text-primary">{{ __('imovel.latitude') }}</label>
                    <p>{{ $imovel->latitude }}</p>
                    <label class="control-label text-primary">{{ __('imovel.longitude') }}</label>
                    <p>{{ $imovel->longitude }}</p>
                    {!! $errors->first('imovel_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('imovel.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('imovels.destroy', $imovel) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="imovel_id" type="hidden" value="{{ $imovel->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('imovels.edit', $imovel) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('imovel.edit') }}</div>
            <form method="POST" action="{{ route('imovels.update', $imovel) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="seq" class="control-label">{{ __('imovel.seq') }}</label>
                        <input id="seq" type="text" class="form-control{{ $errors->has('seq') ? ' is-invalid' : '' }}" name="seq" value="{{ old('seq', $imovel->seq) }}" required>
                        {!! $errors->first('seq', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="setor" class="control-label">{{ __('imovel.setor') }}</label>
                            <input id="setor" type="number" class="form-control{{ $errors->has('setor') ? ' is-invalid' : '' }}" name="setor" value="{{ old('setor', $imovel->setor) }}" required>
                            {!! $errors->first('setor', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label for="quadra" class="control-label">{{ __('imovel.quadra') }}</label>
                            <input id="quadra" type="number" type="text" class="form-control{{ $errors->has('quadra') ? ' is-invalid' : '' }}" name="quadra" value="{{ old('quadra', $imovel->quadra) }}" required>
                            {!! $errors->first('quadra', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lote" class="control-label">{{ __('imovel.lote') }}</label>
                            <input id="lote" type="number" class="form-control{{ $errors->has('lote') ? ' is-invalid' : '' }}" name="lote" value="{{ old('lote', $imovel->lote) }}" required>
                            {!! $errors->first('lote', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cpf" class="control-label">{{ __('imovel.cpf') }}</label>
                        <input id="cpf" type="text" class="form-control{{ $errors->has('cpf') ? ' é inválido' : '' }}" name="cpf" value="{{ old('cpf', $imovel->cpf) }}" required>
                        {!! $errors->first('cpf', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="name_owner" class="control-label">{{ __('imovel.name_owner') }}</label>
                        <input id="name_owner" type="text" class="form-control{{ $errors->has('name_owner') ? ' é inválido' : '' }}" name="name_owner" value="{{ old('name_owner', $imovel->name_owner) }}" required>
                        {!! $errors->first('name_owner', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude" class="control-label">{{ __('imovel.latitude') }}</label>
                                <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude', $imovel->latitude) }}" required>
                                {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude" class="control-label">{{ __('imovel.longitude') }}</label>
                                <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude', $imovel->longitude) }}" required>
                                {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>

                    <div id="mapid"></div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('imovel.update') }}" class="btn btn-success">
                    <a href="{{ route('imovels.show', $imovel) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $imovel)
                        <a href="{{ route('imovels.edit', [$imovel, 'action' => 'delete']) }}" id="del-imovel-{{ $imovel->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
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
    var mapCenter = [{{ $imovel->latitude }}, {{ $imovel->longitude }}];
    var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.detail_zoom_level') }});
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
