   <!-- Editar Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="editModalLabel">Editar producto</h3>
              </div>
              <div>
                  {!! Form::open([ 'method' => 'POST', 'url' => '' ]) !!}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                      <div class="modal-body">
                        <div style='margin: 5px 0px 0px 260px' class='before'></div> 
                            <div id="mensajes"></div>
                            <div class="form-group">
                                <p>Descripción de producto</p>
                                 <input id="descripcion" type="text" class="form-control" name="descripcion" value="" required autofocus>
                                 <input type="hidden" name="id_registro" id="id_registro" value="">
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="editar">Aceptar</button>
                      </div> 
                  {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>