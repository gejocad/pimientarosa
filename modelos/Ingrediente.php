<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Ingrediente{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($codigo,$nombre,$stock,$descripcion){
	$sql="INSERT INTO ingrediente (codigo,nombre,stock,descripcion,condicion)
	 VALUES ('$codigo','$nombre','$stock','$descripcion','1')";
	return ejecutarConsulta($sql);
}

public function editar($idingrediente,$codigo,$nombre,$stock,$descripcion){
	$sql="UPDATE ingrediente SET codigo='$codigo',nombre='$nombre',stock='$stock',descripcion='$descripcion' 
	WHERE idingrediente='$idingrediente'";
	return ejecutarConsulta($sql);
}



public function desactivar($idingrediente){
	$sql="UPDATE ingrediente SET condicion='0' WHERE idingrediente='$idingrediente'";
	return ejecutarConsulta($sql);
}
public function activar($idingrediente){
	$sql="UPDATE ingrediente SET condicion='1' WHERE idingrediente='$idingrediente'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idingrediente){
	$sql="SELECT * FROM ingrediente WHERE idingrediente='$idingrediente'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM ingrediente WHERE condicion=1";
	return ejecutarConsulta($sql);
}

//listar registros 
public function listar(){
	$sql="SELECT * FROM ingrediente";
	return ejecutarConsulta($sql);
}





}
 ?>
