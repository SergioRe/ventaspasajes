<div id="ModalRegistroVenta" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f5f5f5;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar Venta</h4>
            </div>
            <div class="modal-body">
                <form id="frmregistro" method="post" name="frmregistro" class="form-horizontal">
                    <input type="hidden" id="IdVenta" name="IdVenta" value="<?php echo $IdVenta;?>"/>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="mensaje1" class="pull-left"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="ejemplo_email_3" class="col-lg-3 control-label">RUTA:</label>
                            <div class="col-lg-9">
                                <select class="form-control" id="IdBus" name="IdBus" onchange="datositinerario(this.value);">
                                    <option value="">Seleccione</option>
                                    <?php 
                                    foreach ($listaitinerario as $valor):
                                    ?>
                                    <option value="<?php echo $valor['IDITINERARIO']?>"><?php echo $valor['ORIGEN'].' - '.$valor['DESTINO']?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form><br/>
                <div class="row">
                    <div id="itinerario">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color: #f5f5f5;">
                <button type="submit" class="btn btn-default" id="btn-save" onclick="saveventa();">
                    <span class="glyphicon glyphicon-floppy-disk"></span> <b>Grabar Venta</b>
                </button>
                <button type="submit" class="btn btn-default" id="btn-save" onclick="cancelar();">
                    <span class="glyphicon glyphicon-remove"></span> <b>Cancelar</b>
                </button>
            </div>
        </div>
    </div>
</div>