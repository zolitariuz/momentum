(function($){

	"use strict";

	$(function(){

		/**
		 * Validación de emails
		 */
		window.validateEmail = function (email) {
			var regExp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return regExp.test(email);
		};

		/**
		 * Regresa todos los valores de un formulario como un associative array
		 */
		window.getFormData = function (selector) {
			var result = [],
				data   = $(selector).serializeArray();

			$.map(data, function (attr) {
				result[attr.name] = attr.value;
			});
			return result;
		}

		// Log out
		// agregar saldo
		$('.logout').click(function(e){
			e.preventDefault();
			var url = "Logout.php";
			$.ajax({    //create an ajax request to load_page.php					
				url: url,
				type: "POST",
				data:$(this).serialize(),
				dataType:"json",
				success: function (data) {
					if(data.logout){
						alert(1);
						window.location = "index.php";
					}
				} 
			});
		});

		// check-in/check-out hotel
		$('.hotel .check.in').click(function(){
			var url = "CheckInHotel.php";
            $.ajax({    //create an ajax request to load_page.php					
				url: url,
				type: "POST",
				data:$(this).serialize(),
				dataType:"json",
				success: function (data) {
					if(data.hotel == "1"){
						mostrarCheckOutHotel();
						mostrarCheckInEventos();	
					}
				}

    		});
		});
		$('.hotel .check.out').click(function(){
			var url = "CheckOutHotel.php";
            $.ajax({    //create an ajax request to load_page.php					
				url: url,
				type: "POST",
				data:$(this).serialize(),
				dataType:"json",
				success: function (data) {
					if(data.hotel == "-1"){
						esconderHotel();
						esconderEventos();	
					}
				}
    		});
		});

		// check-in/check-out gala
		$('.gala .check.in').click(function(){
			var url = "CheckInGala.php";
            $.ajax({    //create an ajax request to load_page.php					
				url: url,
				type: "POST",
				data:$(this).serialize(),
				dataType:"json",
				success: function (data) {
					if(data.hotel == "1"){
						mostrarCheckOutGala();	
						esconderCheckInGala();
					}	
				}

    		});
		});
		$('.gala .check.out').click(function(){
			var url = "CheckOutGala.php";
            $.ajax({    //create an ajax request to load_page.php					
				url: url,
				type: "POST",
				data:$(this).serialize(),
				dataType:"json",
				success: function (data) {
					if(data.hotel == "-1"){
						esconderCheckOutGala();
					}
				}

    		});
		});

		// check-in/check-out noche mexicana
		$('.noche_mex .check.in').click(function(){
			var url = "CheckInNocheMex.php";
            $.ajax({    //create an ajax request to load_page.php					
				url: url,
				type: "POST",
				data:$(this).serialize(),
				dataType:"json",
				success: function (data) {
					if(data.hotel == "1"){
						mostrarCheckOutNocheMex();	
						esconderCheckInNocheMex();
					}
				}

    		});
		});
		$('.noche_mex .check.out').click(function(){
			var url = "CheckOutNocheMex.php";
            $.ajax({    //create an ajax request to load_page.php					
				url: url,
				type: "POST",
				data:$(this).serialize(),
				dataType:"json",
				success: function (data) {
					if(data.hotel == "-1"){
						esconderCheckOutNocheMex();
					}
				}

    		});
		});

		// check-in/check-out noche mexicana
		$('.y2b .check.in').click(function(){
			var url = "CheckInY2B.php";
            $.ajax({    //create an ajax request to load_page.php					
				url: url,
				type: "POST",
				data:$(this).serialize(),
				dataType:"json",
				success: function (data) {
					if(data.hotel == "1"){
						mostrarCheckOutY2B();
						esconderCheckInY2B();
					}
				}

    		});
		});
		$('.y2b .check.out').click(function(){
			var url = "CheckOutY2B.php";
            $.ajax({    //create an ajax request to load_page.php					
				url: url,
				type: "POST",
				data:$(this).serialize(),
				dataType:"json",
				success: function (data) {
					if(data.hotel == "-1"){
						esconderCheckOutY2B();
					}
				}

    		});
		});

		// Restar alimentos
		$('.desayuno .restar').click(function(){
			 var url = "RestaDesayuno.php";
             $.ajax({    //create an ajax request to load_page.php					
			 	url: url,
			 	type: "POST",
			 	data:$(this).serialize(),
			 	dataType:"json",
			 	success: function (data) {
			 		if(data.desayuno == '1'){
			 			var cantidad = $('.desayuno .cantidad').text();
			 			$('.desayuno .cantidad').text(parseInt(cantidad) - 1);
			 		} else if(data.desayuno == '0'){
			 			$('.desayuno .restar').hide();
			 			var cantidad = $('.desayuno .cantidad').text();
			 			$('.desayuno .cantidad').text(parseInt(cantidad) - 1);
			 		}
			 	}

     		});
		});
		$('.comida .restar').click(function(){
			var url = "RestaComida.php";
			$.ajax({    //create an ajax request to load_page.php					
				url: url,
				type: "POST",
				data:$(this).serialize(),
				dataType:"json",
				success: function (data) {
					if(data.comida == '1'){
						var cantidad = $('.comida .cantidad').text();
						$('.comida .cantidad').text(parseInt(cantidad) - 1);
					} else if(data.comida == '0'){
						$('.comida .restar').hide();
						var cantidad = $('.comida .cantidad').text();
						$('.comida .cantidad').text(parseInt(cantidad) - 1);
					}
				}
			});
		});
		$('.cena .restar').click(function(){
			var url = "RestaCena.php";
			$.ajax({    //create an ajax request to load_page.php					
				url: url,
				type: "POST",
				data:$(this).serialize(),
				dataType:"json",
				success: function (data) {
					if(data.cena == '1'){
						var cantidad = $('.cena .cantidad').text();
						$('.cena .cantidad').text(parseInt(cantidad) - 1);
					} else if(data.cena == '0'){
						$('.cena .restar').hide();
						var cantidad = $('.cena .cantidad').text();
						$('.cena .cantidad').text(parseInt(cantidad) - 1);
					}
				}
			});
		});

		// agregar saldo
		$('.saldo-form input[type="submit"]').click(function(e){
			e.preventDefault();
			var saldo = $('.saldo-form input[type="text"]').val();
			var url = "AgregaSaldo.php?saldo=" + saldo;
			$.ajax({    //create an ajax request to load_page.php					
				url: url,
				type: "GET",
				data:$(this).serialize(),
				dataType:"json",
				success: function (data) {
					if(data.agregado == '1'){
						$('.saldo').text("Saldo: $"+data.saldo+".00 US");	
						alert("Se agregaron $" + saldo + ".00 US correctamente.");
						$('.saldo-form input[type="text"]').val("");
					} 
				}
			});
		});
	});
})(jQuery);

// mostrar
function mostrarCheckInHotel(){
	$(".hotel .check.in").fadeIn();
	$(".hotel .check.out").hide();
}
function mostrarCheckOutHotel(){
	$(".hotel .check.in").hide();
	$(".hotel .check.out").fadeIn();
}
function mostrarCheckInEventos(){
	$(".gala").fadeIn();
	$(".noche_mex").fadeIn();
	$(".y2b").fadeIn();
}
function mostrarCheckOutGala(){
	$(".gala .check.in").hide();
	$(".gala .check.out").fadeIn();
}
function mostrarCheckOutNocheMex(){
	$(".noche_mex .check.in").hide();
	$(".noche_mex .check.out").fadeIn();
}
function mostrarCheckOutY2B(){
	$(".y2b .check.in").hide();
	$(".y2b .check.out").fadeIn();
}
// esconder
function esconderEventos(){
	$(".gala").hide();
	$(".noche_mex").hide();
	$(".y2b").hide();
}
function esconderHotel(){
	$(".hotel").hide();
}
function esconderCheckInGala(){
	$(".gala .check.in").hide();
}
function esconderCheckOutGala(){
	$(".gala .check.out").hide();
}
function esconderCheckInNocheMex(){
	$(".noche_mex .check.in").hide();
}
function esconderCheckOutNocheMex(){
	$(".noche_mex .check.out").hide();
}
function esconderCheckOutY2B(){
	$(".y2b .check.out").hide();
}
function esconderCheckInY2B(){
	$(".y2b .check.in").hide();
}
