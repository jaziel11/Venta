<script type="text/javascript">
  function addUser(id){
    $("#nvoUsuario").show();
    $("#negocio").val(id);

  }
</script>

<h3>
  Cliente: <?php echo $cliente->nombre." ".$cliente->apaterno; ?>
</h3>
<hr>



<div id="nvoUsuario" style="display:none;">
    <form class="form-horizontal" action="<?php echo site_url('Cliente/AddUsuario'); ?>" method="post">
<fieldset>

<!-- Form Name -->
<legend>Nuevo Usuario</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nombre">Nombre</label>  
  <div class="col-md-4">
  <input id="nombre" name="nombre" type="text" placeholder="" class="form-control input-md" required="">
    
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
  <label class="col-md-4 control-label" for="usuario">Usuario</label>  
  <div class="col-md-4">
  <input id="usuario" name="usuario" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="pass">Contraseña</label>
  <div class="col-md-4">
    <input id="pass" name="pass" type="password" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="tipo">Tipo Usuario</label>
  <div class="col-md-4">
    <select id="tipo" name="tipo" class="form-control">
      <option value="1">Administrador</option>
      <option value="2">Gerente</option>
      <option value="3">Cajero</option>
    </select>
  </div>
</div>

<input type="hidden" name="cliente" value="<?php echo $cliente->id; ?>">

<input type="hidden" name="negocioid" value="0" id="negocio">
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="guardar"></label>
  <div class="col-md-4">
    <button id="guardar" name="guardar" class="btn btn-primary">Guardar</button>
     <button type="button" onclick="$('#nvoUsuario').hide();" id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>

  </div>
</div>

</fieldset>
</form>

</div>

<?php echo form_open('Cliente/AddNegocio'); ?>
<h4>Negocios <button type="button" onclick="$('#nvoNegocio').show();" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button>
</h4> 
<table id="nvoNegocio" class="table" style="display:none;">
  <tr class="col-md-6">
    <th class="col-md-1">Nombre:</th>
    <td class="col-md-1">
      <input type="text" name="nombre" class="form-control" required autofocus>
    </td>
    <td class="col-md-1">
    <button class="btn btn-primary">Guardar</button>
    <button type="button" onclick="$('#nvoNegocio').hide();" class="btn btn-danger">Cancelar</button>

    </td>
  </tr>
</table>
<input type="hidden" name="cliente" value="<?php echo $cliente->id; ?>">
<?php echo form_close(); ?>

<table class="table">
  <thead>
    <tr>
      <th>Negocio</th>
      <th>Users</th>
      <th>Items</th>
    </tr>
  </thead>  
  <tbody>
  <?php
     foreach ($negocios as $negocio) {
    ?>
        <tr>
          <td><?php echo $negocio['nombre']; ?></td>
          <td>
          <?php echo $negocio['usuarios']; ?>
          <button onclick="addUser(<?php echo $negocio['id']; ?>)" class="btn btn-default">
            <i class="glyphicon glyphicon-plus"></i>
          </button>
          </td>
          <td><?php echo $negocio['items']; ?></td>
        </tr>
  <?php   
    } ?>
  </tbody>
</table>




