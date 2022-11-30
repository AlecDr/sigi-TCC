@extends('layouts.app')

@section('title', __('imovel.list'))

@section('content')
<div class="mb-3">
    <br>
    <div class="float-right">
        @can('create', new App\Imovel)
            <a href="{{ route('imoveis.create') }}" class="btn btn-success">{{ __('imovel.create') }}</a>
        @endcan
    </div>
    <br>
    <h2 class="page-title">{{ __('imovel.list') }}</h2>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <input placeholder="{{ __('imovel.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('imovel.search') }}" class="btn btn-secondary">
                    <a href="{{ route('imoveis.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('imovel.tpImovel') }}</th>
                        <th>{{ __('imovel.seq') }}</th>
                        <th>{{ __('imovel.setor') }}</th>
                        <th>{{ __('imovel.quadra') }}</th>
                        <th>{{ __('imovel.lote') }}</th>
                        <th>{{ __('imovel.cpf') }}</th>
                        <th>{{ __('imovel.name_owner') }}</th>
                        <th>{{ __('imovel.latitude') }}</th>
                        <th>{{ __('imovel.longitude') }}</th>
                    <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($imoveis as $key => $imovel)
                    <tr>
                        <td class="text-center">{{ $imoveis->firstItem() + $key }}</td>
                        <td>{{$imovel->tpImovel}}</td>
                        <td>{!! $imovel->seq_link !!}</td>
                        <td>{{ $imovel->setor }}</td>
                        <td>{{ $imovel->quadra }}</td>
                        <td>{{ $imovel->lote }}</td>
                        <td>{{ $imovel->owner->cpf }}</td>
                        <td>{{ $imovel->owner->name_owner }}</td>
                        <td>{{ $imovel->latitude }}</td>
                        <td>{{ $imovel->longitude }}</td>

                        <td class="text-center">
                            <a href="{{ route('imoveis.show', $imovel->id) }}" id="show-imovel-{{ $imovel->id }}">{{ __('app.show') }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $imoveis->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
<small>{{ __('app.total') }} {{ __('imovel.imovel') }}  : {{ $imoveis->total() }} </small>
@endsection
