<table id="tablebus" class="table table-bordered display" cellspacing="0" width="100%">
    <thead style="background-color: #f5f5f5;">
        <tr>
            <th class="text-center">NOMBRE USUARIOS</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($usuariosporperfiles as $valor):
        ?>
        <tr style="cursor: pointer;" onclick="listaMenuPorUsuario('<?php echo $valor['IDUSUARIO'];?>');">
            <td><?php echo $valor['NOMBRES'].' '.$valor['APELLIDOS'];?></td>
        </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>