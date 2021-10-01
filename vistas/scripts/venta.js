var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   mostrarform2(false);
   listar();
   listar1();
   listar2();
   listar3();
   listar4();
   listar5();
   listar6();
   listar7();
   listar8();
   listar9();
   listar10();
   listar11();

   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })
   $("#formulario2").on("submit",function(e){
	guardaryeditar2(e);
});  
   ;

   //cargamos los items al select cliente
   $.post("../ajax/venta.php?op=selectCliente", function(r){
   	$("#idcliente").html(r);
   	$('#idcliente').selectpicker('refresh');
   });

   $("#prueba").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
    }
});

}

//funcion limpiar
function limpiar(){
	$("#idventa").val("");
	$("#idcliente").val("");
	$("#cliente").val("");
	$("#serie_comprobante").val("");
	$("#num_comprobante").val("");
	$("#mesa").val("");

	$("#total_venta").val("");
	$(".filas").remove();
	$("#total").html("0");

	//obtenemos la fecha actual
	var now = new Date();
	var day =("0"+now.getDate()).slice(-2);
	var month=("0"+(now.getMonth()+1)).slice(-2);
	var today=now.getFullYear()+"-"+(month)+"-"+(day);
	$("#fecha_hora").val(today);
	console.log(today)

	//marcamos el primer tipo_documento
	$("#tipo_comprobante").val("Ticket");
	$("#tipo_comprobante").selectpicker('refresh');

}

//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		listarArticulos();

		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		detalles=0;
		$("#btnAgregarArt").show();


	}else{
		
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}
function mostrarform2(flag){
	limpiar();
	if(flag){
		$("#formularioclientes").show();
		$("#btnGuardar2").prop("disabled",false);
		$("#btnagregar2").hide();

	}else{
		
		$("#formularioclientes").hide();
		$("#btnagregar").show();
	}
}

//cancelar form
function cancelarform(){
	limpiar();
	mostrarform(false);
}
function cancelarform2(){
	mostrarform2(false);
}

//funcion listar
function listar(){
	tabla=$('#tbllistado').DataTable({
		
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listar',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"footerCallback": function () {
        
            total = this.api()
                //.column(2)numero de columna a sumar
                .column(2, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(2).footer()).html(total);
            
        }
		
	})

}


function listar1(){
	tabla=$('#tbllistado1').DataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listar1',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"footerCallback": function () {
        
            total = this.api()
                //.column(2)numero de columna a sumar
                .column(2, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(2).footer()).html(total);
            
        }
	})
}
function listar2(){
	tabla=$('#tbllistado2').DataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listar2',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"footerCallback": function () {
        
            total = this.api()
                //.column(2)numero de columna a sumar
                .column(2, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(2).footer()).html(total);
            
        }
	})
}
function listar3(){
	tabla=$('#tbllistado3').DataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listar3',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"footerCallback": function () {
        
            total = this.api()
                //.column(2)numero de columna a sumar
                .column(2, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(2).footer()).html(total);
            
        }
	})
}
function listar4(){
	tabla=$('#tbllistado4').DataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listar4',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"footerCallback": function () {
        
            total = this.api()
                //.column(2)numero de columna a sumar
                .column(2, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(2).footer()).html(total);
            
        }
	})
}
function listar5(){
	tabla=$('#tbllistado5').DataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listar5',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"footerCallback": function () {
        
            total = this.api()
                //.column(2)numero de columna a sumar
                .column(2, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(2).footer()).html(total);
            
        }
	})
}
function listar6(){
	tabla=$('#tbllistado6').DataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listar6',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"footerCallback": function () {
        
            total = this.api()
               //.column(2)numero de columna a sumar
			   .column(2, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(2).footer()).html(total);
            
        }
	})
}
function listar7(){
	tabla=$('#tbllistado7').DataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listar7',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"footerCallback": function () {
        
            total = this.api()
               //.column(2)numero de columna a sumar
			   .column(2, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(2).footer()).html(total);
            
        }
	})
}
function listar8(){
	tabla=$('#tbllistado8').DataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listar8',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"footerCallback": function () {
        
            total = this.api()
                //.column(2)numero de columna a sumar
                .column(2, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(2).footer()).html(total);
            
        }
	})
}
function listar9(){
	tabla=$('#tbllistado9').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listar9',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"footerCallback": function () {
        
            total = this.api()
                //.column(2)numero de columna a sumar
                .column(2, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(2).footer()).html(total);
            
        }
	})
}
function listar10(){
	tabla=$('#tbllistado10').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listar10',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"footerCallback": function () {
        
            total = this.api()
                //.column(2)numero de columna a sumar
                .column(2, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(2).footer()).html(total);
            
        }
	})
}
function listar11(){
	tabla=$('#tbllistado11').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listar11',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"footerCallback": function () {
        
            total = this.api()
                //.column(2)numero de columna a sumar
                .column(2, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseInt(a) + parseInt(b);
                }, 0 );

            $(this.api().column(2).footer()).html(total);
            
        }
	})
}

function listarArticulos(){
	tabla=$('#tblarticulos').DataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [

		],
		"ajax":
		{
			url:'../ajax/venta.php?op=listarArticulos',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]],//ordenar (columna, orden)
		"createdRow": function( row, data, dataIndex){
			if( data[4] <= 5  ){
				$(row).css('background-color', '#ff3333');
			}
			else if( data[4] >= 5 && data[4] <=30 ){
				$(row).css('background-color', '#A497E5');
			}
			else{
				$(row).css('background-color', '#9EF395');
			}

		}
	});
}
//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     //$("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/venta.php?op=guardaryeditar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos);
     		mostrarform(false);
     		listar();
			listar1();
			listar2();
			listar3();
			listar4();
			listar5();
			listar6();
			listar7();
			listar8();
			listar9();
			listar10();
			listar11();
     	}
     });
	 limpiar();
     setTimeout(function(){ location.reload(); }, 2000);
}

function guardaryeditar2(e){
	e.preventDefault();//no se activara la accion predeterminada 
	 $("#btnGuardar2").prop("disabled",true);
	var formData=new FormData($("#formulario2")[0]);

	$.ajax({
		url: "../ajax/persona.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos){
			bootbox.alert(datos);
			mostrarform2(false);
			tabla.ajax.reload();
			
		}
	});
	limpiar();
	setTimeout(function(){ location.reload(); }, 2000);
	
}

function mostrar(idventa){
	$.post("../ajax/venta.php?op=mostrar",{idventa : idventa},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);

			$("#idcliente").val(data.idcliente);
			$("#idcliente").selectpicker('refresh');
			$("#mesa").val(data.mesa);
			$("#idventa").val(data.idventa);
			
			//ocultar y mostrar los botones
			$("#btnGuardar").show();
			$("#btnCancelar").show();
			$("#btnAgregarArt").show();
		});

}


//funcion para desactivar
function anular(idventa){
	bootbox.confirm("¿Esta seguro de desactivar este dato?", function(result){
		if (result) {
			$.post("../ajax/venta.php?op=anular", {idventa : idventa}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

//declaramos variables necesarias para trabajar con las compras y sus detalles
var mesa=0;
var cont=0;
var detalles=0;

$("#btnGuardar").hide();



function agregarDetalle(idarticulo,nombre, ing1, cant1, ing2, cant2, ing3, cant3, ing4, cant4, ing5, cant5,ing6, cant6, ing7, cant7, precio_venta){
	var cantidad=1;
	var descuento=0;

	if (idarticulo!="") {
		var subtotal=cantidad*precio_venta;
		var fila='<tr class="filas" id="fila'+cont+'">'+
        '<td><button type="button" class="btn btn-danger" onclick="eliminarDetalle('+cont+')">X</button></td>'+
        '<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+nombre+'</td>'+
        '<td><input type="hidden"   name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
        '<td><input type="hidden"   name="ing1[]" id="ing1[]" value="'+ing1+'"></td>'+
        '<td><input type="hidden"   name="cant1[]" id="cant1[]" value="'+cant1+'"></td>'+
        '<td><input type="hidden"   name="ing2[]" id="ing2[]" value="'+ing2+'"></td>'+
        '<td><input type="hidden"   name="cant2[]" id="cant2[]" value="'+cant2+'"></td>'+
        '<td><input type="hidden"   name="ing3[]" id="ing3[]" value="'+ing3+'"></td>'+
        '<td><input type="hidden"   name="cant3[]" id="cant3[]" value="'+cant3+'"></td>'+
        '<td><input type="hidden"   name="ing4[]" id="ing4[]" value="'+ing4+'"></td>'+
        '<td><input type="hidden"   name="cant4[]" id="cant4[]" value="'+cant4+'"></td>'+
        '<td><input type="hidden"   name="ing5[]" id="ing5[]" value="'+ing5+'"></td>'+
        '<td><input type="hidden"   name="cant5[]" id="cant5[]" value="'+cant5+'"></td>'+
        '<td><input type="hidden"   name="ing6[]" id="ing6[]" value="'+ing6+'"></td>'+
        '<td><input type="hidden"   name="cant6[]" id="cant6[]" value="'+cant6+'"></td>'+
        '<td><input type="hidden"   name="ing7[]" id="ing7[]" value="'+ing7+'"></td>'+
        '<td><input type="hidden"   name="cant7[]" id="cant7[]" value="'+cant7+'"></td>'+
        '<td><input type="number" readonly  name="precio_venta[]" id="precio_venta[]" value="'+precio_venta+'"></td>'+
        '<td><input type="number" readonly  name="descuento[]" value="'+descuento+'"></td>'+
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
	$("#total").html("$" + total);
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