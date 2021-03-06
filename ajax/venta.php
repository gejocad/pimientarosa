<?php 
require_once "../modelos/Venta.php";
if (strlen(session_id())<1) 
	session_start();

$venta = new Venta();

$idventa=isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$iddetalle_articulo=isset($_POST["iddetalle_articulo"])? limpiarCadena($_POST["iddetalle_articulo"]):"";
$idusuario=$_SESSION["idusuario"];
$tipo_comprobante=isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";
$serie_comprobante=isset($_POST["serie_comprobante"])? limpiarCadena($_POST["serie_comprobante"]):"";
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$mesa=isset($_POST["mesa"])? limpiarCadena($_POST["mesa"]):"";
$total_venta=isset($_POST["total_venta"])? limpiarCadena($_POST["total_venta"]):"";





switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idventa)) {
		$rspta=$venta->insertar($idcliente,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$mesa,$total_venta,$_POST["idarticulo"],$_POST["cantidad"],$_POST["ing1"],$_POST["cant1"],$_POST["ing2"],$_POST["cant2"],$_POST["ing3"],$_POST["cant3"],$_POST["ing4"],$_POST["cant4"],$_POST["ing5"],$_POST["cant5"],$_POST["ing6"],$_POST["cant6"],$_POST["ing7"],$_POST["cant7"],$_POST["precio_venta"],$_POST["descuento"]); 
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
			 $rspta=$venta->editar($idventa,$idcliente,$idusuario,$mesa,$total_venta,$_POST["idarticulo"],$_POST["cantidad"],$_POST["ing1"],$_POST["cant1"],$_POST["ing2"],$_POST["cant2"],$_POST["ing3"],$_POST["cant3"],$_POST["ing4"],$_POST["cant4"],$_POST["ing5"],$_POST["cant5"],$_POST["ing6"],$_POST["cant6"],$_POST["ing7"],$_POST["cant7"],$_POST["precio_venta"],$_POST["descuento"]);
			echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'anular':
		$rspta=$venta->anular($idventa);
		echo $rspta ? "Ingreso anulado correctamente" : "No se pudo anular el ingreso";
		break;
	
	case 'mostrar':
		$rspta=$venta->mostrar($idventa);
		echo json_encode($rspta);
		break;

	case 'listarDetalle':
		//recibimos el idventa
		$id=$_GET['id'];

		$rspta=$venta->listarDetalle($id);
		$total=0;
		echo ' <thead style="background-color:#A9D0F5">
        <th>Opciones</th>
        <th>Articulo</th>
        <th>Cantidad</th>
        <th>Precio Venta</th>
        <th>Descuento</th>
        <th>Subtotal</th>
       </thead>';
		while ($reg=$rspta->fetch_object()) {
			echo '<tr class="filas">
			<td></td>
			<td>'.$reg->nombre.'</td>
			<td>'.$reg->cantidad.'</td>
			<td>'.$reg->precio_venta.'</td>
			<td>'.$reg->descuento.'</td>
			<td>'.$reg->subtotal.'</td></tr>';
			$total=$total+($reg->precio_venta*$reg->cantidad-$reg->descuento);
		}
		echo '<tfoot>
         <th>TOTAL</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th><h4 id="total">$ '.$total.'</h4><input type="hidden" name="total_venta" id="total_venta"></th>
       </tfoot>';
		break;

    case 'listar':
		$rspta=$venta->listar();
		$data=Array();
		$uno='1';
		while ($reg=$rspta->fetch_object()) {
                 if ($reg->tipo_comprobante=='Ticket') {
                 	$url='../reportes/exTicket.php?id=';
                 }else{
                    $url='../reportes/exTicket.php?id=';
                 }

			$data[]=array(
            "0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
            '<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
            "1"=>$reg->cliente,
            "2"=>number_format($reg->total_venta, 0, ',', '.'),
            "3"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
              );
		}
		$results=array(
				
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

		case 'listar1':
			$rspta=$venta->listar1();
			$data=Array();
			$dos=2;
	
			while ($reg=$rspta->fetch_object()) {
					 if ($reg->tipo_comprobante=='Ticket') {
						 $url='../reportes/exTicket.php?id=';
					 }else{
						$url='../reportes/exTicket.php?id=';
					 }
	
				$data[]=array(
				"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
				'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
				"1"=>$reg->cliente,
				"2"=>number_format($reg->total_venta, 0, ',', '.'),
				"3"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
				  );
			}
			$results=array(
				 "sEcho"=>1,//info para datatables
				 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
				 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
				 "aaData"=>$data); 
			echo json_encode($results);
			break;
		
		case 'listar2':
			$rspta=$venta->listar2();
			$data=Array();
	
			while ($reg=$rspta->fetch_object()) {
					 if ($reg->tipo_comprobante=='Ticket') {
						 $url='../reportes/exTicket.php?id=';
					 }else{
						$url='../reportes/exTicket.php?id=';
					 }
	
				$data[]=array(
				"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
				'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
				"1"=>$reg->cliente,
				"2"=>number_format($reg->total_venta, 0, ',', '.'),
				"3"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
				  );
			}
			$results=array(
				 "sEcho"=>1,//info para datatables
				 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
				 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
				 "aaData"=>$data); 
			echo json_encode($results);
			break;

		case 'listar3':
			$rspta=$venta->listar3();
			$data=Array();
	
			while ($reg=$rspta->fetch_object()) {
					 if ($reg->tipo_comprobante=='Ticket') {
						 $url='../reportes/exTicket.php?id=';
					 }else{
						$url='../reportes/exTicket.php?id=';
					 }
	
				$data[]=array(
				"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
				'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
				"1"=>$reg->cliente,
				"2"=>number_format($reg->total_venta, 0, ',', '.'),
				"3"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
				  );
			}
			$results=array(
				 "sEcho"=>1,//info para datatables
				 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
				 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
				 "aaData"=>$data); 
			echo json_encode($results);
			break;
		
		case 'listar4':
			$rspta=$venta->listar4();
			$data=Array();
	
			while ($reg=$rspta->fetch_object()) {
					 if ($reg->tipo_comprobante=='Ticket') {
						 $url='../reportes/exTicket.php?id=';
					 }else{
						$url='../reportes/exTicket.php?id=';
					 }
	
				$data[]=array(
				"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
				'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
				"1"=>$reg->cliente,
				"2"=>number_format($reg->total_venta, 0, ',', '.'),
				"3"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
				  );
			}
			$results=array(
				 "sEcho"=>1,//info para datatables
				 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
				 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
				 "aaData"=>$data); 
			echo json_encode($results);
			break;
		
			case 'listar5':
				$rspta=$venta->listar5();
				$data=Array();
		
				while ($reg=$rspta->fetch_object()) {
						 if ($reg->tipo_comprobante=='Ticket') {
							 $url='../reportes/exTicket.php?id=';
						 }else{
							$url='../reportes/exTicket.php?id=';
						 }
		
					$data[]=array(
					"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
					'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
					"1"=>$reg->cliente,
					"2"=>number_format($reg->total_venta, 0, ',', '.'),
					"3"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
					  );
				}
				$results=array(
					 "sEcho"=>1,//info para datatables
					 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
					 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
					 "aaData"=>$data); 
				echo json_encode($results);
				break;
		
		case 'listar6':
			$rspta=$venta->listar6();
			$data=Array();
	
			while ($reg=$rspta->fetch_object()) {
					 if ($reg->tipo_comprobante=='Ticket') {
						 $url='../reportes/exTicket.php?id=';
					 }else{
						$url='../reportes/exTicket.php?id=';
					 }
	
				$data[]=array(
				"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
				'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
				"1"=>$reg->cliente,
				"2"=>number_format($reg->total_venta, 0, ',', '.'),
				"3"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
				  );
			}
			$results=array(
				 "sEcho"=>1,//info para datatables
				 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
				 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
				 "aaData"=>$data); 
			echo json_encode($results);
			break;
		
		case 'listar7':
			$rspta=$venta->listar7();
			$data=Array();
	
			while ($reg=$rspta->fetch_object()) {
					 if ($reg->tipo_comprobante=='Ticket') {
						 $url='../reportes/exTicket.php?id=';
					 }else{
						$url='../reportes/exTicket.php?id=';
					 }
	
				$data[]=array(
				"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
				'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
				"1"=>$reg->cliente,
				"2"=>number_format($reg->total_venta, 0, ',', '.'),
				"3"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
				  );
			}
			$results=array(
				 "sEcho"=>1,//info para datatables
				 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
				 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
				 "aaData"=>$data); 
			echo json_encode($results);
			break;
		
		case 'listar8':
			$rspta=$venta->listar8();
			$data=Array();
	
			while ($reg=$rspta->fetch_object()) {
					 if ($reg->tipo_comprobante=='Ticket') {
						 $url='../reportes/exTicket.php?id=';
					 }else{
						$url='../reportes/exTicket.php?id=';
					 }
	
				$data[]=array(
				"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
				'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
				"1"=>$reg->cliente,
				"2"=>number_format($reg->total_venta, 0, ',', '.'),
				"3"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
				  );
			}
			$results=array(
				 "sEcho"=>1,//info para datatables
				 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
				 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
				 "aaData"=>$data); 
			echo json_encode($results);
			break;

		case 'listar9':
			$rspta=$venta->listar9();
			$data=Array();
	
			while ($reg=$rspta->fetch_object()) {
					 if ($reg->tipo_comprobante=='Ticket') {
						 $url='../reportes/exTicket.php?id=';
					 }else{
						$url='../reportes/exTicket.php?id=';
					 }
	
				$data[]=array(
				"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
				'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
				"1"=>$reg->cliente,
				"2"=>number_format($reg->total_venta, 0, ',', '.'),
				"3"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
				  );
			}
			$results=array(
				 "sEcho"=>1,//info para datatables
				 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
				 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
				 "aaData"=>$data); 
			echo json_encode($results);
			break;
			
		case 'listar10':
			$rspta=$venta->listar10();
			$data=Array();
	
			while ($reg=$rspta->fetch_object()) {
					 if ($reg->tipo_comprobante=='Ticket') {
						 $url='../reportes/exTicketR.php?id=';
					 }else{
						$url='../reportes/exTicketR.php?id=';
					 }
	
				$data[]=array(
				"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
				'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
				"1"=>$reg->cliente,
				"2"=>number_format($reg->total_venta, 0, ',', '.'),
				"3"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
				  );
			}
			$results=array(
				 "sEcho"=>1,//info para datatables
				 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
				 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
				 "aaData"=>$data); 
			echo json_encode($results);
			break;
		case 'listar11':
			$rspta=$venta->listar11();
			$data=Array();
	
			while ($reg=$rspta->fetch_object()) {
					 if ($reg->tipo_comprobante=='Ticket') {
						 $url='../reportes/exTicketD.php?id=';
					 }else{
						$url='../reportes/exTicketD.php?id=';
					 }
	
				$data[]=array(
				"0"=>(($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>').
				'<a target="_blank" href="'.$url.$reg->idventa.'"> <button class="btn btn-info btn-xs"><i class="fa fa-file"></i></button></a>',
				"1"=>$reg->cliente,
				"2"=>number_format($reg->total_venta, 0, ',', '.'),
				"3"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':'<span class="label bg-red">Anulado</span>'
				  );
			}
			$results=array(
				 "sEcho"=>1,//info para datatables
				 "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
				 "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
				 "aaData"=>$data); 
			echo json_encode($results);
			break;
			
			
		case 'selectCliente':
			require_once "../modelos/Persona.php";
			$persona = new Persona();

			$rspta = $persona->listarc();

			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->idpersona.'>'.$reg->nombre.' Nro. doc: '.$reg->num_documento.'</option>';
			}
			break;


			case 'listarArticulos':
			require_once "../modelos/Articulo.php";
			$articulo=new Articulo();

				$rspta=$articulo->listarActivosVenta();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idarticulo.',\''.$reg->nombre.'\',\''.$reg->ing1.'\',\''.$reg->cant1.'\',\''.$reg->ing2.'\',\''.$reg->cant2.'\',\''.$reg->ing3.'\',\''.$reg->cant3.'\',\''.$reg->ing4.'\',\''.$reg->cant4.'\',\''.$reg->ing5.'\',\''.$reg->cant5.'\',\''.$reg->ing6.'\',\''.$reg->cant6.'\',\''.$reg->ing7.'\',\''.$reg->cant7.'\','.$reg->precio_venta.')"><span class="fa fa-plus"></span></button>',
            "1"=>$reg->nombre,
            "2"=>$reg->categoria,
            "3"=>$reg->codigo,
			"4"=>$reg->stock,
			"5"=>$reg->cant1,
			"6"=>$reg->cant2,
			"7"=>$reg->cant3,
			"8"=>$reg->cant4,
			"9"=>$reg->cant5,
			"10"=>$reg->cant6,
			"11"=>$reg->cant7,
            "12"=>number_format($reg->precio_venta, 0, ',', '.'),
            "13"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px'>"
          
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