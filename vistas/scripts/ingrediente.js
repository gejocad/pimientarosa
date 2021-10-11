var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   listar();

   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })


}

//funcion limpiar
function limpiar(){
	$("#codigo").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
	$("#stock").val("");
	$("#print").hide();
	$("#idingrediente").val("");
}

//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//cancelar form
function cancelarform(){
	limpiar();
	mostrarform(false);
}

//funcion listar
function listar(){
	tabla=$('#tbllistado').DataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/ingrediente.php?op=listar',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"createdRow": function( row, data){
			if( data[3] <= 5  ){
				$(row).css('background-color', '#ff3333');
			}
			else if( data[3] >= 5 && data[3] <=30 ){
				$(row).css('background-color', '#A497E5');
			}
			else{
				$(row).css('background-color', '#9EF395');
			}

		}})
}
//funcion para guardaryeditar
function guardaryeditar(e){
	e.preventDefault();//no se activara la accion predeterminada 
	$("#btnGuardar").prop("disabled",true);
	var formData=new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/ingrediente.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos){
			bootbox.alert(datos);
			mostrarform(false);
			tabla.ajax.reload();
		}
	});

	limpiar();
}

function mostrar(idingrediente){
	$.post("../ajax/ingrediente.php?op=mostrar",{idingrediente : idingrediente},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);
			$("#idingrediente").val(data.idingrediente);
			$("#codigo").val(data.codigo);
			$("#nombre").val(data.nombre);
			$("#stock").val(data.stock);
			$("#descripcion").val(data.descripcion);
			generarbarcode();
		})
}


//funcion para desactivar
function desactivar(idingrediente){
	bootbox.confirm("¿Esta seguro de desactivar este dato?", function(result){
		if (result) {
			$.post("../ajax/ingrediente.php?op=desactivar", {idingrediente : idingrediente}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idingrediente){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/ingrediente.php?op=activar" , {idingrediente : idingrediente}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function generarbarcode(){
	codigo=$("#codigo").val();
	JsBarcode("#barcode",codigo);
	$("#print").show();

}

function imprimir(){
	$("#print").printArea();
}

init();