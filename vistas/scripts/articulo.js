var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   listar();

   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })


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

 

 



   //cargamos los items al celect categoria
   $.post("../ajax/articulo.php?op=selectCategoria", function(r){
   	$("#idcategoria").html(r);
   	$("#idcategoria").selectpicker('refresh');
   });
   $("#imagenmuestra").hide();
}

//funcion limpiar
function limpiar(){
	$("#codigo").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
	$("#stock").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#print").hide();
	$("#idarticulo").val("");
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
	tabla=$('#tbllistado').dataTable({
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
			url:'../ajax/articulo.php?op=listar',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":5,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}
//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/articulo.php?op=guardaryeditar",
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

function mostrar(idarticulo){
	$.post("../ajax/articulo.php?op=mostrar",{idarticulo : idarticulo},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);

			$("#idcategoria").val(data.idcategoria);
			$("#idcategoria").selectpicker('refresh');
			$("#codigo").val(data.codigo);
			$("#nombre").val(data.nombre);
			$("#stock").val(data.stock);
			$("#descripcion").val(data.descripcion);
			$("#imagenmuestra").show();
			$("#imagenmuestra").attr("src","../files/articulos/"+data.imagen);
			$("#imagenactual").val(data.imagen);
			$("#idarticulo").val(data.idarticulo);
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
			generarbarcode();
		})
}


//funcion para desactivar
function desactivar(idarticulo){
	bootbox.confirm("¿Esta seguro de desactivar este dato?", function(result){
		if (result) {
			$.post("../ajax/articulo.php?op=desactivar", {idarticulo : idarticulo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idarticulo){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/articulo.php?op=activar" , {idarticulo : idarticulo}, function(e){
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