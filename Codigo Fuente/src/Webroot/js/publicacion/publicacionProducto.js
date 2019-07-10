const cantMaxCharsReview = 200;
const pageSize = 4;

var pageNumber = 1;

var map = $('#map');
var carouselProductosRelacionados = $("#carouselProductosRelacionados");
var googleMap;
var rateYo = $('#rateYo');
var reviewMessage = $('#review_message');
var spanReviewCharCounter = $('#spanReviewCharCounter');
var btnSubmitReview = $('#btnSubmitReview');
var divAddReview = $('#divAddReview');
var divReviewsContainer = $('#divReviewsContainer');
var divShowMoreReviews = $('#divShowMoreReviews');
var cursorPointerShowMoreReviews = $('#cursorPointerShowMoreReviews');
var divNivelVendedorRateYo = $('#divNivelVendedorRateYo');

var btnPregunta = $("#btnPregunta");
var pregunta = $("#pregunta");
var producId = $("#productoId");
var divComentarios = $("#divComentarios");
var inicio = 4;

/* JS Document */

/******************************

[Table of Contents]

1. Vars and Inits
2. Set Header
3. Init Menu
4. Init Thumbnail
5. Init Quantity
6. Init Star Rating
7. Init Favorite
8. Init Tabs



******************************/

jQuery(document).ready(function($)
{
	"use strict";

	/* 

	1. Vars and Inits

	*/

	var header = $('.header');
	var topNav = $('.top_nav')
	var hamburger = $('.hamburger_container');
	var menu = $('.hamburger_menu');
	var menuActive = false;
	var hamburgerClose = $('.hamburger_close');
	var fsOverlay = $('.fs_menu_overlay');

	setHeader();

	$(window).on('resize', function()
	{
		setHeader();
	});

	$(document).on('scroll', function()
	{
		setHeader();
	});

	initMenu();
	initThumbnail();
	initQuantity();
	initStarRating();
	initFavorite();
	initTabs();

	/* 

	2. Set Header

	*/

	function setHeader()
	{
		if(window.innerWidth < 992)
		{
			if($(window).scrollTop() > 100)
			{
				header.css({'top':"0"});
			}
			else
			{
				header.css({'top':"0"});
			}
		}
		else
		{
			if($(window).scrollTop() > 100)
			{
				header.css({'top':"-50px"});
			}
			else
			{
				header.css({'top':"0"});
			}
		}
		if(window.innerWidth > 991 && menuActive)
		{
			closeMenu();
		}
	}

	/* 

	3. Init Menu

	*/

	function initMenu()
	{
		if(hamburger.length)
		{
			hamburger.on('click', function()
			{
				if(!menuActive)
				{
					openMenu();
				}
			});
		}

		if(fsOverlay.length)
		{
			fsOverlay.on('click', function()
			{
				if(menuActive)
				{
					closeMenu();
				}
			});
		}

		if(hamburgerClose.length)
		{
			hamburgerClose.on('click', function()
			{
				if(menuActive)
				{
					closeMenu();
				}
			});
		}

		if($('.menu_item').length)
		{
			var items = document.getElementsByClassName('menu_item');
			var i;

			for(i = 0; i < items.length; i++)
			{
				if(items[i].classList.contains("has-children"))
				{
					items[i].onclick = function()
					{
						this.classList.toggle("active");
						var panel = this.children[1];
					    if(panel.style.maxHeight)
					    {
					    	panel.style.maxHeight = null;
					    }
					    else
					    {
					    	panel.style.maxHeight = panel.scrollHeight + "px";
					    }
					}
				}	
			}
		}
	}

	function openMenu()
	{
		menu.addClass('active');
		// menu.css('right', "0");
		fsOverlay.css('pointer-events', "auto");
		menuActive = true;
	}

	function closeMenu()
	{
		menu.removeClass('active');
		fsOverlay.css('pointer-events', "none");
		menuActive = false;
	}

	/* 

	4. Init Thumbnail

	*/

	function initThumbnail()
	{
		if($('.single_product_thumbnails ul li').length)
		{
			var thumbs = $('.single_product_thumbnails ul li');
			var singleImage = $('.single_product_image_background');

			thumbs.each(function()
			{
				var item = $(this);
				item.on('click', function()
				{
					thumbs.removeClass('active');
					item.addClass('active');
					var img = item.find('img').data('image');
					singleImage.css('background-image', 'url(' + img + ')');
				});
			});
		}	
	}

	/* 

	5. Init Quantity

	*/

	function initQuantity()
	{
		if($('.plus').length && $('.minus').length)
		{
			var plus = $('.plus');
			var minus = $('.minus');
			var value = $('#quantity_value');

			plus.on('click', function()
			{
				var x = parseInt(value.text());
				value.text(x + 1);
			});

			minus.on('click', function()
			{
				var x = parseInt(value.text());
				if(x > 1)
				{
					value.text(x - 1);
				}
			});
		}
	}

	/* 

	6. Init Star Rating

	*/

	function initStarRating()
	{
		if($('.user_star_rating li').length)
		{
			var stars = $('.user_star_rating li');

			stars.each(function()
			{
				var star = $(this);

				star.on('click', function()
				{
					var i = star.index();

					stars.find('i').each(function()
					{
						$(this).removeClass('fa-star');
						$(this).addClass('fa-star-o');
					});
					for(var x = 0; x <= i; x++)
					{
						$(stars[x]).find('i').removeClass('fa-star-o');
						$(stars[x]).find('i').addClass('fa-star');
					};
				});
			});
		}
	}

	/* 

	7. Init Favorite

	*/

	function initFavorite()
	{
		if($('.product_favorite').length)
		{
			var fav = $('.product_favorite');

			fav.on('click', function()
			{
				fav.toggleClass('active');
			});
		}
	}

	/* 

	8. Init Tabs

	*/

	function initTabs()
	{
		if($('.tabs').length)
		{
			var tabs = $('.tabs li');
			var tabContainers = $('.tab_container');

			tabs.each(function()
			{
				var tab = $(this);
				var tab_id = tab.data('active-tab');

				tab.on('click', function()
				{
					if(!tab.hasClass('active'))
					{
						tabs.removeClass('active');
						tabContainers.removeClass('active');
						tab.addClass('active');
						$('#' + tab_id).addClass('active');
					}
				});
			});
		}
	}
});

function initMap() {
	googleMap = new google.maps.Map(document.getElementById('map'), {
		center: {lat: window.latitud, lng: window.longitud},
		zoom: 16
	});

	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(window.latitud, window.longitud),
		map: googleMap
	});
}

/*Funciones de carga de reviews*/

function dibujarReview(review, esNueva) {
	if(esNueva && window.cantidadReviews <= 0) {
		divReviewsContainer.empty();
	}

	var divReview = $('<div class="review mt-4 w-100 pl-0 border-bottom">');

	var divReviewDate = $('<div class="review_date">');
	divReviewDate.append(moment(review.fechaAlta, 'YYYY-MM-DD').format('DD/MM/YYYY'));

	var divUserName = $('<div class="user_name mb-1">');
	divUserName.append(review.nombreCompletoUsuario);

	var divUserRating = $('<div class="user_rating mt-0 mb-3">');

	var divFlexStars = $('<div class="d-flex" style="color: #0099df;">');

	for (let i = 1; i <= 5; i++) {
		if(review.calificacion  - i < 0) {
			var iFarFaStar = $('<i class="far fa-star" aria-hidden="true">');
			divFlexStars.append(iFarFaStar);
		} else {
			var iFasFaStar = $('<i class="fas fa-star" aria-hidden="true">');
			divFlexStars.append(iFasFaStar);
		}
	}

	divUserRating.append(divFlexStars);

	var pDetalleReview = $('<p class="text-justify">');
	pDetalleReview.text(review.detalleReview);

	divReview.append(divReviewDate);
	divReview.append(divUserName);
	divReview.append(divUserRating);
	divReview.append(pDetalleReview);

	if(esNueva) {
		divReviewsContainer.prepend(divReview);
	} else {
		divReviewsContainer.append(divReview);
	}
}

function cargarReviews() {
	var obj = {};
	obj.productoId = window.productoId;
	obj.pageSize = pageSize;
	obj.pageNumber = pageNumber;
	llamadaAjax(pathGetReviews, JSON.stringify(obj), true, 'cargaReviewsExitosa', 'cargaReviewsFallida');
}

function cargaReviewsExitosa(reviews) {
	pageNumber++;

	if(window.cantidadReviews - pageNumber * pageSize < 0) {
		divShowMoreReviews.remove();
	}

	$.each(reviews, function (i, review) {
		dibujarReview(review, false);
	});
}

function cargaReviewsFallida(err) {
	alertify.alert('Error al cargar reviews', err);
}

cursorPointerShowMoreReviews.click(function () {
	cargarReviews();
});

function inicializarReviews() {
	if(window.cantidadReviews <= 0) {
		var h6 = $('<h6 class="text-black-50 text-center mx-auto">');
		h6.text('Todavía no hay ninguna reseña en esta publicación');

		divReviewsContainer.append(h6);
	} else {
		if(window.cantidadReviews > pageSize) {
			divShowMoreReviews.removeClass('d-none').addClass('d-flex');
		}
		cargarReviews();
	}
}

inicializarReviews();

/*Fin de funciones de carga de reviews*/

/*Implementación de estrellas en review*/

rateYo.rateYo({
	starWidth: '25px',
	normalFill: '#ebebeb',
	ratedFill: '#0099df',
	fullStar: true
});

/*Fin de implementación de estrellas en review*/

/*Contador de caracteres en textarea de review*/

reviewMessage.keyup(function () {
	var txt = $(this).val();
	var txtLength = txt.length;

	if(txtLength <= cantMaxCharsReview) {
		spanReviewCharCounter.text(txtLength);
	} else {
		$(this).val(txt.substring(0, cantMaxCharsReview));
		spanReviewCharCounter.text(cantMaxCharsReview);
	}
});

/*Fin de contador de caracteres en textarea de review*/

/*Submit de Review*/

function validarTextReview() {
	var textReview = reviewMessage.val();
	var validacion = false;

	if (textReview === null || textReview.length === 0 || textReview === "") {
		$('#errorReview').fadeIn('slow').find('span').text('Ingrese una reseña');
	} else {
		validacion = true;
	}

	return validacion;
}

btnSubmitReview.click(function () {
	$('.error').fadeOut().find('span').empty();
	if(validarTextReview()) {
		$(this).prop('disabled', true);
		reviewMessage.prop('disabled', true);
		rateYo.rateYo('option', 'readOnly', true);
		var obj = {};
		obj.calificacion = rateYo.rateYo('rating');
		obj.detalle = reviewMessage.val();
		obj.productoId = window.productoId;
		llamadaAjax(pathGuardarReview, JSON.stringify(obj), true, 'agregarReviewALista', 'guardarReviewFallido');
	}
});

function agregarReviewALista(review) {
	divAddReview.remove();
	dibujarReview(review, true);
}

function guardarReviewFallido(err) {
	$(this).prop('disabled', false);
	reviewMessage.prop('disabled', false);
	rateYo.rateYo('option', 'readOnly', false);
	alertify.alert('Fallo al guardar la reseña', err);
}

/*Fin de Submit de Review*/

function cargarPreguntaExitosa(pregunta)
{
	$("#pregunta").val('');

	var divContenedor = $("<div class='user_review_container d-flex flex-column flex-sm-row'></div>");

	var divUser = $("<div class='user'><div class='user_pic'></div></div>");

	var divPregunta = $("<div class='review pl-3'></div>");

	var divFechaPregunta = $("<div class='review_date'></div>");
	divFechaPregunta.append(pregunta.fechaPregunta);

	var divUsername = $("<div class='user_name mb-1'></div>");
	divUsername.append(pregunta.usuarioUsername);

	var pPregunta = $("<p class='text-justify'></p>");
	pPregunta.text(pregunta.pregunta);

	divPregunta.append(divFechaPregunta);
	divPregunta.append(divUsername);
	divPregunta.append(pPregunta);

	divContenedor.append(divUser);
	divContenedor.append(divPregunta);

	divComentarios.prepend(divContenedor);
}

function cargarRespuestaExitosa(respuesta)
{
	$("#res" + respuesta.id).remove();

	var divRespuesta = $("#respondido" + respuesta.id);

	var divFechaRespuesta = $("<div class='review_date'></div>");
	divFechaRespuesta.append(respuesta.fechaRespuesta);

	var pRespuesta = $("<p class='text-justify user_name'></p>");
	pRespuesta.text(respuesta.respuesta);

	divRespuesta.append(divFechaRespuesta);
	divRespuesta.append(pRespuesta);
}

function preguntar() {
	var obj = {};
	obj.pregunta = pregunta.val();
	obj.productoId = producId.val();
	llamadaAjax(pathPreguntar, JSON.stringify(obj), true, "cargarPreguntaExitosa", "dummy");
}

function responder(idPregunta) {
	var obj = {};
	obj.respuesta = $("#respuesta" + idPregunta).val();
	obj.id = idPregunta;
	llamadaAjax(pathResponder, JSON.stringify(obj), true, "cargarRespuestaExitosa", "dummy");
}

btnPregunta.click(function () {
    preguntar();
});

function cargarMasComentarios(comentarios)
{
	var divMasComentarios = $("#masComentarios");
	$.each(comentarios, function(index, comentario){
		var divContenedor = $("<div class='user_review_container d-flex flex-column flex-sm-row'></div>");

		var divUser = $("<div class='user'><div class='user_pic'></div></div>");

		var divPregunta = $("<div class='review pl-3'></div>");

		var divFechaPregunta = $("<div class='review_date'></div>");
		divFechaPregunta.append(comentario.fechaPregunta);

		var divUsername = $("<div class='user_name mb-1'></div>");
		divUsername.append(comentario.usuarioUsername);

		var pPregunta = $("<p class='text-justify'></p>");
		pPregunta.text(comentario.pregunta);

		divPregunta.append(divFechaPregunta);
		divPregunta.append(divUsername);
		divPregunta.append(pPregunta);

		divContenedor.append(divUser);
		divContenedor.append(divPregunta);

		divMasComentarios.append(divContenedor);

		var divRes = $("<div id='" + comentario.id + "'></div>");

		divMasComentarios.append(divRes);
		
		if(idSesion != 0 && idSesion == usuarioId && !comentario.respuesta)
		{
			var divContenedorResponder = $("<div class='form-group' id='res" + comentario.id + "'>");

			var divTextarea = $("<div><textarea id='respuesta" + comentario.id + "' class='form-control input_review' placeholder='Escriba su respuesta...' rows='4'></textarea></div>");

			divContenedorResponder.append(divTextarea);

			var divBoton = $("<div class='text-left text-sm-right'></div>");
			var boton = $("<button onclick='responder(" + comentario.id + ")' type='button' class='mt-3 float-right btn btn-primary'>Responder</button>");

			divBoton.append(boton);

			divContenedorResponder.append(divBoton);

			divMasComentarios.append(divContenedorResponder);
		}
		else
		if(comentario.respuesta)
		{
			var divFechaRespuesta = $("<div class='review_date'></div>");
			divFechaRespuesta.append(comentario.fechaRespuesta);

			var pRespuesta = $("<p class='text-justify user_name'></p>");
			pRespuesta.text(comentario.respuesta);

			divMasComentarios.append(divFechaRespuesta);
			divMasComentarios.append(pRespuesta);
		}

		inicio++;
	});

	if((inicio % 4) != 0 || (totalComentarios - inicio) == 0)
		$("#divMostrarMas").remove();
}

function mostrarMas(idProducto)
{
	var obj = {};
	obj.inicio = inicio;
	obj.idProducto = idProducto;
	llamadaAjax(pathMostrarMas, JSON.stringify(obj), true, "cargarMasComentarios", "dummy");
}

pregunta.keyup(function () {
	var txt = $(this).val();
	var txtLength = txt.length;

	if(txtLength <= cantMaxCharsReview) {
		spanReviewCharCounter.text(txtLength);
	} else {
		$(this).val(txt.substring(0, cantMaxCharsReview));
		spanReviewCharCounter.text(cantMaxCharsReview);
	}
});

/*Implementación de nivel de vendedor con estrellas*/

divNivelVendedorRateYo.rateYo({
	starWidth: '20px',
	normalFill: '#ebebeb',
	ratedFill: '#0099df',
	readOnly: true
});

function inicializarNivelVendedor() {
	if(window.nivelVendedor >= 0) {
		divNivelVendedorRateYo.rateYo('option', 'rating', parseFloat(window.nivelVendedor).toFixed(2));
	}
}

inicializarNivelVendedor();

/*Fin de implementación de nivel de vendedor con estrellas*/
