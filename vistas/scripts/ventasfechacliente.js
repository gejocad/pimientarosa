var tabla;

//funcion que se ejecuta al inicio
function init(){

   listar();
    //cargamos los items al select cliente

}

//funcion listar
function listar(){
var  fecha_inicio = $("#fecha_inicio").val();
 var fecha_fin = $("#fecha_fin").val();

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
			url:'../ajax/consultas.php?op=ventasfechacliente',
			data:{fecha_inicio:fecha_inicio, fecha_fin:fecha_fin},
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
                .column(5)//numero de columna a sumar
                //.column(1, {page: 'current'})//para sumar solo la pagina actual
                .data()
                .reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0 );

            $(this.api().column(5).footer()).html(total);
            
        }
	})

}
init();  