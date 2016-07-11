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

                    @foreach($documentosDigitales as $documento)
                    <div class="form-group">
                        {!! Form::label('documento_'.$documento->id, $documento->descripcion, array('class' => 'col-md-6 control-label')) !!}
                        <div class="col-md-4">
                            {!! Form::select('documento_'.$documento->id, ['cumple' => 'Cumple', 'no_cumple' => 'No cumple', 'no_corresponde' => 'No corresponde'], 'no_cumple', $attributes = array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    @endforeach

                    <hr/>

                    <div class="form-group{{ $errors->has('informe_tecnico')?' has-error':'' }}">
                        {!! Form::label('informe_tecnico', 'Subir informe técnico', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::file('informe_tecnico', $attributes = array('class' => 'form-control')) !!}

                            @if($errors->has('informe_tecnico'))
                            <span class="help-block">
                                <strong>{{ $errors->first('informe_tecnico') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('informe_pronunciamiento')?' has-error':'' }}">
                        {!! Form::label('informe_pronunciamiento', 'Subir informe pronunciamiento', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::file('informe_pronunciamiento', $attributes = array('class' => 'form-control')) !!}

                            @if($errors->has('informe_pronunciamiento'))
                            <span class="help-block">
                                <strong>{{ $errors->first('informe_pronunciamiento') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('estado')?' has-error':'' }}">
                        {!! Form::label('estado', 'Estado de la etapa', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::select('estado', ['adicional' => 'Requiere informacón adicional', 'admisión' => 'La solicitud fué admitida', 'subsanación' => 'Requiere subsanación en la información', 'pronunciamiento' => 'Esperando el prounicuamiento de colindantes', 'informe pronunciamiento' => 'Informe de pronunciamiento elaborado', 'coordinacion' => 'En coordinación', 'cierre' => 'Etapa de inicio finalizada', 'archivado' => 'Solicitud archivada'], null, $attributes = array('class' => 'form-control', 'placeholder' => 'Seleccione un estado')) !!}

                            @if($errors->has('estado'))
                            <span class="help-block">
                                <strong>{{ $errors->first('estado') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('acta_cierre')?' has-error':'' }}">
                        {!! Form::label('acta_cierre', 'Subir acta de cierre', array('class' => 'col-md-4 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::file('acta_cierre', $attributes = array('class' => 'form-control')) !!}

                            @if($errors->has('acta_cierre'))
                            <span class="help-block">
                                <strong>{{ $errors->first('acta_cierre') }}</strong>
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
