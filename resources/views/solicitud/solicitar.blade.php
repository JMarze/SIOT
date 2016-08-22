@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-btn fa-eye"></i>Ver y/o editar archivos digitales
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

                    <table class="table table-hover">
                        <tr>
                            <th rowspan="2" style="vertical-align:middle;">Artículo</th>
                            <th colspan="2" style="text-align:center;">Fojas</th>
                            <th rowspan="2" style="text-align:center;vertical-align:middle;">Archivos (.zip)</th>
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
                        <tr>
                            <td>
                                @if($solicitud->tipo_limite == 'M')
                                <strong>{{ $documento->articulo_intra }}</strong> {{ str_replace("[texto]", $documento->texto_intra, $documento->descripcion) }}
                                @else
                                <strong>{{ $documento->articulo_inter }}</strong> {{ str_replace("[texto]", $documento->texto_inter, $documento->descripcion) }}
                                @endif
                            </td>
                            <td>{{ $documento->pivot->fojas_de }}</td>
                            <td>{{ $documento->pivot->fojas_a }}</td>
                            <td class="text-center">
                                @if($documento->pivot->archivo != null)
                                <span class="label label-default">{{ $documento->pivot->archivo }}</span>
                                @else
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#solicitud_archivo" data-id="{{ $documento->id }}">
                                    <i class="fa fa-btn fa-upload"></i>Subir archivo (.zip)
                                </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            @if($documentosFaltantes != 0)
                            <div class="alert alert-info" role="alert">
                                <i class="fa fa-btn fa-upload"></i>
                                <strong>Mensaje:</strong> Su solicitud aún no fué enviada para su revisión, debe subir
                                @if($documentosFaltantes > 1)
                                los {{ $documentosFaltantes }} archivos faltantes.
                                @else
                                el archivo faltante.
                                @endif
                            </div>
                            @else
                            <div class="alert alert-success" role="alert">
                                <p><i class="fa fa-btn fa-send-o"></i>
                                <strong>Mensaje:</strong> Ha subido todos los archivos necesarios, ahora puede proceder a enviar su Solicitud de Delimitación Territorial haciendo clic en el botón de Enviar Solicitud.</p>

                                <p>Por disposición del Artículo 232 del Texto Constitucional, hacemos saber que en caso de que surjan observaciones al tratamiento del proceso de referencia, la única entidad responsable es el
                                @if($solicitud->tipo_limite == 'M')
                                Gobierno Autónomo Departamental de {{ $solicitud->municipios->first()->provincia->departamento->nombre }}
                                @else
                                Ministerio de Autonomías
                                @endif
                                , en su calidad de autoridad de única instancia para la atención de estos procesos.</p>

                                {!! Form::open(['route' => ['solicitud.update', $solicitud->id], 'method' => 'PUT']) !!}
                                {!! Form::hidden('estado', 'revision') !!}
                                <p class="text-right">
                                    <button type="submit" class="btn btn-success">
                                        Enviar Solicitud
                                    </button>
                                </p>
                                {!! Form::close() !!}
                            </div>
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
