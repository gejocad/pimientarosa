<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Articulo{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($idcategoria,$codigo,$nombre,$stock,$ing1,$cant1,$ing2,$cant2,$ing3,$cant3,$ing4,$cant4,$ing5,$cant5,$ing6,$cant6,$ing7,$cant7,$descripcion,$imagen){
	$sql="INSERT INTO articulo (idcategoria,codigo,nombre,stock,ing1,cant1,ing2,cant2,ing3,cant3,ing4,cant4,ing5,cant5,ing6,cant6,ing7,cant7,descripcion,imagen,condicion)
	 VALUES ('$idcategoria','$codigo','$nombre','$stock','$ing1','$cant1','$ing2','$cant2','$ing3','$cant3','$ing4','$cant4','$ing5','$cant5','$ing6','$cant6','$ing7','$cant7','$descripcion','$imagen','1')";
	return ejecutarConsulta($sql);
}

public function editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$ing1,$cant1,$ing2,$cant2,$ing3,$cant3,$ing4,$cant4,$ing5,$cant5,$ing6,$cant6,$ing7,$cant7,$descripcion,$imagen){
	$sql="UPDATE articulo SET idcategoria='$idcategoria',codigo='$codigo', nombre='$nombre',stock='$stock',ing1='$ing1',cant1='$cant1',ing2='$ing2',cant2='$cant2',ing3='$ing3',cant3='$cant3',ing4='$ing4',cant4='$cant4',ing5='$ing5',cant5='$cant5',ing6='$ing6',cant6='$cant6',ing7='$ing7',cant7='$cant7',descripcion='$descripcion',imagen='$imagen' 
	WHERE idarticulo='$idarticulo'";
	return ejecutarConsulta($sql);
}
public function desactivar($idarticulo){
	$sql="UPDATE articulo SET condicion='0' WHERE idarticulo='$idarticulo'";
	return ejecutarConsulta($sql);
}
public function activar($idarticulo){
	$sql="UPDATE articulo SET condicion='1' WHERE idarticulo='$idarticulo'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idarticulo){
	$sql="SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM articulo WHERE condicion=1";
	return ejecutarConsulta($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT a.idarticulo,a.idcategoria,a.nombre as nombre,c.nombre as categoria,a.codigo, a.stock,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria ORDER BY a.idarticulo DESC";
	return ejecutarConsulta($sql);
}

//listar registros activos
public function listarActivos(){
	$sql="SELECT a.idarticulo,a.idcategoria,a.nombre as nombre,a.idcategoria,c.nombre as categoria,a.codigo,a.stock,a.ing1,a.cant1,a.ing2,a.cant2,a.ing3,a.cant3,a.ing4,a.cant4,a.ing5,a.cant5,a.ing6,a.cant6,a.ing7,a.cant7,a.descripcion,a.imagen,a.condicion FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
	return ejecutarConsulta($sql);
}

//implementar un metodo para listar los activos, su ultimo precio y el stock(vamos a unir con el ultimo registro de la tabla detalle_ingreso)
public function listarActivosVenta(){
	$sql="SELECT a.idarticulo,a.idcategoria,a.nombre as nombre,a.idcategoria,c.nombre as categoria,a.codigo,a.stock,a.ing1,a.cant1,a.ing2,a.cant2,a.ing3,a.cant3,a.ing4,a.cant4,a.ing5,a.cant5,a.ing6,a.cant6,a.ing7,a.cant7,a.descripcion,a.imagen,a.condicion,(SELECT precio_venta FROM detalle_ingreso WHERE idarticulo=a.idarticulo ORDER BY iddetalle_ingreso DESC LIMIT 0,1) AS precio_venta FROM articulo a INNER JOIN categoria c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
	return ejecutarConsulta($sql);
}

}
 ?>
