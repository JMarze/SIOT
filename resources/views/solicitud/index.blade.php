@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-md-offset-10">
            <a class="btn btn-success" href="{!! route('solicitud.create') !!}">
                <i class="fa fa-btn fa-plus"></i>Nueva Solicitud
            </a>
        </div>
    </div>

    <hr/>

    @if($solicitudes->total() > 0)
    <div class="row">
        @foreach($solicitudes as $solicitud)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">
                    @if($solicitud->tipo_limite == 'D')
                    D - Interdepartamental
                    @elseif($solicitud->tipo_limite == 'M')
                    M - Intradepartamental
                    @else
                    No definido
                    @endif
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <h3>{{ $solicitud->nombre_solicitante }}</h3>
                        @foreach($solicitud->municipios as $municipio)
                        <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="{{ $municipio->provincia->departamento->nombre }} - {{ $municipio->provincia->nombre }}">{{ $municipio->nombre }}</button>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('documentos_solicitante', 'Documentos del Solicitante', ['class' => 'control-label']) !!}
                        @if($solicitud->documentos_solicitante == null || $solicitud->documentos_solicitante == '')
                        <div class="btn-group" role="group" aria-label="Center Align">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#upload_solicitante" data-id="{{ $solicitud->id }}">
                                <i class="fa fa-btn fa-upload"></i>Subir .Zip
                            </button>
                        </div>
                        @else
                        <h5><span class="label label-default">{{ $solicitud->documentos_solicitante }}</span></h5>
                        @endif

                        {!! Form::label('documentos_tecnicos', 'Documentos Técnicos', ['class' => 'control-label']) !!}
                        @if($solicitud->documentos_tecnicos == null || $solicitud->documentos_tecnicos == '')
                        <div class="btn-group" role="group" aria-label="Center Align">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#upload_tecnico" data-id="{{ $solicitud->id }}">
                                <i class="fa fa-btn fa-upload"></i>Subir .Zip
                            </button>
                        </div>
                        @else
                        <h5><span class="label label-default">{{ $solicitud->documentos_tecnicos }}</span></h5>
                        @endif
                    </div>
                </div>
                <div class="panel-footer">
                    <h2 class="panel-title text-center">Solicitado {{ $solicitud->created_at->diffForHumans() }}<br/>({{ $solicitud->created_at->format('d/m/Y') }})</h2>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            {{ $solicitudes->render() }}
        </div>
    </div>
    @else
    <div class="container">
        <div class="alert alert-warning" role="alert">
            <i class="fa fa-btn fa-database"></i>
            <strong>Mensaje:</strong> No se encontraron solicitudes en la base de datos. Intenta <a href="{{ route('solicitud.create') }}" class="alert-link">agregar una nueva solicitud</a>
        </div>
    </div>
    @endif
</div>

@include('solicitud.partial.uploadsolicitante')
@include('solicitud.partial.uploadtecnico')

@endsection

@section('script')
@parent
<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

// Cambiar Id de la Solicitud
$(document).on('click', 'button[data-target="#upload_solicitante"]', function(e){
    var idSolicitud = $(this).attr('data-id');
    $('#form-upload-solicitante').attr('data-id', idSolicitud);
});
$(document).on('click', 'button[data-target="#upload_tecnico"]', function(e){
    var idSolicitud = $(this).attr('data-id');
    $('#form-upload-tecnico').attr('data-id', idSolicitud);
});

// Reset Form
function resetForm(obj){
    obj.find('form')[0].reset();
    $('.help-block>strong').html('');
    $('.has-error').removeClass('has-error');
}
</script>
@endsection
