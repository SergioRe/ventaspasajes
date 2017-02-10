<form id="form1" method="post">
    <input type="hidden" id="IDUSUARIO" name="IDUSUARIO" value="<?php echo $IDUSUARIO;?>"/>
    <table id="tablelistaMenuPorUsu" class="table table-bordered display" cellspacing="0" width="100%">
        <thead style="background-color: #f5f5f5;">
            <tr>
                <th class="text-center">MENÚ POR USUARIO</th>
                <th class="text-center">PERMISO</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listamenuporusuario as $valor):
            ?>
            <tr style="cursor: pointer;">
                <td><?php echo $valor['MENNOM'];?></td>
                <td>
                <center><input type="checkbox" style="cursor: pointer;" name="checkbox" value="<?php echo $valor['MENID'];?>" id="<?php echo $valor['MENID'];?>" <?php echo (($valor['MENPERMISO'] == 'S')?'checked=""':'');?> /></center>
                </td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</form>