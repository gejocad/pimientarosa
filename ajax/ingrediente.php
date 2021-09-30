<?php 
require_once "../modelos/Ingrediente.php";

$ingrediente=new Ingrediente();

$idingrediente=isset($_POST["idingrediente"])? limpiarCadena($_POST["idingrediente"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idingrediente)) {
		$rspta=$ingrediente->insertar($codigo,$nombre,$stock,$descripcion);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$ingrediente->editar($idingrediente,$codigo,$nombre,$stock,$descripcion);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'desactivar':
		$rspta=$ingrediente->desactivar($idingrediente);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;
	case 'activar':
		$rspta=$ingrediente->activar($idingrediente);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$ingrediente->mostrar($idingrediente);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$ingrediente->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idingrediente.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idingrediente.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idingrediente.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idingrediente.')"><i class="fa fa-check"></i></button>',
            "1"=>$reg->nombre,
            "2"=>$reg->codigo,
			"3"=>$reg->stock,
            "4"=>$reg->descripcion,
			"5"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
			
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

		case 'select':
			require_once "../modelos/Ingrediente.php";
			$ingrediente=new Ingrediente();

			$rspta=$ingrediente->select();

			while ($reg=$rspta->fetch_object()) {
				echo '<option value=' . $reg->idingrediente.'>'.$reg->nombre.'</option>';
			}
			break;
}
 ?>