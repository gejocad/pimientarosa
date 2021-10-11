var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   listar();

   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   });

   
   //cargamos los items al celect ingrediente1
   $.post("../ajax/ingrediente.php?op=select", function(r){
	$("#ing1").html(r);
	$("#ing1").selectpicker('refresh');
});

   //cargamos los items al celect ingrediente1
   $.post("../ajax/ingrediente.php?op=select", function(r){
	$("#ing2").html(r);
	$("#ing2").selectpicker('refresh');
});

   //cargamos los items al celect ingrediente1
   $.post("../ajax/ingrediente.php?op=select", function(r){
	$("#ing3").html(r);
	$("#ing3").selectpicker('refresh');
});
 


   //cargamos los items al celect ingrediente1
   $.post("../ajax/ingrediente.php?op=select", function(r){
	$("#ing4").html(r);
	$("#ing4").selectpicker('refresh');
});
 

   //cargamos los items al celect ingrediente1
   $.post("../ajax/ingrediente.php?op=select", function(r){
	$("#ing5").html(r);
	$("#ing5").selectpicker('refresh');
});
 

   //cargamos los items al celect ingrediente1
   $.post("../ajax/ingrediente.php?op=select", function(r){
	$("#ing6").html(r);
	$("#ing6").selectpicker('refresh');
});

   //cargamos los items al celect ingrediente1
   $.post("../ajax/ingrediente.php?op=select", function(r){
	$("#ing7").html(r);
	$("#ing7").selectpicker('refresh');
});


}

//funcion limpiar
function limpiar(){

	$("#idcliente").val("");
	$("#cliente").val("");
	$("#serie_comprobante").val("");
	$("#num_comprobante").val("");
	$("#impuesto").val("");

	$("#total_venta").val("");
	$(".filas").remove();
	$("#total").html("0");

	//obtenemos la fecha actual
	var now = new Date();
	var day =("0"+now.getDate()).slice(-2);
	var month=("0"+(now.getMonth()+1)).slice(-2);
	var today=now.getFullYear()+"-"+(month)+"-"+(day);
	$("#fecha_hora").val(today);

	//marcamos el primer tipo_documento
	$("#tipo_comprobante").val("Boleta");
	$("#tipo_comprobante").selectpicker('refresh');

}

//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		//$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();

		$("#btnCancelar").show();
		detalles=0;
		$("#btnAgregarArt").show();


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
			url:'../ajax/venta_ingrediente.php?op=listar',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	});
}


//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     //$("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/venta_ingrediente.php?op=guardaryeditar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos);
     		mostrarform(false);
     		listar();
     	}
     });

     limpiar();
}

function mostrar(iddetalle_venta){
	$.post("../ajax/venta_ingrediente.php?op=mostrar",{iddetalle_venta : iddetalle_venta},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);

			$("#idarticulo").val(data.idarticulo);
			$("#stock").val(data.cantidad);
			$("#nombre").val(data.nombre);
			$("#ing1").val(data.ing1);
			$("#ing1").selectpicker('refresh');
			$("#cant1").val(data.cant1);
			$("#ing2").val(data.ing2);
			$("#ing2").selectpicker('refresh');
			$("#cant2").val(data.cant2);
			$("#ing3").val(data.ing3);
			$("#ing3").selectpicker('refresh');
			$("#cant3").val(data.cant3);
			$("#ing4").val(data.ing4);
			$("#ing4").selectpicker('refresh');
			$("#cant4").val(data.cant4);
			$("#ing5").val(data.ing5);
			$("#ing5").selectpicker('refresh');
			$("#cant5").val(data.cant5);
			$("#ing6").selectpicker('refresh');
			$("#cant6").val(data.cant5);
			$("#ing7").selectpicker('refresh');
			$("#cant7").val(data.cant5);
			
			//ocultar y mostrar los botones
			$("#btnCancelar").show();
			$("#btnAgregarArt").hide();
		});

}


//funcion para desactivar
function anular(iddetalle_venta){
	bootbox.confirm("¿Esta seguro de desactivar este dato?", function(result){
		if (result) {
			$.post("../ajax/venta_ingrediente.php?op=anular", {iddetalle_venta : iddetalle_venta}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//declaramos variables necesarias para trabajar con las compras y sus detalles
var impuesto=18;
var cont=0;
var detalles=0;

$("#tipo_comprobante").change(marcarImpuesto);

function marcarImpuesto(){
	var tipo_comprobante=$("#tipo_comprobante option:selected").text();
	if (tipo_comprobante=='Factura') {
		$("#impuesto").val(impuesto);
	}else{
		$("#impuesto").val("0");
	}
}

function agregarDetalle(idarticulo,articulo,precio_venta){
	var cantidad=1;
	var descuento=0;

	if (idarticulo!="") {
		var subtotal=cantidad*precio_venta;
		var fila='<tr class="filas" id="fila'+cont+'">'+
        '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
        '<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>'+
        '<td><input type="number" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
        '<td><input type="number" name="precio_venta[]" id="precio_venta[]" value="'+precio_venta+'"></td>'+
        '<td><input type="number" name="descuento[]" value="'+descuento+'"></td>'+
        '<td><span id="subtotal'+cont+'" name="subtotal">'+subtotal+'</span></td>'+
        '<td><button type="button" onclick="modificarSubtotales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
		'</tr>';
		cont++;
		detalles++;
		$('#detalles').append(fila);
		modificarSubtotales();

	}else{
		alert("error al ingresar el detalle, revisar las datos del articulo ");
	}
}

function modificarSubtotales(){
	var cant=document.getElementsByName("cantidad[]");
	var prev=document.getElementsByName("precio_venta[]");
	var desc=document.getElementsByName("descuento[]");
	var sub=document.getElementsByName("subtotal");


	for (var i = 0; i < cant.length; i++) {
		var inpV=cant[i];
		var inpP=prev[i];
		var inpS=sub[i];
		var des=desc[i];


		inpS.value=(inpV.value*inpP.value)-des.value;
		document.getElementsByName("subtotal")[i].innerHTML=inpS.value;
	}

	calcularTotales();
}

function calcularTotales(){
	var sub = document.getElementsByName("subtotal");
	var total=0.0;

	for (var i = 0; i < sub.length; i++) {
		total += document.getElementsByName("subtotal")[i].value;
	}
	$("#total").html("S/." + total);
	$("#total_venta").val(total);
	evaluar();
}

function evaluar(){

	if (detalles>0) 
	{
		$("#btnGuardar").show();
	}
	else
	{
		$("#btnGuardar").hide();
		cont=0;
	}
}

function eliminarDetalle(indice){
$("#fila"+indice).remove();
calcularTotales();
detalles=detalles-1;

}

init();