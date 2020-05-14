<?php echo form_open("Pagos/getAll"); ?>
<table>
    <tr>
        <th>Desde:</th>
        <th>Hasta:</th>
    </tr>
    <tr>
        <td>
            <input type="text" name="desde" class="fecha" required="" value="<?php echo $desde; ?>">
        </td>		
        <td>
            <input type="text" name="hasta" class="fecha" required="" value="<?php echo $hasta; ?>">
        </td>
        <td>
            <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
        </td>
    </tr>
</table>
<?php
echo form_close();

$date1 = new DateTime($desde);
$date2 = new DateTime($hasta);
$diff = $date1->diff($date2);
$dias = $diff->days + 1;
?>
<?php if ($pagos != null) { ?>
    <h3>Gastos <label class="label label-danger">$<?php echo number_format($total, 2); ?></label><br><br>

        Promedio Diario <label class="label label-danger">$<?php echo number_format($total / $dias, 2); ?></label><br><br>
        Promedio Semana <label class="label label-danger">$<?php echo number_format($total * 7 / $dias, 2); ?></label><br><br>


    </h3>
<?php } ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="chart_div"></div>
<div id="titulos"></div>

<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked);


    function drawStacked() {


        var data = google.visualization.arrayToDataTable([
            ['Fecha', 'Total', {role: 'annotation'}],
            <?php foreach($pagosMeses as $pm){ ?>
            ['<?php echo $pm['fecha'];?>', <?php echo $pm['total'];?>, ''],
            <?php } ?>
                
        ]);

        var options = {
//        width: 600,
//        height: 400,
            legend: {position: 'top', maxLines: 3},
            bar: {groupWidth: '75%'},
//            isStacked: true,
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        
        
        var data2 = google.visualization.arrayToDataTable([
            ['Titulo', 'Total', {role: 'annotation'}],
            <?php foreach($pagosTitulo as $pt){ ?>
            ['<?php echo $pt['titulo'];?>', <?php echo $pt['total'];?>, ''],
            <?php } ?>
                
        ]);

        var options2 = {
//        width: 600,
//        height: 400,
            legend: {position: 'top', maxLines: 3},
            bar: {groupWidth: '75%'},
//            isStacked: true,
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('titulos'));
        chart.draw(data2, options2);
        
        
        
        
        
    }
</script>
<table id="" class="table table-responsive table-striped table-bordered">
    <thead>
        <tr>

            <th>Titulo</th>			
            <th class="text-right">Total</th>
            <th class="text-right">Promedio Dia</th>
            <th class="text-right">Promedio Semana</th>

            <th class="text-right">Porcentaje</th>
        </tr>
    </thead>	
    <tbody>
        <?php
        $porcentajeTotal = 0;
        foreach ($pagosTitulo as $pt) {
            $porcentaje = $pt['total'] / $total * 100;
            $porcentajeTotal += $porcentaje;
            $tipoRenglon = "";
            if ($porcentajeTotal <= 80) {
                $tipoRenglon = "alert alert-danger";
            }
            ?>
            <tr class="<?php echo $tipoRenglon; ?>">

                <th><?php echo $pt['titulo']; ?></th>			
                <th class="text-right">$<?php echo number_format($pt['total'], 2); ?></th>
                <th class="text-right">$<?php echo number_format($pt['total'] / $dias, 2); ?></th>
                <th class="text-right">$<?php echo number_format($pt['total'] / $dias * 7, 2); ?></th>

                <th class="text-right"><?php echo number_format($porcentaje, 2); ?></th>
            </tr>
        <?php } ?>            
    </tbody>
</table>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Proveedor</th>
            <th>Pagos</th>
            <th>Promedio Pago</th>
            <th>Maximo</th>

            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php 
         if ($pagos != null) {
             $conta = 0;
         
            foreach ($pagosProveedor as $pago) {
        $conta++;
        ?>
        <tr>
            <td><?php echo $conta; ?></td>
            <td><?php 
            foreach($proveedores as $pro){
            if($pago['proveedorid']==$pro['id']){
                echo $pro['nombre'];
                break;
            }
            }
            ?></td>
            <td class="text-right"><?php echo $pago['pagos']; ?></td>
            <td class="text-right"><?php echo number_format ($pago['promedio'],0); ?></td>
            <td class="text-right"><?php echo number_format($pago['maximo'],0); ?></td>

            <td class="text-right"><?php echo number_format($pago['total'],0); ?></td>

        </tr>
            <?php }
         }?>
    </tbody>
</table>
<!--<table id="pagos" class="table table-responsive table-striped table-bordered">
    <thead>
        <tr>
            <th>Folio</th>
            <th>Proveedor</th>
            <th>Titulo</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Concepto</th>
            <th>Total</th>
        </tr>
    </thead>	
    <tbody>
        <?php
        if ($pagos != null) {
            foreach ($pagos as $pago) {
                ?>
                <tr>
                    <td><?php echo $pago['id']; ?></td>
                    <td><?php
                        foreach ($proveedores as $proveedor) {
                            if ($proveedor['id'] == $pago['proveedorId']) {
                                echo $proveedor['nombre'];
                            }
                        }
                        ?></td>
                    <td><?php echo $pago['titulo']; ?></td>
                    <td><?php echo $pago['fecha']; ?></td>
                    <td><?php echo $pago['hora']; ?></td>
                    <td><?php echo $pago['concepto']; ?></td>
                    <td class="text-right"><?php echo number_format ($pago['total'],0); ?></td>

                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>-->


<script type="text/javascript">
    $(document).ready(function () {
        $("#pagos").DataTable(
                {
                    // "scrollY":        "500px",
                    // "scrollCollapse": true,
                    "paging": false,

                }
        );
    });
</script>