
<a href="<?php echo site_url('Catalogos/AddItem'); ?>" class="btn btn-default">
	<i class="glyphicon glyphicon-plus"></i>
</a>

<table id="tabla" class="table table-striped table-bordered table responsive">
	<thead>
		<tr>
			<th>Folio</th>
			<th>Descripcion</th>
			<th>Codigo</th>
			<th>Precio</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($items as $item) {
		?>
		
			<tr onclick='redirigir(<?php echo $item["id"]; ?>)'>
				<td><?php echo $item['id'];?></td>
				<td><?php echo $item['descripcion'];?></td>
				<td><?php echo $item['codigo'];?></td>
				<td class="text-right">
					<label class="label label-primary lead"><?php echo $item['precio'];?></label>
			</td>
			</tr>
		
	<?php } ?>
	</tbody>
</table>

<script type="text/javascript">

	function redirigir(id){
		location.href = baseUrl+"Catalogos/Items/"+id;
	}
	$(document).ready(function(){
		$("#tabla").DataTable(
			{
        // "scrollY":        "500px",
        // "scrollCollapse": true,
        "paging":         false,
        
    }
			);
	});
</script>