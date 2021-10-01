<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Ingreso_ingrediente{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro
public function insertar($idproveedor,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_compra,$idingrediente,$cantidad,$precio_compra,$precio_venta){
	$sql="INSERT INTO ingreso_ingrediente (idproveedor,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_compra,estado) VALUES ('$idproveedor','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$impuesto','$total_compra','Aceptado')";
	//return ejecutarConsulta($sql);
	 $idingreso_ingredientenew=ejecutarConsulta_retornarID($sql);
	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($idingrediente)) {

	 	$sql_detalle="INSERT INTO detalle_ingreso_ingrediente (idingreso_ingrediente,idingrediente,cantidad,precio_compra,precio_venta) VALUES('$idingreso_ingredientenew','$idingrediente[$num_elementos]','$cantidad[$num_elementos]','$precio_compra[$num_elementos]','$precio_venta[$num_elementos]')";

	 	ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}

public function anular($idingreso){
	$sql="UPDATE ingreso SET estado='Anulado' WHERE idingreso='$idingreso'";
	return ejecutarConsulta($sql);
}


//metodo para mostrar registros
public function mostrar($idingreso_ingrediente){
	$sql="SELECT i.idingreso_ingrediente,DATE(i.fecha_hora) as fecha,i.idproveedor,p.nombre as proveedor,u.idusuario,u.nombre as usuario, i.tipo_comprobante,i.serie_comprobante,i.num_comprobante,i.total_compra,i.impuesto,i.estado FROM ingreso_ingrediente i INNER JOIN persona p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario WHERE idingreso_ingrediente='$idingreso_ingrediente'";
	return ejecutarConsultaSimpleFila($sql);
}

public function listarDetalle($idingreso_ingrediente){
	$sql="SELECT di.idingreso_ingrediente,di.idingrediente,a.nombre,di.cantidad,di.precio_compra,di.precio_venta FROM detalle_ingreso_ingrediente di INNER JOIN ingrediente a ON di.idingrediente=a.idingrediente WHERE di.idingreso_ingrediente='$idingreso_ingrediente'";
	return ejecutarConsulta($sql);
}

//listar registros
public function listar(){
	$sql="SELECT i.idingreso_ingrediente,DATE(i.fecha_hora) as fecha,i.idproveedor,p.nombre as proveedor,u.idusuario,u.nombre as usuario, i.tipo_comprobante,i.serie_comprobante,i.total_compra,i.estado FROM ingreso_ingrediente i INNER JOIN persona p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario ORDER BY i.idingreso_ingrediente DESC";
	return ejecutarConsulta($sql);
}


}

 ?>
