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
                        @if($solicitud->documentos_solicitante == null)
                        <div class="form-group">
                            {!! Form::label('solicitud_'.$solicitud->id, 'Documentos del Solicitante', ['class' => 'control-label']) !!}
                            <input type="file" id="solicitud_{{ $solicitud->id }}" style="display: none;" onchange="fileSelected({{ $solicitud->id }})"/>
                            <span class="help-block">
                                <span id="nombre_{{ $solicitud->id }}" class="label label-default"></span>
                                <span id="progreso_{{ $solicitud->id }}" class="label label-default"></span>
                            </span>
                            <button class="btn btn-success select-file-solicitud" type="button" data-id="{{ $solicitud->id }}">
                                <i class="fa fa-btn fa-file-zip-o"></i>Elegir Archivo
                            </button>
                            <button class="btn btn-primary upload-file-solicitud" type="button" data-id="{{ $solicitud->id }}" style="display: none;">
                                <i class="fa fa-btn fa-upload"></i>Subir Archivo
                            </button>
                        </div>
                        @endif

                        @if($solicitud->documentos_tecnicos == null)
                        {!! Form::open(['route' => ['solicitud.update', $solicitud->id], 'method' => 'PUT', 'class' => 'form-vertical']) !!}
                        <div class="form-group">
                            {!! Form::label('documentos_tecnicos', 'Documentos Técnicos', ['class' => 'control-label']) !!}
                            {!! Form::file('documentos_tecnicos', ['class' => 'form-control', 'style' => 'display: none;']) !!}
                            <button class="btn btn-success select-file-solicitud" type="button">
                                <i class="fa fa-btn fa-file-zip-o"></i>
                            </button>
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-btn fa-upload"></i>
                            </button>
                        </div>
                        {!! Form::close() !!}
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
@endsection

@section('script')
@parent
<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

$(document).on('click', '.select-file-solicitud', function(){
    var solicitudId = $(this).data('id');
    var solicitudFile = $(this).siblings('#solicitud_'+solicitudId);
    solicitudFile.click();
});

$(document).on('click', '.upload-file-solicitud', function(){
    var solicitudId = $(this).data('id');
    var file = $('#solicitud_'+solicitudId)[0].files[0];
    var formData = new FormData(this);
    formData.append('file', file);
    var ajaxSolicitud = new XMLHttpRequest();

    ajaxSolicitud.upload.addEventListener('progress', function(event){
        var progreso = (event.loaded / event.total) * 100;
        $('#progreso_'+solicitudId).html('Progreso: ' + Math.round(progreso) + '%');
    }, false);

    ajaxSolicitud.open('PUT', '/solicitud/upload/'+solicitudId, true);
    ajaxSolicitud.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
    ajaxSolicitud.send(formData);
});

function fileSelected(id){
    var file = $('#solicitud_'+id)[0].files[0];
    $('button.select-file-solicitud[data-id='+id+']').css('display', 'none');
    $('button.upload-file-solicitud[data-id='+id+']').css('display', 'block');
    $('#nombre_'+id).html('Archivo: ' + file.name);
    $('#progreso_'+id).html('Progreso: 0%');
}
</script>
@endsection
