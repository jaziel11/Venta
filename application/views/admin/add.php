<form class="form-horizontal" method="post" action="<?php echo site_url('Cliente/Add1'); ?>">
<fieldset>

<!-- Form Name -->
<legend class="text-center">Nuevo Cliente</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nombre">Nombre</label>  
  <div class="col-md-4">
  <input id="nombre" name="nombre" type="text" placeholder="" autofocus class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="apaterno">Apellido Paterno</label>  
  <div class="col-md-4">
  <input id="apaterno" name="apaterno" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="amaterno">Apellido Materno</label>  
  <div class="col-md-4">
  <input id="amaterno" name="amaterno" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="telefono">Telefono</label>  
  <div class="col-md-4">
  <input id="telefono" name="telefono" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardar"></label>
  <div class="col-md-4">
    <button id="guardar" name="guardar" class="btn btn-primary">Guardar</button>
    <a href="<?php echo site_url('Cliente/GetAll'); ?>" class="btn btn-danger">Cancelar</a>
  </div>
</div>

</fieldset>
</form>
