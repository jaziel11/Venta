<a href="<?php echo site_url('Cliente/Add'); ?>" class="btn btn-default">
	<i class="glyphicon glyphicon-plus"></i>
</a>
<table class="table">
	<thead>
		<tr>
			<th>Cliente</th>
			<th>Fecha Ingreso</th>
			<th>Negocios</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($clientes as $cliente) { ?>
		<tr onclick='redirigir(<?php echo $cliente["id"]; ?>)'>
			<td><?php echo $cliente['nombre']." ".$cliente['apaterno']; ?></td>
			<td><?php echo $cliente['fechaingreso'] ; ?></td>
			<td>0</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<script type="text/javascript">
	
	function redirigir(id){
		location.href = baseUrl+"Cliente/Edit/"+id;
	}
</script>