   <!-- General Modal -->
        <div class="modal fade" id="generalModal" tabindex="-1" role="dialog" aria-labelledby="generalModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="generalModalLabel">Reporte General por cliente</h3>
              </div>
              <div>
                <form  id="reporte_general" name="reporte_general" method="POST" action="{{ url('reporte_general') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">Rango de Fechas:</div>
                      <div class="col-md-6">Cliente:</div>
                    </div>
                    <div class="row">

                      <div class="col-lg-6 col-md-12 col-xs-12">
                          <input class="form-control" type="text" name="daterange" id="daterange" value="01/01/2018 - 31/01/2018" />
                      </div>
                      <div class="col-lg-6 col-md-12 col-xs-12 buscar">

                        @if( Auth::user()->role_id !== 1 )
                            <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar" value="{{ Auth::user()->name }}" disabled="disabled">
                            <input type="hidden" id="cliente_id" name="cliente_id" value="{{ Auth::user()->id }}"/>
                        @elseif( Auth::user()->role_id == 1 )
                            <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar" onfocus="this.value=''">
                            <input type="hidden" id="cliente_id" name="cliente_id" value=""/>
                            <div id="res-search"></div>
                        @endif
                            
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">Tipo:</div>
                         <div class="col-lg-6 col-md-12 col-xs-12">
                            <select class="form-control" id="estatus_reporte_general" name="estatus_reporte_general">
                              <option value="GENERAL">Todos...</option>>
                              <option value="APROBADO">PRODUCTOS PISA</option>>
                              <option value="NO APROBADO">COMPETENCIA</option>
                            </select>
                         </div>
                         <div class="col-lg-6 col-md-12 col-xs-12">
                            <select class="form-control" id="tipo" name="tipo">
                              <option value="pdf">PDF</option>>
                              <option value="excel">EXCEL</option>
                            </select>
                        </div>
                      </div>
                    </div>                
                  </div>
                  <div class="modal-footer">
                        <button type="submit" class="btn btn-primary reporte_general" name="reporte_general" id="reporte_general">Imprimir Reporte</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>