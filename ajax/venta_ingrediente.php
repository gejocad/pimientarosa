<?php 
require_once "../modelos/Venta_ingrediente.php";
if (strlen(session_id())<1) 
	session_start();

$venta_ingrediente = new Venta_ingrediente();

$iddetalle_venta=isset($_POST["iddetalle_venta"])? limpiarCadena($_POST["iddetalle_venta"]):"";
$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$ing1=isset($_POST["ing1"])? limpiarCadena($_POST["ing1"]):"";
$cant1=isset($_POST["cant1"])? limpiarCadena($_POST["cant1"]):"";
$ing2=isset($_POST["ing2"])? limpiarCadena($_POST["ing2"]):"";
$cant2=isset($_POST["cant2"])? limpiarCadena($_POST["cant2"]):"";
$ing3=isset($_POST["ing3"])? limpiarCadena($_POST["ing3"]):"";
$cant3=isset($_POST["cant3"])? limpiarCadena($_POST["cant3"]):"";
$ing4=isset($_POST["ing4"])? limpiarCadena($_POST["ing4"]):"";
$cant4=isset($_POST["cant4"])? limpiarCadena($_POST["cant4"]):"";
$ing5=isset($_POST["ing5"])? limpiarCadena($_POST["ing5"]):"";
$cant5=isset($_POST["cant5"])? limpiarCadena($_POST["cant5"]):"";
$ing6=isset($_POST["ing6"])? limpiarCadena($_POST["ing6"]):"";
$cant6=isset($_POST["cant6"])? limpiarCadena($_POST["cant6"]):"";
$ing7=isset($_POST["ing7"])? limpiarCadena($_POST["ing7"]):"";
$cant7=isset($_POST["cant7"])? limpiarCadena($_POST["cant7"]):"";





switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($iddetalle_venta)) {
		$rspta=$venta_ingrediente->insertar($idarticulo,$nombre,$stock);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
		$rspta=$venta_ingrediente->insertar1($ing1,$cant1);
		echo $rspta ? "" : "";
		$rspta=$venta_ingrediente->insertar2($ing2,$cant2);
		echo $rspta ? "" : "";
		$rspta=$venta_ingrediente->insertar3($ing3,$cant3);
		echo $rspta ? "" : "";
		$rspta=$venta_ingrediente->insertar4($ing4,$cant4);
		echo $rspta ? "" : "";
		$rspta=$venta_ingrediente->insertar5($ing5,$cant5);
		echo $rspta ? "" : "";
		$rspta=$venta_ingrediente->insertar6($ing6,$cant6);
		echo $rspta ? "" : "";
		$rspta=$venta_ingrediente->insertar7($ing7,$cant7);
		echo $rspta ? "" : "";
		$rspta=$venta_ingrediente->anular($iddetalle_venta);
		echo $rspta ? "" : "";
	}else{
        
	}
		break;
	

	case 'anular':
		$rspta=$venta_ingrediente->anular($iddetalle_venta);
		echo $rspta ? "Ingreso anulado correctamente" : "No se pudo anular el ingreso";
		break;
	
	case 'mostrar':
		$rspta=$venta_ingrediente->mostrar($iddetalle_venta);
		echo json_encode($rspta);
		break;


		case 'listar':
			$rspta=$venta_ingrediente->listar();
			$data=Array();
		
			while ($reg=$rspta->fetch_object()) {
			$data[]=array(
				"0"=>($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->iddetalle_venta.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->iddetalle_venta.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->iddetalle_venta.')"><i class="fa fa-eye"></i></button>',
					"1"=>$reg->idventa,
					"2"=>$reg->nombre,
					"3"=>$reg->cantidad,
					"4"=>$reg->ing1,
					"5"=>$reg->cant1,
					"6"=>$reg->ing2,
					"7"=>$reg->cant2,
					"8"=>$reg->ing3,
					"9"=>$reg->cant3,
					"10"=>$reg->ing4,
					"11"=>$reg->cant4,
					"12"=>$reg->ing5,
					"13"=>$reg->cant5,
					"14"=>$reg->ing6,
					"15"=>$reg->cant6,
					"16"=>$reg->ing7,
					"17"=>$reg->cant7,
					"18"=>$reg->precio_venta,
					"19"=>$reg->estado
				  );
			}
			$results=array(
				 "sEcho"=>1,//info para datatables
				 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
				 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
				 "aaData"=>$data); 
			echo json_encode($results);
			break;
}
 ?>

			