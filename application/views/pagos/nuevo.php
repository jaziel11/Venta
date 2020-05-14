<script type="text/javascript">
    function mostrar(){
      $("#nvoProveedorDiv").show();
      $("#nvoProveedor").focus();
      $("#nvoProveedor").attr("required",true);

    }


</script>


<form class="form-horizontal" method="post" action="<?php echo site_url('Pagos/add'); ?>">
<fieldset>

<!-- Form Name -->
<legend class="text-center">Alta Pago</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="titulo">Titulo</label>  
  <div class="col-md-4">
  <input id="titulo" name="titulo" autofocus placeholder="" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="proveedor">Proveedor</label>
  <button class="btn btn-default" onclick="mostrar()" type="button"><i class="glyphicon glyphicon-plus"></i></button>

  <div class="col-md-4">
    <select id="proveedor" name="proveedor" class="form-control">
      <?php foreach ($proveedores as $proveedor) {
        # code...
       ?>
      <option value="<?php echo $proveedor['id']; ?>"><?php echo $proveedor['nombre']; ?></option>
      <?php } ?>
    </select>
  </div>
</div>

<!-- Text input-->
<div id="nvoProveedorDiv" style="display:none" class="form-group">
  <label class="col-md-4 control-label" for="nvoProveedor"> Nuevo Proveedor</label>  
  <div class="col-md-4">
  <input id="nvoProveedor" name="nvoProveedor" placeholder="" class="form-control input-md"  type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="concepto">Concepto</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="concepto" required name="concepto"></textarea>
  </div>
</div>
      
<div class="form-group">
  <label class="col-md-4 control-label" for="concepto">Fecha</label>
  <div class="col-md-4">                     
    <input type="text" name="fecha" class="fecha12" required="" >
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="total">Total</label>  
  <div class="col-md-4">
  <input id="total" name="total" placeholder="100.00" class="form-control input-md" required="" type="number" step="any">
    
  </div>
</div>
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardar"></label>
  <div class="col-md-4">
    <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
  </div>
</div>
</fieldset>
</form>
<script type="text/javascript">
  $(document).ready(function(){
    $("#articuloF").blur();
    $( ".fecha12" ).datepicker({ format: 'yyyy-mm-dd' }).datepicker("setDate", "0");
    $("#titulo").focus();

  });
</script>