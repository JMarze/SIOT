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
                Autoridad solicitante: <strong>{{ $solicitud->nombre_solicitante }}</strong> para
                @if($solicitud->tipo_limite == 'M')
                el municipio:
                @else
                los municipios:
                @endif

                <div style="display:inline;">
                @foreach($solicitud->municipios as $municipio)
                <button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="bottom" title="{{ $municipio->provincia->departamento->nombre }} - {{ $municipio->provincia->nombre }}">{{ $municipio->nombre }}</button>
                @endforeach
                </div>

                <hr/>

                {!! Form::open(array('id' => 'form-solicitud', 'files' => 'true', 'class' => 'form-horizontal', 'method' => 'POST', 'route' => ['solicitud.update', 'solicitud' => $solicitud->id])) !!}
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

                @foreach($documentosDigitales as $documento)
                    <tr>
                        <td><b>{{ $documento['articulo'] }}</b> {{ $documento['descripcion'] }}</td>
                        <td>
                            @if($solicitud->documentosDigitales->contains('id', $documento['id']))
                            {{--SI ({{ $solicitud->documentosDigitales->whereLoose('id', $documento['id']) }})--}}
                            SI ({{ dd($solicitud->documentosDigitales()->where('id', '2')->get()) }})
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            -
                        </td>
                        <td>
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#solicitud_archivo" data-id="{{ $documento['id'] }}">
                                <i class="fa fa-btn fa-upload"></i>Subir archivo (.zip)
                            </button>
                        </td>
                    </tr>
                @endforeach

                </table>
                {!! Form::close() !!}

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
