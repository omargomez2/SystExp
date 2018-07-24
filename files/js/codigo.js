$(document).ready(inicio)

function inicio()
{
	$(".botoncompra").click(anade)			//anade = a~iadir
	$("#carrito").load("ponCarrito.php");
}

function anade()
{
	$("#carrito").load("ponCarrito.php?p="+$(this).val());  //load permite el uso de ajax
} 