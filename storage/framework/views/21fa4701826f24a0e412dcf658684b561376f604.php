     <!-- Mail Modal -->
        <div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="mailModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="mailModalLabel">Enviar comentarios a Administrador.</h5>
              </div>
              <div>
                  <?php echo Form::open([ 'method' => 'POST', 'url' => '' ]); ?>

                  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"></input>
                      <div class="modal-body">
                        <div style='margin: 5px 0px 0px 260px' class='before'></div> 
                            <div class="form-group">
                                <p>Comentarios:</p>
                                <textarea id="comentario" name="comentario" rows="5" cols="70"></textarea>   
                                <input type="hidden" name="product_id" id="product_id" value="">
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="enviar_mail">Enviar E-mail</button>
                      </div> 
                  <?php echo Form::close(); ?>

              </div>
            </div>
          </div>
        </div>