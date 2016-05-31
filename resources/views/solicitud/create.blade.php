@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Solicitud de Delimitación Territorial</div>
                <div class="panel-body">
                {!! Form::open(array('id' => 'form-solicitud', 'files' => true, 'class' => 'form-horizontal', 'method' => 'POST', 'route' => 'solicitud.store')) !!}
                <div class="form-group{{ $errors->has('nombre_solicitante')?' has-error':'' }}">
                    {!! Form::label('nombre_solicitante', 'Nombre del Solicitante', array('class' => 'col-md-4 control-label')) !!}
                    <div class="col-md-6">
                        {!! Form::text('nombre_solicitante', null, $attributes = array('class' => 'form-control')) !!}

                        @if($errors->has('nombre_solicitante'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre_solicitante') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('tipo_limite')?' has-error':'' }}">
                    {!! Form::label('tipo_limite', 'Tipo de Límite', array('class' => 'col-md-4 control-label')) !!}
                    <div class="col-md-6">
                        {!! Form::select('tipo_limite', array('D' => 'D - Interdepartamental', 'M' => 'M - Intradepartamental'), null, $attributes = array('class' => 'form-control', 'placeholder' => 'Seleccione una opción')) !!}

                        @if($errors->has('tipo_limite'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tipo_limite') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('municipios')?' has-error':'' }}">
                   {!! Form::label('municipios', 'Municipios Solicitantes', array('class' => 'col-md-4 control-label')) !!}
                   <div class="col-md-6">
                       <select name="municipios[]" id="municipios" class="form-control">
                           @foreach($municipios as $municipio)
                           <option value="{{ $municipio->codigo }}">{{ $municipio->provincia->departamento->nombre }} - {{ $municipio->provincia->nombre }} - {{ $municipio->nombre }}</option>
                           @endforeach
                       </select>

                       @if($errors->has('municipios'))
                        <span class="help-block">
                            <strong>{{ $errors->first('municipios') }}</strong>
                        </span>
                        @endif
                   </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button id="enviar" type="submit" class="btn btn-primary">
                               <i class="fa fa-btn fa-send-o"></i>Enviar Solicitud
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
<script type="text/javascript">
    $('#municipios').select2({
        placeholder: "Selecciona municipio(s)",
        language: "es",
        allowClear: true
    });

    $(document).on('change', '#tipo_limite', function(){
        if($(this).val() == 'D'){
            $('#municipios').attr('multiple', 'multiple');
        }else if($(this).val() == 'M'){
            $('#municipios').removeAttr('multiple');
        }
        $('#municipios').select2({
            placeholder: "Selecciona municipio(s)",
            language: "es",
            allowClear: true
        });
    });
</script>
@endsection
