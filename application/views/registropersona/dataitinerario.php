<form id="frm1" method="post" name="frm1">
    <input type="hidden" id="IDBUS" name="IDBUS" value="<?php echo $itinerario[0]['IDBUS'];?>" />
    <input type="hidden" id="IDCHOFER" name="IDCHOFER" value="<?php echo $itinerario[0]['IDCHOFER'];?>" />
    <input type="hidden" id="FECHA_VIAJE" name="FECHA_VIAJE" value="<?php echo $itinerario[0]['FECHA_VIAJE'];?>" />
    <input type="hidden" id="DESTINO" name="DESTINO" value="<?php echo $itinerario[0]['DESTINO'];?>" />
    <input type="hidden" id="ORIGEN" name="ORIGEN" value="<?php echo $itinerario[0]['ORIGEN'];?>" />
    <input type="hidden" id="HORAFIN" name="HORAFIN" value="<?php echo $itinerario[0]['HORAFIN'];?>" />
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email" class="control-label">Código</label>
                <input type="text" class="form-control" id="IDITINERARIO" name="IDITINERARIO" disabled="disabled" value="<?php echo $itinerario[0]['IDITINERARIO'];?>" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email" class="control-label">Nom. Viaje</label>
                <input type="text" class="form-control" id="NOMVIAJE" name="NOMVIAJE" disabled="disabled" value="<?php echo $itinerario[0]['NOMVIAJE'];?>" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email" class="control-label">Fecha</label>
                <input type="text" class="form-control" id="FECHA_ITINERARIO" name="FECHA_ITINERARIO" disabled="disabled" value="<?php echo $itinerario[0]['FECHA_ITINERARIO'];?>" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email" class="control-label">Chofer</label>
                <input type="text" class="form-control" id="Chofer" name="Chofer" disabled="disabled" value="<?php echo $itinerario[0]['Chofer'];?>" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email" class="control-label">Dirección</label>
                <input type="text" class="form-control" id="Direccion1" name="Direccion1" disabled="disabled" value="<?php echo $itinerario[0]['Direccion'];?>" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email" class="control-label">Brevete</label>
                <input type="text" class="form-control" id="N_Brevete" name="N_Brevete" disabled="disabled" value="<?php echo $itinerario[0]['N_Brevete'];?>" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email" class="control-label">Bus</label>
                <input type="text" class="form-control" id="NomBus" name="NomBus" disabled="disabled" value="<?php echo $itinerario[0]['NomBus'];?>" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email" class="control-label">Placa</label>
                <input type="text" class="form-control" id="Placa" name="Placa" disabled="disabled" value="<?php echo $itinerario[0]['Placa'];?>" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email" class="control-label">Num. Asiento</label>
                <input type="text" class="form-control" id="N_Asiento" name="N_Asiento" disabled="disabled" value="<?php echo $itinerario[0]['N_Asiento'];?>" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email" class="control-label">Hora salida</label>
                <input type="text" class="form-control" id="HORA" name="HORA" disabled="disabled" value="<?php echo $itinerario[0]['HORA'];?>" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email" class="control-label">Hora llegada</label>
                <input type="text" class="form-control" id="HORAFIN" name="HORAFIN" disabled="disabled" value="<?php echo $itinerario[0]['HORAFIN'];?>" />
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="email" class="control-label">Precio</label>
                <input type="text" class="form-control" id="PRECIO" name="PRECIO" disabled="disabled" value="<?php echo $itinerario[0]['PRECIO'];?>" />
            </div>
        </div>
    </div>
</form><br/><center>
<table id="tableasientos1" class="table table-bordered" style="width: 0px;">
    <tr>
    <?php
    $asientos = array();
    $price = array();
    for($i=1;$i<=40;$i++){
        $asientos[] = $i;
    }
    foreach ($dataasientos as $valor):
        if (in_array($valor['Asiento'], $asientos)){
            $price[] = $valor['Asiento'];
        }
    endforeach;
    for($i=1;$i<=10;$i++){
        if (in_array($i, $price)){
            $color = '#FF0000';
            $onclik = '';
        }else{
            $color = '#0431B4';
            $onclik = 'onclick="seleccionarasiento('.$i.');"';
        }
        ?>
        <td style="cursor: pointer;background-color:<?php echo $color;?>" class="seleccionecolor<?php echo $i;?>" <?php echo $onclik;?> id="<?php echo $i;?>">
            <?php echo $i;?>
        </td>
        <?php
    }
    ?>
    </tr>
    <tr>
    <?php
    for($i=11;$i<=20;$i++){
        if (in_array($i, $price)){
            $color = '#FF0000';
            $onclik = '';
        }else{
            $color = '#0431B4';
            $onclik = 'onclick="seleccionarasiento('.$i.');"';
        }
        ?>
        <td style="cursor: pointer;background-color:<?php echo $color;?>" class="seleccionecolor<?php echo $i;?>" <?php echo $onclik;?> id="<?php echo $i;?>">
            <?php echo $i;?>
        </td>
        <?php
    }
    ?>
    </tr>
    <tr>
    <?php
    for($i=21;$i<=30;$i++){
        if (in_array($i, $price)){
            $color = '#FF0000';
            $onclik = '';
        }else{
            $color = '#0431B4';
            $onclik = 'onclick="seleccionarasiento('.$i.');"';
        }
        ?>
        <td style="cursor: pointer;background-color:<?php echo $color;?>" class="seleccionecolor<?php echo $i;?>" <?php echo $onclik;?> id="<?php echo $i;?>">
            <?php echo $i;?>
        </td>
        <?php
    }
    ?>
    </tr>
    <tr>
    <?php
    for($i=31;$i<=40;$i++){
        if (in_array($i, $price)){
            $color = '#FF0000';
            $onclik = '';
        }else{
            $color = '#0431B4';
            $onclik = 'onclick="seleccionarasiento('.$i.');"';
        }
        ?>
        <td style="cursor: pointer;background-color:<?php echo $color;?>" class="seleccionecolor<?php echo $i;?>" <?php echo $onclik;?> id="<?php echo $i;?>">
            <?php echo $i;?>
        </td>
        <?php
    }
    ?>
    </tr>
</table>
</center>