<table class="table">
    <thead>
        <tr>
            <th class="col-md-2">Codigo:
            <input type="text" name="codigo"  class="form-control" id="codigo" onchange="validarEspacios('codigo');buscarProducto($(this).val());limpiarEntrada('codigo')" autofocus />
            </th>
<!--            <th class="col-md-2">
                Nombre:
                <input type="text" id="nombre" name="nombre" class="form-control"/>
            </th>-->
            <td class="col-md-3"></td>
            <th class="col-md-3 text-right letraVerde" style="font-size: 20px;"> Total:</th>
            <td class="col-md-3 alert alert-success ">
                <input type="text"  class="form-control text-center " style="font-size:50px;height:60px;"  name="total" id="total"/>
            </td>
            <td>
                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
Cobrar</button>
                
            </td>
               
        </tr>
        <tr>
            <td>-</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr id="addProducto" class="oculto">
            
            <th class="col-md-2">Descripcion
                <input type="text" name="descripcion" id="descripcion" class="form-control"/>
            </th>
            <th class="col-md-1">Precio
                <input type="number" step onkeyup="validarNumero('precio')" name="precio" id="precio" class="form-control"/>
            </th>
            <td class="col-md-1">
                <button class="btn btn-primary" onclick="guardarProducto($('#codigo').val(),$('#descripcion').val(),$('#precio').val())">Guardar</button>
                <button class="btn btn-danger" onclick="cancelarAltaProducto()">Cancelar</button>
            </td>
            <td class="col-md-2"></td>
            <td class="col-md-2"></td>
        </tr>
    </thead>
</table>

	
<?php


    echo form_open('Venta/Registrar');
?>
<table id="tablaVenta" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th></th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>SubTotal</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
          <div>
              
  <label class=" control-label" for="total">Total:</label>  
  <div class="">
  <input id="total1" name="total1" type="text"  placeholder="" class="form-control total " required="">
    
  </div>

  <label class=" control-label" for="pago">Pago con:</label>  
  <div class="">
      <input id="pago" name="pago" type="text"  placeholder="" onkeyup="calcularCambio();" class="form-control total" required="">
    
  </div>
  <label class=" control-label" for="pago">Cambio:</label>  
  <div class="">
  <input id="cambio" name="cambio" type="text"  placeholder="" class="form-control total" required="">
    
  </div>

          </div>
          
      </div>
      <div class="modal-footer">
          <button  type="button" class="btn btn-danger btn-lg"  data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success btn-lg">Cobrar</button>
      </div>
    </div>
  </div>
</div>

<?php echo form_close(); ?>

<script type="text/javascript">
  $(document).ready(function(){
    $("#articuloF").blur();

    $("#codigo").focus();

  });

  function buscarProducto(codigo) {
    $.ajax({
        method: "get",
        url: baseUrl + "Venta/add",
        data: {codigo: codigo,tienda:<?php echo  $this->session->userdata("sesiones")['negocioid'];?>}
    })
            .done(function(msg) {
                json = jQuery.parseJSON(msg);
                if (json.id == '0') {
                    alert('Producto no registrado favor registrar');
                    $("#addProducto").show();
                    $("#codigo").val(codigo);
                    $("#descripcion").focus();
                } else {
                    agregarRenglon(json.nombre, json.precio, json.id);
                }
            });
}
function agregarRenglon(nombre, precio, id) {
    $("#tablaVenta tbody").append("<tr class='renglones'>\n\\n\
        <td class='eliminar'><button class='btn btn-danger '><i class='glyphicon glyphicon-trash'></i></button></td><td> " + nombre + "</td>\n\<td>\n<input type='hidden' class='ids' name='ids[]' value='" + id + "' />\n<input type='number' step='any' onchange='validarNumeroActual($(this).val());calcularTotal();' class='cantidad' name='cantidad[]' value='1'/></td>\n  \n\
      \n\<td><input type='number' step='any' class='precios' name='precios[]' onchange='validarNumeroActual($(this).val());calcularTotal();//cambioPrecio($(this).val(),0);' value='" + precio + "'/></td> \n\
       <td ><label class='subtotal'>" + (precio * 1) + "</label></td>\n\
        </tr>");

    calcularTotal();
    $("#codigo").val('');
}

// Evento que selecciona la fila y la elimina 
$(document).on("click", ".eliminar", function() {
    var parent = $(this).parents().get(0);
    $(parent).remove();
    calcularTotal();
    $("#codigo").focus();

});
function calcularTotal() {
    var total = 0;
    $(".renglones").each(function(i) {
        individual = $(".cantidad:eq(" + i + ")").val() * parseFloat($(".precios:eq(" + i + ")").val());
        total += $(".cantidad:eq(" + i + ")").val() * parseFloat($(".precios:eq(" + i + ")").val());
        $(".subtotal:eq(" + i + ")").html(individual.toFixed(2));
    });
    $("#total").val(total.toFixed(2));
    $("#total1").val(total.toFixed(2));
    $("#pago").val(total.toFixed(2));
    calcularCambio();
}
function calcularCambio() {
    $("#cambio").val((Math.abs($("#total1").val() - $("#pago").val())).toFixed(2));

}
function validarNumero(id) {
    if (isNaN($("#" + id).val()))
        $("#" + id).val('');
}
function validarNumeroActual(val) {
    if (isNaN(val) || parseFloat(val) > 0)
        $(this).val('1');
}
function validarEspacios(id) {
    $("#" + id).val($.trim($("#" + id).val()));
}
function limpiarEntrada(id) {
    $("#" + id).val('');
}

function cancelarAltaProducto() {
    $("#addProducto").hide();
    $("#descripcion").val('');
    $("#precio").val('');
    $("#codigo").val('');
    $("#codigo").focus();


}
function guardarProducto(codigo, descripcion, precio) {
    $.ajax({
        method: "get",
        url: baseUrl
         + "Venta/insertarProducto",
        data: {codigo: codigo, descripcion: descripcion, precio: precio}
    })
            .done(function(msg) {
                json = jQuery.parseJSON(msg);
                if (json.id == '0') {
                    alert('Producto no registrado favor registrar');
                    $("#addProducto").show();
                    $("#codigo").val(codigo);
                    $("#codigo").focus();
                } else {
                    $("#addProducto").hide();
                    agregarRenglon(json.nombre, json.precio, json.id);
                    cancelarAltaProducto();
                    $("#codigo").focus();

                }
            });
}

$(document).on("keypress", "form", function(event) { 
    return event.keyCode != 13;
});
var options = {
    url: function(phrase) {
        return baseUrl+"Venta/buscarItem?phrase=" + phrase + "&format=json";
    },

    getValue: "name"
};

$("#codigo").easyAutocomplete(options);

</script>