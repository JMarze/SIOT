@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-panel" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ route('solicitud.index') }}" class="navbar-brand">
                    <i class="fa fa-btn fa-external-link"></i>Solicitudes
                </a>
            </div>
            <div class="collapse navbar-collapse" id="menu-panel">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ route('solicitud.create') }}">
                            <i class="fa fa-btn fa-plus"></i>Nueva Solicitud
                        </a>
                    </li>
               </ul>
            </div>
        </nav>

        <div class="panel-body">
            @if($solicitudes->total() > 0)
            <div class="row">
                @foreach($solicitudes as $solicitud)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-2">
                                @if($solicitud->etapa_inicio != null)

                                    <button type="button" class="btn btn-sm btn-success" data-toggle="popover" data-placement="top" data-trigger="focus" title="Solicitud revisada" data-content="Su solicitud fué revisada satisfactoriamente el {{ $solicitud->etapa_inicio->created_at->format('d/m/Y') }}, ahora cuenta con un código único. Gracias." data-container="body">
                                        <i class="fa fa-check-square-o"></i>
                                    </button>

                                @else

                                    @if(($solicitud->documentos_solicitante != null && $solicitud->documentos_solicitante != '') && ($solicitud->documentos_tecnicos != null || $solicitud->documentos_tecnicos != ''))
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="popover" data-placement="top" data-trigger="focus" title="Solicitud enviada" data-content="Su solicitud fué enviada satisfactoriamente el {{ $solicitud->created_at->format('d/m/Y') }}, ahora debe esperar 10 días hábiles para la generación de su código. Gracias." data-container="body">
                                        <i class="fa fa-send"></i>
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="popover" data-placement="top" data-trigger="focus" title="Solicitud no enviada" data-content="Su solicitud aún no fué enviada, debe subir los archivos digitales comprimidos para que su solicitud sea enviada. Gracias." data-container="body">
                                        <i class="fa fa-warning"></i>
                                    </button>
                                    @endif

                                @endif
                                </div>
                                <div class="col-md-8">
                                    <h2 class="panel-title text-center" style="margin: 6px 0;">
                                    @if($solicitud->tipo_limite == 'D')
                                    D - Interdepartamental
                                    @elseif($solicitud->tipo_limite == 'M')
                                    M - Intradepartamental
                                    @else
                                    No definido
                                    @endif
                                    </h2>
                                </div>
                                <div class="col-md-2">
                                @if($solicitud->etapa_inicio == null)

                                    @if(($solicitud->documentos_solicitante != null && $solicitud->documentos_solicitante != '') && ($solicitud->documentos_tecnicos != null || $solicitud->documentos_tecnicos != ''))
                                    <a href="{{ route('etapa_inicio.create', ['solicitud' => $solicitud->id]) }}" class="btn btn-sm btn-success" title="Revisar solicitud">
                                        <i class="fa fa-check"></i>
                                    </a>
                                    @else
                                    <a href="#" class="btn btn-sm btn-default" title="Eliminar solicitud">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @endif

                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-5">
                                <h4>{{ $solicitud->nombre_solicitante }}</h4>
                                @foreach($solicitud->municipios as $municipio)
                                <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="{{ $municipio->provincia->departamento->nombre }} - {{ $municipio->provincia->nombre }}">{{ $municipio->nombre }}</button>
                                @endforeach
                            </div>
                            <div class="col-md-7">
                                {!! Form::label('documentos_solicitante', 'Documentos del Solicitante', ['class' => 'control-label']) !!}

                                @if($solicitud->etapa_inicio == null)

                                    @if($solicitud->documentos_solicitante == null || $solicitud->documentos_solicitante == '')
                                    <div class="btn-group" role="group" aria-label="Center Align">
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#upload_solicitante" data-id="{{ $solicitud->id }}">
                                            <i class="fa fa-btn fa-upload"></i>Subir .Zip
                                        </button>
                                    </div>
                                    @else
                                    <h5><span class="label label-default">{{ $solicitud->documentos_solicitante }}</span></h5>
                                    @endif

                                @else

                                <h5>
                                    <span class="label label-success">
                                        <i class="fa fa-btn fa-check"></i>Revisado
                                    </span>
                                </h5>

                                @endif

                                {!! Form::label('documentos_tecnicos', 'Documentos Técnicos', ['class' => 'control-label']) !!}

                                @if($solicitud->etapa_inicio == null)

                                    @if($solicitud->documentos_tecnicos == null || $solicitud->documentos_tecnicos == '')
                                    <div class="btn-group" role="group" aria-label="Center Align">
                                        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#upload_tecnico" data-id="{{ $solicitud->id }}">
                                            <i class="fa fa-btn fa-upload"></i>Subir .Zip
                                        </button>
                                    </div>
                                    @else
                                    <h5><span class="label label-default">{{ $solicitud->documentos_tecnicos }}</span></h5>
                                    @endif

                                @else

                                <h5>
                                    <span class="label label-success">
                                        <i class="fa fa-btn fa-check"></i>Revisado
                                    </span>
                                </h5>

                                @endif
                            </div>
                        </div>
                        <div class="panel-footer">
                            <h2 class="panel-title text-center">

                            @if($solicitud->etapa_inicio == null)

                                @if(($solicitud->documentos_solicitante != null && $solicitud->documentos_solicitante != '') && ($solicitud->documentos_tecnicos != null || $solicitud->documentos_tecnicos != ''))
                                    Su solicitud fué enviada, se necesitan:<br/>
                                    <span class="label label-default"><i class="fa fa-btn fa-clock-o"></i>10 días hábiles para su revisión.</span>
                                    <br/><br/>
                                    La fecha límite para este proceso es:<br/>
                                    <span class="label label-default"><i class="fa fa-btn fa-calendar"></i>{{ $solicitud->created_at->addWeekdays(10)->format('d/m/Y') }}</span>
                                    <br/><br/>
                                    <span class="label label-primary">
                                        <strong>Estado: </strong><i class="fa fa-btn fa-clock-o"></i>Revisando...
                                    </span>
                                @else
                                    Suba los documentos digitales para que su solicitud sea enviada. <br/>
                                    <span class="label label-warning">
                                        <strong>Estado: </strong><i class="fa fa-btn fa-warning"></i>No enviado
                                    </span>
                                @endif

                            @else

                                Se asignó el siguiente código único a su solicitud:<br/>
                                <span class="label label-success"><i class="fa fa-btn fa-key"></i>{{ $solicitud->etapa_inicio->codigo }}</span>
                                <br/><br/>
                                @if($solicitud->etapa_inicio->estado == 'adicional')
                                <span class="label label-info">
                                    <strong>Estado: </strong><i class="fa fa-btn fa-plus-square"></i>Solicitud de Información adicional
                                </span>
                                @elseif($solicitud->etapa_inicio->estado == 'admision')
                                <span class="label label-success">
                                    <strong>Estado: </strong><i class="fa fa-btn fa-check"></i>Admisión
                                </span>
                                @elseif($solicitud->etapa_inicio->estado == 'subsanacion')
                                <span class="label label-warning">
                                    <strong>Estado: </strong><i class="fa fa-btn fa-refresh"></i>Subsanación
                                </span>
                                @endif

                            @endif
                            </h2>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="panel-footer">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    {{ $solicitudes->render() }}
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-warning" role="alert">
            <i class="fa fa-btn fa-database"></i>
            <strong>Mensaje:</strong> No se encontraron solicitudes en la base de datos. Intenta <a href="{{ route('solicitud.create') }}" class="alert-link">agregar una nueva solicitud</a>
        </div>
        @endif
    </div>
</div>

@include('solicitud.partial.uploadsolicitante')
@include('solicitud.partial.uploadtecnico')

@endsection

@section('script')
@parent
<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
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
