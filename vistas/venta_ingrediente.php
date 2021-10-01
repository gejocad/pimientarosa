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
  <h1 class="box-title">Ventas </h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>codigo</th>
      <th>articulo</th>
      <th>cantidad</th>
      <th>ingrediente1</th>
      <th>cantidad1</th>
      <th>ingrediente2</th>
      <th>cantidad2</th>
      <th>ingrediente3</th>
      <th>cantidad3</th>
      <th>ingrediente4</th>
      <th>cantidad4</th>
      <th>ingrediente5</th>
      <th>cantidad5</th>
      <th>Total</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>codigo</th>
      <th>articulo</th>
      <th>cantidad</th>
      <th>ingrediente1</th>
      <th>cantidad1</th>
      <th>ingrediente2</th>
      <th>cantidad2</th>
      <th>ingrediente3</th>
      <th>cantidad3</th>
      <th>ingrediente4</th>
      <th>cantidad4</th>
      <th>ingrediente5</th>
      <th>cantidad5</th>
      <th>Total</th>
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
<?php 
}else{
 require 'noacceso.php'; 
}

require 'footer.php';
 ?>
 <script src="scripts/venta_ingrediente.js"></script>
 <?php 
}

ob_end_flush();
  ?>

