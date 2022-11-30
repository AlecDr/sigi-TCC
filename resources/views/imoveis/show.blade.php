@extends('layouts.app')

@section('title', __('imovel.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('imovel.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>

                        <tr><td>{{ __('imovel.tpImovel') }}</td><td>{{ $imovel->tpImovel }}</td></tr>
                        <tr><td>{{ __('imovel.seq') }}</td><td>{{ $imovel->seq }}</td></tr>
                        <tr><td>{{ __('imovel.setor') }}</td><td>{{ $imovel->setor }}</td></tr>                     
                        <tr><td>{{ __('imovel.quadra') }}</td><td>{{ $imovel->quadra }}</td></tr>
                        <tr><td>{{ __('imovel.lote') }}</td><td>{{ $imovel->lote }}</td></tr>
                        <tr><td>{{ __('imovel.owner.cpf') }}</td><td>{{ $imovel->owner->cpf }}</td></tr>
                        <tr><td>{{ __('imovel.owner.name_owner') }}</td><td>{{ $imovel->owner->name_owner}}</td></tr>
                        <tr><td>{{ __('imovel.latitude') }}</td><td>{{ $imovel->latitude }}</td></tr>
                        <tr><td>{{ __('imovel.longitude') }}</td><td>{{ $imovel->longitude }}</td></tr>
                      
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $imovel)
                    <a href="{{ route('imoveis.edit', $imovel) }}" id="edit-imovel-{{ $imovel->id }}" class="btn btn-warning">{{ __('imovel.edit') }} </a>
                @endcan
                @if(auth()->check())
                    <a href="{{ route('imoveis.index') }}" class="btn btn-link">{{ __('imovel.back_to_index') }}</a>
                @else
                    <a href="{{ route('imovel_map.index') }}" class="btn btn-link">{{ __('imovel.back_to_index') }}</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ trans('imovel.location') }}</div>
            @if ($imovel->coordinate)
            <div class="card-body" id="mapid"></div>
            @else
            <div class="card-body">{{ __('imovel.no_coordinate') }}</div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
crossorigin=""/>

<style>
    #mapid { height: 400px; }
</style>
@endsection
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- Make sure you put tdis AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
   integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
   crossorigin=""></script>

<script>
    var map = L.map('mapid').setView([{{ $imovel->latitude }}, {{ $imovel->longitude }}], {{ config('leaflet.detail_zoom_level') }});
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    L.marker([{{ $imovel->latitude }}, {{ $imovel->longitude }}]).addTo(map)
        .bindPopup('{!! $imovel->map_popup_content !!}');
</script>
@endpush
