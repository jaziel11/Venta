<?php echo form_open("Venta/getAll"); ?>
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
<?php echo form_close(); ?>
<?php if($ventas!=null){ ?>
<h3>Ventas <label class="label label-danger">$<?php echo number_format($total,2); ?></label></h3>
<?php } ?><table id="ventas" class="table table-responsive table-striped table-bordered">
	<thead>
		<tr>
			<th>Folio</th>
			<th>Fecha</th>
			<th>Hora</th>
			<th>Total</th>
		</tr>
	</thead>	
	<tbody>
	<?php 
	if($ventas!=null){
		foreach ($ventas as $venta) {
	
		
	?>
		<tr>
			<td><?php echo $venta['id']; ?></td>
			<td><?php echo $venta['fecha']; ?></td>
			<td><?php echo $venta['hora']; ?></td>
			<td><?php echo $venta['total']; ?></td>
			
		</tr>
	<?php } }?>
	</tbody>
</table>


<script type="text/javascript">
	$(document).ready(function(){
		$("#ventas").DataTable(
			{
        // "scrollY":        "500px",
        // "scrollCollapse": true,
        "paging":         false,
        
    }
			);
	});

	
</script>