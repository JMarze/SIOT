<div class="modal fade" id="editar_solicitud_archivo" tabindex="-1" role="dialog" aria-labelledby="Editar fojas de solicitud">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Editar fojas de solicitud">
                    <i class="fa fa-btn fa-edit"></i>Editar fojas de solicitud
                </h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['route' => ['solicitud.editar_solicitud_documento', $solicitud->id, 'IDDOCUMENTODIGITAL'], 'method' => 'PUT', 'id' => 'form-editar_solicitud_archivo', 'class' => 'form-horizontal']) !!}

                <div class="form-group wrapper-fojas_de">
                    {!! Form::label('fojas_de', 'Fojas de', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::number('fojas_de', 0, ['class' => 'form-control', 'step' => '1', 'min' => '0']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="form-group wrapper-fojas_a">
                    {!! Form::label('fojas_a', 'Fojas a', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::number('fojas_a', 0, ['class' => 'form-control', 'step' => '1', 'min' => '0']) !!}
                    <span class="help-block">
                        <strong></strong>
                    </span>
                    </div>
                </div>

                <div class="alert alert-warning" role="alert">
                    <i class="fa fa-btn fa-warning"></i>
                    <strong>Mensaje:</strong> Declaro la veracidad de los datos registrados y el correcto cargado de información
                </div>

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-editar-fojas" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-edit"></i>Editar fojas
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    $('.modal#editar_solicitud_archivo').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#editar_solicitud_archivo').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });
    // Editar fojas de solicitud
    var formEditarSolicitud = $('#form-editar_solicitud_archivo');
    $(document).on('click', '#btn-editar-fojas', function(){
        var url = formEditarSolicitud.attr('action').split('/');
        url[url.length-1] = formEditarSolicitud.attr('data-documento');
        url = url.join("/");

        formEditarSolicitud.attr('action', url);
        formEditarSolicitud.submit();
    });
    // Ajax
    formEditarSolicitud.ajaxForm({
        success: function (){
            location.reload();
        },
        complete: function (response){},
        error: function (response){
            if(response.responseJSON['fojas_de']){
                $('.wrapper-fojas_de').addClass('has-error');
                $('.wrapper-fojas_de .help-block>strong').html(response.responseJSON['fojas_de']);
            }else{
                $('.wrapper-fojas_de').removeClass('has-error');
                $('.wrapper-fojas_de .help-block>strong').html('');
            }
            if(response.responseJSON['fojas_a']){
                $('.wrapper-fojas_a').addClass('has-error');
                $('.wrapper-fojas_a .help-block>strong').html(response.responseJSON['fojas_a']);
            }else{
                $('.wrapper-fojas_a').removeClass('has-error');
                $('.wrapper-fojas_a .help-block>strong').html('');
            }
        }
    });
</script>
@endsection
