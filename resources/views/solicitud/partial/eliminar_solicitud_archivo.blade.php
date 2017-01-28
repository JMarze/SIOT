<div class="modal fade" id="eliminar_solicitud_archivo" tabindex="-1" role="dialog" aria-labelledby="Eliminar archivo de Solicitud">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Eliminar archivo de Solicitud">
                    <i class="fa fa-btn fa-trash"></i>Eliminar archivo de Solicitud
                </h4>
            </div>

            <div class="modal-body">
                {!! Form::open(['route' => ['solicitud.eliminar_solicitud_documento', $solicitud->id, 'IDDOCUMENTODIGITAL'], 'method' => 'DELETE', 'id' => 'form-eliminar_solicitud_archivo', 'class' => 'form-horizontal']) !!}

                <h4 id="msg-eliminar">
                    ¿Está seguro de eliminar la información guardada de fojas y el archivo que fué subido en el servidor?
                </h4>
                <h6><i>* Esta operación es irreversible.</i></h6>

                {!! Form::close() !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa fa-btn fa-close"></i>Cancelar
                </button>
                <button id="btn-eliminar-solicitud" type="button" class="btn btn-default">
                    <i class="fa fa-btn fa-trash"></i>Eliminar
                </button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent
<script>
    // Reset Form
    $('.modal#eliminar_solicitud_archivo').on('show.bs.modal', function(e){
        resetForm($(this));
    });
    $('.modal#eliminar_solicitud_archivo').on('hidden.bs.modal', function(e){
        resetForm($(this));
    });
    // Eliminar archivo de Solicitud
    var formEliminarSolicitud = $('#form-eliminar_solicitud_archivo');
    $(document).on('click', '#btn-eliminar-solicitud', function(){
        var url = formEliminarSolicitud.attr('action').split('/');
        url[url.length-1] = formEliminarSolicitud.attr('data-documento');
        url = url.join("/");

        formEliminarSolicitud.attr('action', url);
        formEliminarSolicitud.submit();
    });
    // Ajax
    formEliminarSolicitud.ajaxForm({
        success: function (){
            location.reload();
        },
        complete: function (response){},
        error: function (response){}
    });
</script>
@endsection
