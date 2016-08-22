@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-btn fa-check"></i>Revisar archivos digitales
                </div>
                <div class="panel-body">
                    <h3>Solicitud de Delimintación Territorial
                        <span class="label label-default">
                            @if($solicitud->tipo_limite == 'M')
                            Intradepartamental
                            @else
                            Interdepartamental
                            @endif
                        </span>
                    </h3>

                    <hr/>

                    <h4>Autoridad solicitante: <span class="label label-default">{{ $solicitud->nombre_solicitante }}</span> para
                    @if($solicitud->tipo_limite == 'M')
                    el municipio de:
                    @else
                    los municipios de:
                    @endif

                        <div style="display:inline;">
                            @foreach($solicitud->municipios as $municipio)
                            <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="{{ $municipio->provincia->departamento->nombre }} - {{ $municipio->provincia->nombre }}">{{ $municipio->nombre }}</button>
                            @endforeach
                        </div>
                    </h4>

                    <hr/>

                    {!! Form::open(['route' => ['solicitud.revision', $solicitud->id], 'id' => 'frm_revision']) !!}
                    <table class="table table-hover">
                        <tr>
                            <th rowspan="2" style="vertical-align:middle;">Artículo</th>
                            <th colspan="2" style="text-align:center;">Fojas</th>
                            <th rowspan="2" style="text-align:center;vertical-align:middle;">Archivos (.zip)</th>
                            <th rowspan="2" style="text-align:center;vertical-align:middle;">Observaciones</th>
                            <th rowspan="2" style="text-align:center;vertical-align:middle;">¿Cumple?</th>
                            <th rowspan="2" style="text-align:center;vertical-align:middle;">Estado</th>
                        </tr>
                        <tr>
                            <th style="text-align:center;">De</th>
                            <th style="text-align:center;">A</th>
                        </tr>

                        <?php
                            $orden = '';
                            if($solicitud->tipo_limite == 'M'){
                                $orden = 'articulo_intra';
                            }else{
                                $orden = 'articulo_inter';
                            }
                        ?>

                        @foreach($solicitud->documentosSolicitud->sortBy($orden) as $documento)
                        {!! Form::hidden('documento[]', $documento->id) !!}

                        @if($documento->pivot->estado == 'adicional')
                        <tr class="info">
                        @elseif($documento->pivot->estado == 'subsanacion')
                        <tr class="warning">
                        @elseif($documento->pivot->estado == 'admision')
                        <tr class="success">
                        @elseif($documento->pivot->cumple == 'no corresponde')
                        <tr class="danger">
                        @else
                        <tr>
                        @endif
                            <td style="width:40%;">
                                @if($solicitud->tipo_limite == 'M')
                                <strong>{{ $documento->articulo_intra }}</strong> {{ str_replace("[texto]", $documento->texto_intra, $documento->descripcion) }}
                                @else
                                <strong>{{ $documento->articulo_inter }}</strong> {{ str_replace("[texto]", $documento->texto_inter, $documento->descripcion) }}
                                @endif
                            </td>
                            <td>{{ $documento->pivot->fojas_de }}</td>
                            <td>{{ $documento->pivot->fojas_a }}</td>
                            <td class="text-center">
                                <a href="{{ route('solicitud.descargar', [$solicitud->id, $documento->pivot->archivo]) }}" class="btn btn-default">
                                    <i class="fa fa-btn fa-download"></i>Descargar
                                </a>
                            </td>
                            <td>
                                {!! Form::textarea('observacion[]', $documento->pivot->observaciones, ['class' => 'form-control', 'style' => 'height:50px;width:150px;']) !!}
                            </td>
                            <td>
                                {!! Form::select('cumple[]', ['si' => 'Cumple', 'no' => 'No cumple', 'no corresponde' => 'No corresponde'], $documento->pivot->cumple, ['class' => 'form-control', 'placeholder' => '-']) !!}
                            </td>
                            <td>
                                {!! Form::select('estado[]', ['adicional' => 'Adicional', 'subsanacion' => 'Subsanación', 'admision' => 'Admisión'], $documento->pivot->estado, ['class' => 'form-control', 'placeholder' => '-']) !!}
                            </td>
                        </tr>
                        @endforeach

                    </table>
                    {!! Form::close() !!}
                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            @if($revisionesFaltantes > 0)
                            <div class="alert alert-info" role="alert">
                                <p><i class="fa fa-btn fa-check"></i>
                                <strong>Mensaje:</strong> Revice todos los documentos enviados y remita sus observaciones (si fuese necesario).</p>

                                <p class="text-right">
                                    <button form="frm_revision" type="submit" class="btn btn-info">
                                        <i class="fa fa-btn fa-save"></i>Guardar progreso de la revisión
                                    </button>
                                </p>
                            </div>
                            @else
                            {!! Form::open(['route' => ['solicitud.update', $solicitud->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                            <div class="alert alert-success" role="alert">
                                <p><i class="fa fa-btn fa-check"></i>
                                <strong>Mensaje:</strong> Todos los archivos fueron revisados. Reenvíe el formulario indicando el estado de la solicitud.</p>

                                <p class="text-right">
                                    {!! Form::select('estado', ['adicional' => 'Se requiere información adicional para algunos archivos', 'subsanacion' => 'Se requiere subsanación para algunos archivos', 'admision' => 'Solicitud admitida, se generará el código único'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione estado de la solicitud']) !!}
                                    <br/>
                                    <button class="btn btn-success">
                                        <i class="fa fa-btn fa-save"></i>Terminar revisión
                                    </button>
                                </p>
                            </div>
                            {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('solicitud.partial.solicitud_archivo')

@endsection

@section('script')
@parent
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    // Cambio de Id para la Solicitud
    $(document).on('click', 'button[data-target="#solicitud_archivo"]', function(e){
        var idDocumento = $(this).attr('data-id');
        $('#form-solicitud_archivo').attr('data-solicitud', {{ $solicitud->id }});
        $('#form-solicitud_archivo').attr('data-documento', idDocumento);
    });

    // Reset Form
    function resetForm(obj){
        obj.find('form')[0].reset();
        $('.help-block>strong').html('');
        $('.has-error').removeClass('has-error');
    }
</script>
@endsection
