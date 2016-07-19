@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-btn fa-check"></i>Crear Registro (Etapa de Inicio)
                </div>
                <div class="panel-body">
                    Solicitado por <strong>{{ $solicitud->nombre_solicitante }}</strong> para
                    @if($solicitud->tipo_limite == 'M')
                    el municipio:
                    @else
                    los municipios:
                    @endif

                    @foreach($solicitud->municipios as $municipio)
                    <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="{{ $municipio->provincia->departamento->nombre }} - {{ $municipio->provincia->nombre }}">{{ $municipio->nombre }}</button>
                    @endforeach

                    <hr/>

                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('etapa_inicio.descargar_solicitante', $solicitud->id) }}" class="btn btn-primary btn-block">
                                <i class="fa fa-btn fa-download"></i>Descargar archivos del solicitante
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('etapa_inicio.descargar_tecnico', $solicitud->id) }}" class="btn btn-primary btn-block">
                                <i class="fa fa-btn fa-download"></i>Descargar archivos técnicos
                            </a>
                        </div>
                    </div>

                    <hr/>

                    {!! Form::open(array('id' => 'form-etapa_inicio', 'files' => 'true', 'class' => 'form-horizontal', 'method' => 'POST', 'route' => ['etapa_inicio.store', 'solicitud' => $solicitud->id])) !!}

                    <div class="form-group{{ $errors->has('solicitud_id')?' has-error':'' }}">
                        {!! Form::hidden('solicitud_id', $solicitud->id, $attributes = array('class' => 'form-control')) !!}
                        <div class="col-md-6">
                        @if($errors->has('solicitud_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('solicitud_id') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    @foreach($documentosDigitales as $documento)
                    <div class="form-group">
                        {!! Form::label('documento_'.$documento->id, $documento->descripcion, array('class' => 'col-md-6 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::select('documento_'.$documento->id, ['cumple' => 'Cumple', 'no_cumple' => 'No cumple', 'no_corresponde' => 'No corresponde'], 'no_cumple', $attributes = array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    @endforeach

                    <hr/>

                    <div class="form-group{{ $errors->has('informe_tecnico_legal')?' has-error':'' }}">
                        {!! Form::label('informe_tecnico_legal', 'Subir informe técnico', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::file('informe_tecnico_legal', $attributes = array('class' => 'form-control')) !!}

                            @if($errors->has('informe_tecnico_legal'))
                            <span class="help-block">
                                <strong>{{ $errors->first('informe_tecnico_legal') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('nota')?' has-error':'' }}">
                        {!! Form::label('nota', 'Subir nota de admisión o subsanación', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::file('nota', $attributes = array('class' => 'form-control')) !!}

                            @if($errors->has('nota'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nota') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('estado')?' has-error':'' }}">
                        {!! Form::label('estado', 'Estado de la etapa', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::select('estado', ['adicional' => 'Solicitud de información adicional', 'admision' => 'Nota de admisión', 'subsanacion' => 'Nota de subsanación'], null, $attributes = array('class' => 'form-control', 'placeholder' => 'Seleccione un estado')) !!}

                            @if($errors->has('estado'))
                            <span class="help-block">
                                <strong>{{ $errors->first('estado') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button id="enviar" type="submit" class="btn btn-primary">
                                   <i class="fa fa-btn fa-send-o"></i>Guardar y Generar código
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});
</script>
@endsection
