<style type="text/css">
    #div1 {
        overflow:scroll;
        height:500px;
        width:800px;
   }
</style>
<?php
    if($sentencia['flag'] == 'select'){
    ?>
<div id="div1">
    <table id="tablaauditoria" name="tablaauditoria" class="table table-bordered display" cellspacing="0" width="100%">
        <thead style="background-color: #0080FF;">
            <tr>
                <?php
                for($i=0;$i<$sentencia['numfila'];$i++){
                ?>
                <th class="text-center"><?php echo $sentencia['nomcampos'][$i][0];?></th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                if($sentencia['consulta'] == 'vacio'){
                ?>
                <td><?php
                    echo 'Sin datos.';
                ?></td>
                <?php
                }else{
                    for($i=0;$i<$sentencia['numfila'];$i++){
                    ?>
                    <td>
                    <?php
                        echo $sentencia['consulta'][$i];
                    ?>
                    </td>
                    <?php
                    }
                }
                ?>
            </tr>
        </tbody>
    </table>
</div>
    <?php
    }else{
        echo $sentencia['mensaje'];
    }
?>
