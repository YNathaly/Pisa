   <!-- Productos Aprobados Modal -->
        <div class="modal fade" id="aprobadosModal" tabindex="-1" role="dialog" aria-labelledby="aprobadosModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="aprobadosModalLabel">Productos aprobados</h3>
              </div>
                 
                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                      <div class="modal-body">
                        <div style='margin: 5px 0px 0px 260px' class='before'></div> 
                            <div class="form-group">
                                <p>Producto</p>
                                 <ul>
                                   @foreach($productos as $producto)
                                      @if($producto->estatus == 'APROBADO')
                                        <li>{{ $producto->descripcion }}</li>
                                      @endif
                                   @endforeach
                                 </ul>
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="aprobados">Aceptar</button>
                      </div> 
                  
              </div>
            </div>
          </div>
