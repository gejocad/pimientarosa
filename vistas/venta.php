<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{


require 'header.php';

if ($_SESSION['ventas']==1) {

 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Ventas <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i>Agregar</button></h1>
  <div class="box-tools pull-right">
  </div>
</div>
<div class="panel-body" style="height: 400px;" id="formularioregistros">
  <h1><button class="btn btn-success" onclick="mostrarform2(true)"><i class="fa fa-plus-circle"></i>Agregar Cliente</button></h1>
  <div  class="panel-body" style="height: 400px;" id="formularioclientes">
  <form action="" name="formulario2" id="formulario2" method="POST">
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Nombre</label>
      <input class="form-control" type="hidden" name="idpersona" id="idpersona">
      <input class="form-control" type="hidden" name="tipo_persona" id="tipo_persona" value="Cliente">
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre del cliente" required>
    </div>
     <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Tipo Dcumento</label>
     <select class="form-control select-picker" name="tipo_documento" id="tipo_documento" required>
       <option value="CEDULA">CEDULA</option>
       <option value="DNI">NIT</option>
       <option value="RUC">CEDULA DE EXTRANJERIA</option>
     </select>
    </div>
     <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Número Documento</label>
      <input class="form-control" type="text" name="num_documento" id="num_documento" maxlength="20" placeholder="Número de Documento">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Direccion</label>
      <input class="form-control" type="text" name="direccion" id="direccion" maxlength="70" placeholder="Direccion">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Telefono</label>
      <input class="form-control" type="text" name="telefono" id="telefono" maxlength="20" placeholder="Número de Telefono">
    </div>
        <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Email</label>
      <input class="form-control" type="email" name="email" id="email" maxlength="50" placeholder="Email">
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar2"><i class="fa fa-save"></i>  Guardar</button>

      <button class="btn btn-danger" onclick="cancelarform2()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
  </div>  
<form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group  col-xs-12">
      <label for="">Cliente(*):</label>
      <input class="form-control" type="hidden" name="idventa" id="idventa">
      <select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true" required>
        
      </select>
    </div>
    <div class="form-group col-xs-12">
      <label for="">Mesa(*): </label>
     <select name="mesa" id="mesa" class="form-control selectpicker" required>
       <option value="1">1</option>
       <option value="2">2</option>
       <option value="3">3</option>
       <option value="4">4</option>
       <option value="5">5</option>
       <option value="6">6</option>
       <option value="7">7</option>
       <option value="8">8</option>
       <option value="9">9</option>
       <option value="10">10</option>
       <option value="11">Para llevar</option>
       <option value="12">Domiciliario</option>
     </select>
    </div>
    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
     <a data-toggle="modal" href="#myModal">
       <button id="btnAgregarArt" type="button" class="btn btn-primary"><span class="fa fa-plus"></span>Agregar Articulos</button>
     </a>
    </div>

<div class="form-group col-lg-12 col-md-12 col-xs-12">
     <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
       <thead style="background-color:#A9D0F5">
        <th>Opciones</th>
        <th>Articulo</th>
        <th>Cantidad</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Precio Venta</th>
        <th>Descuento</th>
        <th>Subtotal</th>
       </thead>
       <tfoot>
         <th>TOTAL</th>
         <th></th>
         <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th> 
         <th></th>
         <th></th>
         <th><h4 id="total">$ 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
       </tfoot>
       <tbody>
         
       </tbody>
     </table>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
</div>
</div>
<!--box-header-->
<!--centro-->
<div class="contenedor row">

<div class="panel-body table-responsive subcontenedor col-md-6"  id="listadoregistros10">
<table id="tbllistado10" class="table table-striped table-bordered table-condensed table-hover media-tabla">
<h1 class="text-danger">Ventas para llevar</h1>
    <thead>
      <th>Opciones</th>
      <th>Usuario</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Usuario</th>
      <th class="text-danger"></th>
      <th>Estado</th>
    </tfoot>   
  </table>   
</div>
<div class="panel-body table-responsive subcontenedor col-md-6"  id="listadoregistros11">
<table id="tbllistado11" class="table table-striped table-bordered table-condensed table-hover media-tabla">
<h1 class="text-danger">Domicilios</h1>
    <thead>
      <th>Opciones</th>
      <th>Usuario</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Usuario</th>
      <th class="text-danger"></th>
      <th>Estado</th>
    </tfoot>   
  </table>   
</div>
<div class="panel-body table-responsive subcontenedor col-md-6"  id="listadoregistros">
<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover media-tabla">
<h1 class="text-danger">Mesa 1</h1>
    <thead>
      <th>Opciones</th>
      <th>Usuario</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Usuario</th>
      <th class="text-danger"></th>
      <th>Estado</th>
    </tfoot>   
  </table>   
</div>
<div class="panel-body table-responsive subcontenedor col-md-6" id="listadoregistros1">
  <table id="tbllistado1" class="table table-striped table-bordered table-condensed table-hover media-tabla">
  <h1 class="text-danger">Mesa 2</h1>
    <thead>
      <th>Opciones</th>
      <th>Usuario</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Usuario</th>
      <th class="text-danger"></th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body table-responsive subcontenedor col-md-6" id="listadoregistros2">
  <table id="tbllistado2" class="table table-striped table-bordered table-condensed table-hover media-tabla">
  <h1 class="text-danger">Mesa 3</h1>
    <thead>
      <th>Opciones</th>
      <th>Usuario</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Usuario</th>
      <th class="text-danger"></th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body table-responsive subcontenedor col-md-6" id="listadoregistros3">
  <table id="tbllistado3" class="table table-striped table-bordered table-condensed table-hover media-tabla">
  <h1 class="text-danger">Mesa 4</h1>
    <thead>
      <th>Opciones</th>
      <th>Usuario</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Usuario</th>
      <th class="text-danger"></th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body table-responsive subcontenedor col-md-6" id="listadoregistros4">
  <table id="tbllistado4" class="table table-striped table-bordered table-condensed table-hover media-tabla">
  <h1 class="text-danger">Mesa 5</h1>
    <thead>
      <th>Opciones</th>
      <th>Usuario</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Usuario</th>
      <th class="text-danger" id="prueba"></th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body table-responsive subcontenedor col-md-6" id="listadoregistros5">
  <table id="tbllistado5" class="table table-striped table-bordered table-condensed table-hover media-tabla">
  <h1 class="text-danger">Mesa 6</h1>
    <thead>
      <th>Opciones</th>
      <th>Usuario</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Usuario</th>
      <th class="text-danger"></th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body table-responsive subcontenedor col-md-6" id="listadoregistros6">
  <table id="tbllistado6" class="table table-striped table-bordered table-condensed table-hover media-tabla">
  <h1 class="text-danger">Mesa 7</h1>
    <thead>
      <th>Opciones</th>
      <th>Usuario</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Usuario</th>
      <th class="text-danger"></th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body table-responsive subcontenedor col-md-6" id="listadoregistros7">
  <table id="tbllistado7" class="table table-striped table-bordered table-condensed table-hover media-tabla">
  <h1 class="text-danger">Mesa 8</h1>
    <thead>
      <th>Opciones</th>
      <th>Usuario</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Usuario</th>
      <th class="text-danger"></th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body table-responsive subcontenedor col-md-6" id="listadoregistros8">
  <table id="tbllistado8" class="table table-striped table-bordered table-condensed table-hover media-tabla">
  <h1 class="text-danger">Mesa 9</h1>
    <thead>
      <th>Opciones</th>
      <th>Usuario</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Usuario</th>
      <th class="text-danger"></th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body table-responsive subcontenedor col-md-6" id="listadoregistros9">
  <table id="tbllistado9" class="table table-striped table-bordered table-condensed table-hover media-tabla">
  <h1 class="text-danger">Mesa 10</h1>
    <thead>
      <th>Opciones</th>
      <th>Usuario</th>
      <th>Total Venta</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Usuario</th>
      <th class="text-danger"></th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>


<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

  <!--Modal-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 65% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Articulo</h4>
        </div>
        <div class="modal-body">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Categoria</th>
              <th>Código</th>
              <th>stock</th>
              <th>Precio Venta</th>
              <th>Imagen</th>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Categoria</th>
              <th>Código</th>
              <th>stock</th>
              <th>Precio Venta</th>
              <th>Imagen</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- fin Modal-->
<?php 
}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>
 <script src="scripts/venta.js"></script>
 <?php 
}

ob_end_flush();
  ?>

