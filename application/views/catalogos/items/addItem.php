<form class="form-horizontal" action="<?php echo site_url('Catalogos/AddItem1'); ?>" method="post">
<fieldset>

<!-- Form Name -->
<legend class="text-center">Alta de Articulo</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="descripcion">Descripcion</label>  
  <div class="col-md-5">
  <input id="descripcion" autofocus="" name="descripcion" type="text" placeholder="" autofocus="" class="form-control input-md" required="">
    
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="codigo">Precio</label>  
  <div class="col-md-2">
  <input id="precio1" name="precio1" type="number" min="0" step="any" placeholder="" class="form-control input-md text-right" required="">
  
  </div>
 <div style="width:5px;" class="col-xs-1">
  <label>.</label>
    
  </div>
  <div class="col-md-1">
  <input id="precio2" name="precio2" value="00" min="0" type="number" step="any" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="codigo">Codigo</label>  
  <div class="col-md-5">
  <input id="codigo" name="codigo" type="text" placeholder=""
  value="<?php echo $codigoF; ?>"
   class="form-control input-md" required="">
    
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Guardar</button>
    <a id="" name="" class="btn btn-danger" href="<?php echo site_url('Catalogos/Items') ?>">Cancelar</a>
  </div>
</div>

</fieldset>
</form>
<script type="text/javascript">
  $(document).ready(function(){
    $("#articuloF").blur();

    $("#descripcion").focus();

  });
</script>