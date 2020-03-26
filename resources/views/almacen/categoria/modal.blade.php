<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$cat->idcategoria}}">
    {{ Form::open(array('action'=>array('CategoriaController@destroy', $cat->idcategoria), 'method'=>'delete')) }}
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-tittle">Eliminar Categoria</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
                <p>Confirme si desea eliminar la categoria {{ $cat -> nombre}}</p>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>