<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Venta_ingrediente{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro
public function insertar($idarticulo,$nombre,$stock){
	$sql="UPDATE articulo SET nombre='$nombre',stock='$stock'
	WHERE idarticulo='$idarticulo'";
	return ejecutarConsulta($sql);
}

public function insertar1($ing1,$cant1){

	$sql="UPDATE ingrediente SET stock=stock+'$cant1' 
	WHERE idingrediente='$ing1'";
	return ejecutarConsulta($sql);
}

public function insertar2($ing2,$cant2){

	$sql="UPDATE ingrediente SET stock=stock+'$cant2' 
	WHERE idingrediente='$ing2'";
	return ejecutarConsulta($sql);
}
public function insertar3($ing3,$cant3){

	$sql="UPDATE ingrediente SET stock=stock+'$cant3' 
	WHERE idingrediente='$ing3'";
	return ejecutarConsulta($sql);
}
public function insertar4($ing4,$cant4){

	$sql="UPDATE ingrediente SET stock=stock+'$cant4' 
	WHERE idingrediente='$ing4'";
	return ejecutarConsulta($sql);
}
public function insertar5($ing5,$cant5){

	$sql="UPDATE ingrediente SET stock=stock+'$cant5' 
	WHERE idingrediente='$ing5'";
	return ejecutarConsulta($sql);
}
public function insertar6($ing6,$cant6){

	$sql="UPDATE ingrediente SET stock=stock+'$cant6' 
	WHERE idingrediente='$ing6'";
	return ejecutarConsulta($sql);
}
public function insertar7($ing7,$cant7){

	$sql="UPDATE ingrediente SET stock=stock+'$cant7' 
	WHERE idingrediente='$ing7'";
	return ejecutarConsulta($sql);
}

public function anular($iddetalle_venta){
	$sql="UPDATE detalle_venta SET estado='Anulado' WHERE iddetalle_venta='$iddetalle_venta'";
	return ejecutarConsulta($sql);
}


//implementar un metodopara mostrar los datos de unregistro a modificar
public function mostrar($iddetalle_venta){
	$sql="SELECT dv.iddetalle_venta,dv.idventa,dv.idarticulo,a.nombre,dv.cantidad,dv.precio_venta, dv.ing1, dv.cant1, dv.ing2, dv.cant2, dv.ing3, dv.cant3, dv.ing4, dv.cant4, dv.ing5, dv.cant5, dv.ing6, dv.cant6, dv.ing7, dv.cant7, dv.precio_venta,dv.estado FROM detalle_venta dv INNER JOIN articulo a ON dv.idarticulo=a.idarticulo WHERE iddetalle_venta='$iddetalle_venta'";
	return ejecutarConsultaSimpleFila($sql);
}

public function listarDetalle($idventa){
	$sql="SELECT dv.idventa,dv.idarticulo,a.nombre,dv.cantidad,dv.precio_venta,dv.descuento,(dv.cantidad*dv.precio_venta-dv.descuento) as subtotal FROM detalle_venta dv INNER JOIN articulo a ON dv.idarticulo=a.idarticulo WHERE dv.idventa='$idventa'";
	return ejecutarConsulta($sql);
}

//listar registros
public function listar(){
	$sql="SELECT dv.iddetalle_venta,dv.idventa,dv.idarticulo,a.nombre,dv.cantidad,dv.precio_venta, dv.ing1, dv.cant1, dv.ing2, dv.cant2, dv.ing3, dv.cant3, dv.ing4, dv.cant4, dv.ing5, dv.cant5, dv.ing6, dv.cant6, dv.ing7, dv.cant7, dv.precio_venta,dv.estado FROM detalle_venta dv INNER JOIN articulo a ON dv.idarticulo=a.idarticulo ORDER BY dv.idventa DESC";
	return ejecutarConsulta($sql);
}

public function ventacabecera($idventa){
	$sql= "SELECT v.idventa, v.idcliente, p.nombre AS cliente, p.direccion, p.tipo_documento, p.num_documento, p.email, p.telefono, v.idusuario, u.nombre AS usuario, v.tipo_comprobante, v.serie_comprobante, v.num_comprobante, DATE(v.fecha_hora) AS fecha, v.impuesto, v.total_venta FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
	return ejecutarConsulta($sql);
}

public function ventadetalles($idventa){
	$sql="SELECT a.nombre AS articulo, a.codigo, d.cantidad, d.precio_venta, d.descuento, (d.cantidad*d.precio_venta-d.descuento) AS subtotal FROM detalle_venta d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idventa='$idventa'";
         return ejecutarConsulta($sql);
}


}

 ?>
