<div id="ModalRegistroVenta" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f5f5f5;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar Venta</h4>
            </div>
            <div class="modal-body">
                <form id="frmregistro" method="post" name="frmregistro" class="form-horizontal">
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
                        <form id="frm1" method="post" name="frm1">
                            <input type="hidden" id="IDBUS" name="IDBUS" />
                            <input type="hidden" id="IDCHOFER" name="IDCHOFER" />
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Código</label>
                                        <input type="text" class="form-control" id="IDITINERARIO" name="IDITINERARIO" disabled="disabled" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Nom. Viaje</label>
                                        <input type="text" class="form-control" id="NOMVIAJE" name="NOMVIAJE" disabled="disabled" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Fecha</label>
                                        <input type="text" class="form-control" id="FECHA_ITINERARIO" name="FECHA_ITINERARIO" disabled="disabled" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Chofer</label>
                                        <input type="text" class="form-control" id="Chofer" name="Chofer" disabled="disabled" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Dirección</label>
                                        <input type="text" class="form-control" id="Direccion1" name="Direccion1" disabled="disabled" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Brevete</label>
                                        <input type="text" class="form-control" id="N_Brevete" name="N_Brevete" disabled="disabled" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Bus</label>
                                        <input type="text" class="form-control" id="NomBus" name="NomBus" disabled="disabled" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Placa</label>
                                        <input type="text" class="form-control" id="Placa" name="Placa" disabled="disabled" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Num. Asiento</label>
                                        <input type="text" class="form-control" id="N_Asiento" name="N_Asiento" disabled="disabled" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Hora salida</label>
                                        <input type="text" class="form-control" id="HORA" name="HORA" disabled="disabled" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Hora llegada</label>
                                        <input type="text" class="form-control" id="HORAFIN" name="HORAFIN" disabled="disabled" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email" class="control-label">Precio</label>
                                        <input type="text" class="form-control" id="PRECIO" name="PRECIO" disabled="disabled" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="tableasientos1" class="table table-bordered" style="width: 0px;">
                        <tr>
                        <?php
                        for($i=1;$i<=10;$i++){
                        ?>
                            <td style="cursor: pointer;" onclick="seleccionarasiento(<?php echo $i;?>);" id="<?php echo $i;?>">
                                <?php echo $i;?>
                            </td>
                        <?php
                        }
                        ?>
                        </tr>
                        <tr>
                        <?php
                        for($i=11;$i<=20;$i++){
                        ?>
                            <td style="cursor: pointer;" onclick="seleccionarasiento(<?php echo $i;?>);" id="<?php echo $i;?>">
                                <?php echo $i;?>
                            </td>
                        <?php
                        }
                        ?>
                        </tr>
                        <tr>
                        <?php
                        for($i=21;$i<=30;$i++){
                        ?>
                            <td style="cursor: pointer;" onclick="seleccionarasiento(<?php echo $i;?>);" id="<?php echo $i;?>">
                                <?php echo $i;?>
                            </td>
                        
                        <?php
                        }
                        ?>
                        </tr>
                        <tr>
                        <?php
                        for($i=31;$i<=40;$i++){
                        ?>
                            <td style="cursor: pointer;" onclick="seleccionarasiento(<?php echo $i;?>);" id="<?php echo $i;?>">
                                <?php echo $i;?>
                            </td>
                        <?php
                        }
                        ?>
                        </tr>
                        </table>
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