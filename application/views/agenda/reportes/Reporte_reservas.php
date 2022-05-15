<html>
    <head>
        <link href="<?=base_url()?>assets/css/tablas.css" rel="stylesheet" type="text/css" />
        <style>
            table{
                margin-top      : 12px;
                margin-bottom   : 12px;
                border          : 1px solid #5DADE2;
            }
        </style>
    </head>
    <body>
        <h3 style="text-align: center; border-bottom: 1px solid black;"><?=$titulo?></h3>
        <div id="contenedor">
            
            <?php
                $i  = 1;
                foreach($reserva as $row){
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Telefono Primario</th>
                                <th>Nº Pers.</th>
                                <th>Sucurssal</th>
                                <th>Usuario Creador</th>
                                <th>Fecha Hora Reserva</th>
                                <th>Fecha Creacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 5%;"><?php echo $i; ?></td>
                                <td><?php echo $row['nombre_cliente']; ?></td>
                                <td style="text-align: center;"><?php echo $row['telefono_cliente']; ?></td>
                                <td style="text-align: center;"><?php echo $row['numero_personas']; ?></td>
                                <td style="text-align: center;"><?php echo $row['nombre_sucursal']; ?></td>
                                <td style="text-align: center;"><?php echo $row['nombre']; ?></td>
                                <td style="text-align: center;">
                                    <?php echo date('d-m-Y',strtotime($row['fecha_capturada'])); ?><br>
                                    <?php echo date('g:i:s A',strtotime($row['fecha_capturada'])); ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php echo date('d-m-Y',strtotime($row['fecha_creacion'])); ?><br>
                                    <?php echo date('g:i:s A',strtotime($row['fecha_creacion'])); ?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="8">Nota de reserva:</th>
                            </tr>
                            <tr>
                                <td colspan="8" style="padding-left: 40px;"><?=nl2br($row['nota'])?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                    $i++;
                }
            ?>
                
        </div>
    </body>
</html>