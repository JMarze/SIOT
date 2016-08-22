<div class="modal fade" id="solicitud_archivo" tabindex="-1" role="dialog" aria-labelledby="Subir archivo de solicitud">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Subir archivo de solicitud">
                    <i class="fa fa-btn fa-file-archive-o"></i>Subir archivo de solicitud
                </h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['route' => ['solicitud.subir_solicitud', 'IDSOLICITUD', 'IDDOCUMENTODIGITAL'], 'method' => 'PUT', 'id' => 'form-solicitud_archivo', 'class' => 'form-horizontal']) !!}

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

                <div class="form-group wrapper-solicitud_archivo">
                    {!! Form::label('archivo', 'Subir archivo (.zip)', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::file('archivo', ['class' => 'form-control']) !!}
                    <span class="help-block">
                        <strong></strong>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </span>
                    </div>
                </div>

                <div class="alert alert-warning" role="alert">
                    <i class="fa fa-btn fa-warning"></i>
                    <strong>Mensaje:</strong> ¿Está seguro de enviar la información que acaba de detallar?
                </div>

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-subir-archivo" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-upload"></i>Subir archivo
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    $('.modal#solicitud_archivo').on('show.bs.modal', function(e){
        resetForm($(this));
        progressBar.width('0%');
        progressBar.attr('aria-valuenow', '0');
        progressBar.html('0%');
    });
    $('.modal#solicitud_archivo').on('hidden.bs.modal', function(e){
        resetForm($(this));
        progressBar.width('0%');
        progressBar.attr('aria-valuenow', '0');
        progressBar.html('0%');
    });
    // Subir archivo de solicitud
    var formSolicitudArchivo = $('#form-solicitud_archivo');
    var progressBar = $('.progress .progress-bar');
    $(document).on('click', '#btn-subir-archivo', function(){
        var url = formSolicitudArchivo.attr('action').split('/');
        url[url.length-1] = formSolicitudArchivo.attr('data-documento');
        url[url.length-3] = formSolicitudArchivo.attr('data-solicitud');
        url = url.join("/");
        formSolicitudArchivo.attr('action', url);
        formSolicitudArchivo.submit();
    });
    // Ajax
    formSolicitudArchivo.ajaxForm({
        beforeSend: function (){
            progressBar.width('0%');
            progressBar.attr('aria-valuenow', '0');
            progressBar.html('0%');
        },
        uploadProgress: function (event, position, total, percentComplete){
            progressBar.width(percentComplete + '%');
            progressBar.attr('aria-valuenow', percentComplete);
            progressBar.html(percentComplete + '%');
        },
        success: function (){
            progressBar.width('100%');
            progressBar.attr('aria-valuenow', '100');
            progressBar.html('100%');
            location.reload();
        },
        complete: function (response){},
        error: function (response){
            if(response.responseJSON['archivo']){
                $('.wrapper-solicitud_archivo').addClass('has-error');
                $('.wrapper-solicitud_archivo .help-block>strong').html(response.responseJSON['archivo']);
            }else{
                $('.wrapper-solicitud_archivo').removeClass('has-error');
                $('.wrapper-solicitud_archivo .help-block>strong').html('');
            }
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
