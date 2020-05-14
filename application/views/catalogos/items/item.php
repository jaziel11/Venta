<script type="text/javascript">
  function mostrar(){
    $("#precioInput").show();
    $("#precio1").focus();
    $("#descripcionLabel").hide();
    $("#descripcionInput").show();

    $("#precioLabel").hide();
    $("#edit").hide();
    $("#guardar").show();
  }
  function ocultar(){
    $("#descripcionLabel").show();
    $("#descripcionInput").hide();
    $("#precioInput").hide();
    $("#precioLabel").show();
    $("#edit").show();
    $("#guardar").hide();
  }
</script>

<form class="form-horizontal" action="<?php echo site_url('Catalogos/editItem'); ?>" method="post">
<fieldset>

<!-- Form Name -->
<legend class="text-center">Verificacion Precio </legend>
<?php if($this->session->userdata('error') != null){ ?>

                    <div class="alert alert-danger">
                      <strong><?php echo $this->session->userdata('error'); ?></strong>
                    </div>
                    <?php
                         $this->session->unset_userdata('error');
                    } ?>
<!-- Text input-->
    <table class="table" style="border-radius: 5px;
    width: 50%;
    margin: 0px auto;
    float: none;">
      <tr>
        <th class="">
          <h3>Descripcion</h3>
        </th>
        <td class="text-left">
          <h3 id="descripcionLabel"><?php echo $item->descripcion; ?></h3>
          <input type="text" value="<?php echo $item->descripcion; ?>" class="form-control" name="descripcion" id="descripcionInput" style="display:none;">
        </td>
      </tr>
      <tr>
        <th class="">
          <h3>Codigo</h3>
        </th>
        <td class="text-left">
          <h3><?php echo $item->codigo; ?></h3>
        </td>
      </tr>
      <tr>
        <th class="">
          <h3>Precio</h3>
        </th>
        <td class="text-left">
          <h2>
            <label id="precioLabel" class="label label-primary"><?php echo $item->precio; ?></label>
            <?php $precios = explode(".",$item->precio); ?>
            <div id="precioInput" class="form-group" style="display:none;">
              <div style="width:100px;float:left" >
              <input id="precio1" value="<?php echo $precios[0]; ?>" name="precio1" type="number" step="any" placeholder="" class="form-control input-md text-right" required="">
              
              </div>
           <div style="width:5px;float;left" class="col-xs-1">
            <label>.</label>
              
            </div>
            <div style="width:100px;float:left" >
            <input id="precio2" name="precio2" value="<?php echo $precios[1]; ?>" type="number" step="any" placeholder="" class="form-control input-md" required="">
              
            </div>
          </div>
          <button id="edit" onclick="mostrar();" type="button" class="btn btn-default btn-lg">
            <i class="glyphicon glyphicon-edit"></i>
          </button>
          <div id="guardar" style="display:none;">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button onclick="ocultar();" type="reset" class="btn btn-danger">Cancelar</button>
          </div>
          </h2>
        </td>
      </tr>
    </table>
    <input type="hidden" name="id" value="<?php echo $item->id ?>">




<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
  </div>
</div>

</fieldset>
</form>
