<?php     $usuarioSession = $this->session->userdata("sesiones");
 ?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><?php echo $usuarioSession['negocio']; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="<?php echo site_url('Venta/Nueva'); ?>">Venta <span class="sr-only">(current)</span></a></li>
        <li><a href="<?php echo site_url('Pagos/All'); ?>">Pago</a>
           <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('Catalogos/Proveedores'); ?>">Proveedores</a></li>
            <!-- <li><a href="#"></a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li> -->
          </ul>
        </li>

        <li><a href="<?php echo site_url('Catalogos/Items'); ?>">Articulos</a></li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('Venta/getAll'); ?>">Ventas</a></li>
            <li><a href="<?php echo site_url('Pagos/getAll'); ?>">Pagos</a></li>

           <!--  <li><a href="#"></a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li> -->
          </ul>
        </li> 
      </ul>
      <form class="navbar-form navbar-left" action="<?php echo site_url('Catalogos/Items'); ?>"   method="post">
        <div class="form-group">
          <input id="articuloF" type="text" class="form-control" <?php if($this->uri->segment(2)!="AddItem"){
            echo "autofocus";
          } ?> name="busqueda" placeholder="Articulo" required>
        </div>
        
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
       <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="#">Link</a></li> -->
     <!--    <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
        <li>  -->
        
<!-- </li> -->
<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $usuarioSession['nombrecompleto']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('Login/logOut') ?>">Salir</a></li>
            
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse
  </div><!-- /.container-fluid -->
</nav>

<br><br><br>
<?php if($this->session->userdata('okMensaje') != null){ ?>

                    <div class="alert alert-success">
                      <strong><?php echo $this->session->userdata('okMensaje'); ?></strong>
                    </div>
                    <?php
                         $this->session->unset_userdata('okMensaje');
                    } ?>
                    <?php if($this->session->userdata('error') != null){ ?>

                    <div class="alert alert-danger">
                      <strong><?php echo $this->session->userdata('error'); ?></strong>
                    </div>
                    <?php
                         $this->session->unset_userdata('error');
                    } ?>
<div class="container">
<?php if($this->session->userdata('error') != null){ ?>

                    <div class="alert alert-danger">
                      <strong><?php echo $this->session->userdata('error'); ?></strong>
                    </div>
                    <?php
                         $this->session->unset_userdata('error');
                    } ?>
