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
                    <i class="fa fa-btn fa-map-marker"></i>Solicitudes
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

                                    <button type="button" class="btn btn-sm btn-success" data-toggle="popover" data-placement="top" data-trigger="focus" title="Solicitud revisada" data-content="Su solicitud fué revisada satisfactoriamente el {{ $solicitud->etapa_inicio->updated_at->format('d/m/Y') }}, ahora cuenta con un código único. Gracias." data-container="body">
                                        <i class="fa fa-check-square-o"></i>
                                        <span class="sr-only">Solicitud revisada</span>
                                    </button>

                                @else

                                    @if($solicitud->estado == 'solicitud')
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="popover" data-placement="top" data-trigger="focus" title="Solicitud no enviada" data-content="Su solicitud aún no fué enviada, debe subir los archivos digitales comprimidos (en formato .zip) para que su solicitud sea enviada. Gracias." data-container="body">
                                        <i class="fa fa-warning"></i>
                                        <span class="sr-only">Solicitud no enviada</span>
                                    </button>
                                    @elseif($solicitud->estado == 'revision')
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-placement="top" data-trigger="focus" title="Solicitud en revisión" data-content="Su solicitud fué enviada para su respectiva revisión, debe esperar @if($solicitud->tipo_limite == 'D')10 @else 15 @endif días hábiles para dicha revisión. Gracias." data-container="body">
                                        <i class="fa fa-clock-o"></i>
                                        <span class="sr-only">Solicitud en revisión</span>
                                    </button>
                                    @elseif($solicitud->estado == 'adicional')
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-placement="top" data-trigger="focus" title="Solicitud requiere información adicional" data-content="Su solicitud fué revisada y requiere información adicional, debe esperar 10 días hábiles para solicitar dicha información. Gracias." data-container="body">
                                        <i class="fa fa-clock-o"></i>
                                        <span class="sr-only">Solicitud requiere información adicional</span>
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

                                    @if(!Auth::guest() && (Auth::user()->role == 'admin' || Auth::user()->role == 'user'))

                                        @if($solicitud->estado == 'solicitud')
                                            <a href="#" class="btn btn-sm btn-default" title="Eliminar solicitud" data-toggle="modal" data-target="#destroy" data-id="{{ $solicitud->id }}">
                                                <i class="fa fa-trash"></i>
                                                <span class="sr-only">Eliminar solicitud</span>
                                            </a>
                                        @elseif($solicitud->estado == 'revision')
                                            @if(!Auth::guest() && Auth::user()->role == 'admin')
                                            <a href="{{ route('solicitud.revisar', $solicitud->id) }}" class="btn btn-sm btn-default" title="Revisar solicitud">
                                                <i class="fa fa-check"></i>
                                                <span class="sr-only">Revisar solicitud</span>
                                            </a>
                                            @endif
                                        @endif

                                    @endif

                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <h5 class="col-md-6 text-right"><label class="control-label">Autoridad Soliciante:</label></h5>
                                <h5 class="col-md-6 text-left">{{ $solicitud->nombre_solicitante }}</h5>
                            </div>
                            <div class="row">
                                <h5 class="col-md-6 text-right">
                                    <label class="control-label">
                                        @if($solicitud->municipios()->count() > 1)
                                        Municipios Solicitantes:
                                        @else
                                        Municipio Solicitante:
                                        @endif
                                    </label>
                                </h5>
                                <h5 class="col-md-6 text-left">
                                    @foreach($solicitud->municipios as $municipio)
                                    <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="{{ $municipio->provincia->departamento->nombre }} - {{ $municipio->provincia->nombre }}">{{ $municipio->nombre }}</button>
                                    @endforeach
                                </h5>
                            </div>
                            <hr/>
                            <div class="row">
                                @if($solicitud->estado == 'solicitud')
                                <div class="col-md-10 col-md-offset-1">
                                    <a href="{{ route('solicitud.solicitar', $solicitud->id) }}" type="button" class="btn btn-default btn-block">
                                        <i class="fa fa-btn fa-eye"></i>Ver y/o editar archivos digitales
                                    </a>
                                </div>
                                @elseif($solicitud->estado == 'revision')
                                <div class="col-md-12 text-center">
                                    Solicitud enviada el {{ $solicitud->updated_at->format('d/m/Y') }}, se necesitan: <br/>
                                    <h4 class="text-center"><label class="label label-default">
                                        <i class="fa fa-btn fa-clock-o"></i>
                                        @if($solicitud->tipo_limite == 'D')
                                        10 días hábiles para su revisión
                                        @else
                                        15 días hábiles para su revisión
                                        @endif
                                    </label></h4>
                                    La fecha límite para dicha revisión es:
                                    <h4 class="text-center"><label class="label label-default">
                                        <i class="fa fa-btn fa-calendar"></i>
                                        @if($solicitud->tipo_limite == 'D')
                                        {{ $solicitud->updated_at->addWeekdays(10)->format('d/m/Y') }}
                                        @else
                                        {{ $solicitud->updated_at->addWeekdays(15)->format('d/m/Y') }}
                                        @endif
                                    </label></h4>
                                </div>
                                @elseif($solicitud->estado == 'adicional')
                                <div class="col-md-12 text-center">
                                    Solicitud revisada el {{ $solicitud->updated_at->format('d/m/Y') }}, se necesitan: <br/>
                                    <h4 class="text-center"><label class="label label-default">
                                        <i class="fa fa-btn fa-clock-o"></i>
                                        10 días hábiles para información adicional
                                    </label></h4>
                                    La fecha límite para dicha información adicional es:
                                    <h4 class="text-center"><label class="label label-default">
                                        <i class="fa fa-btn fa-calendar"></i>
                                        {{ $solicitud->updated_at->addWeekdays(10)->format('d/m/Y') }}
                                    </label></h4>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="panel-footer">
                            <h2 class="panel-title text-center">

                            @if($solicitud->etapa_inicio == null)

                                @if($solicitud->estado == 'solicitud')
                                    <h4 class="text-center"><span class="label label-warning">
                                        <strong>Estado: </strong><i class="fa fa-btn fa-warning"></i>No enviado
                                    </span></h4>
                                @elseif($solicitud->estado == 'revision')
                                    <h4 class="text-center"><span class="label label-info">
                                        <strong>Estado: </strong><i class="fa fa-btn fa-clock-o"></i>Revisando...
                                    </span></h4>
                                @elseif($solicitud->estado == 'adicional')
                                    <h4 class="text-center"><span class="label label-info">
                                        <strong>Estado: </strong><i class="fa fa-btn fa-clock-o"></i>Información adicional
                                    </span></h4>
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

@include('solicitud.partial.destroy')

@endsection

@section('script')
@parent
<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
});

// Llenar Form -> Eliminar
$(document).on('click', 'a[data-target="#destroy"]', function(e){
    var idSolicitud = $(this).attr('data-id');
    var url = '/solicitud/' + idSolicitud + '/edit';
    var data = 'solicitud=' + idSolicitud;
    $.ajax({
        url: url,
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        method: 'GET',
        dataType: 'JSON',
        data: data,
        beforeSend: function(e){
            $('#msg-destroy').css('display', 'block');
            $('#form-destroy').css('display', 'none');
        }
    }).done(function (response){
        $('#question-destroy').html("¿Está seguro de eliminar la solicitud de: <i>"+ response['solicitud']['nombre_solicitante'] +"</i>?");
        $('#btn-eliminar').css('display', 'inline-block');

        $('#msg-destroy').css('display', 'none');
        $('#form-destroy').css('display', 'block');
        $('#form-destroy').attr('data-id', idSolicitud);
    });
});

// Reset Form
function resetForm(obj){
    obj.find('form')[0].reset();
    $('.help-block>strong').html('');
    $('.has-error').removeClass('has-error');
}
</script>
@endsection
