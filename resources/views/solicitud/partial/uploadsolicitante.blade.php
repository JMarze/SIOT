<div class="modal fade" id="upload_solicitante" tabindex="-1" role="dialog" aria-labelledby="Subir Documentos del Solicitante">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Subir Documentos del Solicitante">
                    <i class="fa fa-btn fa-cubes"></i>Subir Documentos del Solicitante
                </h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['route' => ['solicitud.upload.solicitante', 'IDSOLICITUD'], 'method' => 'PUT', 'id' => 'form-upload-solicitante', 'class' => 'form-horizontal']) !!}

                <div class="form-group wrapper-solicitante">
                    {!! Form::label('documentos_solicitante', 'Documentos del Solicitante', ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                    {!! Form::file('documentos_solicitante', ['class' => 'form-control']) !!}
                    <span class="help-block">
                        <strong></strong>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </span>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-subir-solicitante" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-upload"></i>Subir Documentos del Solicitante
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    $('.modal#upload_solicitante').on('show.bs.modal', function(e){
        resetForm($(this));
        progressBar.width('0%');
        progressBar.attr('aria-valuenow', '0');
        progressBar.html('0%');
    });
    $('.modal#upload_solicitante').on('hidden.bs.modal', function(e){
        resetForm($(this));
        progressBar.width('0%');
        progressBar.attr('aria-valuenow', '0');
        progressBar.html('0%');
    });
    // Subir Documentos del Solicitante
    var formUploadSolicitante = $('#form-upload-solicitante');
    var progressBar = $('.progress .progress-bar');
    $(document).on('click', '#btn-subir-solicitante', function(){
        var url = formUploadSolicitante.attr('action').split('/');
        url[url.length-1] = formUploadSolicitante.attr('data-id');
        url = url.join("/");
        formUploadSolicitante.attr('action', url);
        formUploadSolicitante.submit();
    });
    // Ajax
    formUploadSolicitante.ajaxForm({
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
            if(response.responseJSON['documentos_solicitante']){
                $('.wrapper-solicitante').addClass('has-error');
                $('.wrapper-solicitante .help-block>strong').html(response.responseJSON['documentos_solicitante']);
            }else{
                $('.wrapper-solicitante').removeClass('has-error');
                $('.wrapper-solicitante .help-block>strong').html('');
            }
        }
    });
</script>
@endsection
