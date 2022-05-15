<html>
    <head>
        <link href="<?=base_url()?>assets/css/tablas.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h3 style="text-align: center; border-bottom: 1px solid black;"><?=$titulo?></h3>
        <div id="contenedor">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Telefono Primario</th>
                        <th>Telefono Secundario</th>
                        <th>Correo Cliente</th>
                        <th>Usuario Creador</th>
                        <th>Fecha Creacion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i  = 1;
                        foreach($clientes as $row){
                           ?>
                            <tr>
                                <td style="width: 5%;"><?php echo $i; ?></td>
                                <td><?php echo $row['nombre_cliente']; ?></td>
                                <td style="text-align: center;"><?php echo $row['telefono_cliente']; ?></td>
                                <td style="text-align: center;"><?php echo $row['dos_telefono_cliente']; ?></td>
                                <td style="text-align: center;"><?php echo $row['correo_cliente']; ?></td>
                                <td style="text-align: center;"><?php echo $row['nombre']; ?></td>
                                <td style="text-align: center;">
                                    <?php echo date('d-m-Y',strtotime($row['fecha_creacion'])); ?><br>
                                    <?php echo date('g:i:s A',strtotime($row['fecha_creacion'])); ?>
                                </td>
                            </tr>
                           <?php
                            $i++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>