$(document).ready(function() {
    RevosliderInit.initRevoSlider();

	$("#testimonials-carousel").owlCarousel({
		singleItem:true,
		autoPlay : true,
    	stopOnHover : true,
    	navigation : true,
    	pagination : false,
    	autoHeight: true
	});

	$(".blog-list-carousel, .post-carousel").owlCarousel({
		singleItem:true,
		autoPlay : true,
    	stopOnHover : true,
    	navigation : true,
    	pagination : false,
    	autoHeight: false
	});

	// Count To
	$(".counters .counter-int [data-to]").each(function() {
		var $this = $(this);
		$this.appear(function() {
			$this.countTo({	});
		}, {accX: 0, accY: -150});
	});
	
	$(".counters .counter-demical-1 [data-to]").each(function() {
		var $this = $(this);
		$this.appear(function() {
			$this.countTo({
				decimals: 1,
			});
		}, {accX: 0, accY: -150});
	});
	
	$(".counters .counter-demical-2 [data-to]").each(function() {
		var $this = $(this);
		$this.appear(function() {
			$this.countTo({
				decimals: 2,
			});
		}, {accX: 0, accY: -150});
	});

	// Datapicker
	$('.datetimepicker').datetimepicker();

	//tooltips
	$('.custom-tooltip').tooltip({
		'selector': '',
		'container':'body'
	});

	//Checkbox
	$("input[type=checkbox], input[type=radio]").uniform();


	//Table Sorting
	$(".tablesorter").tablesorter({
     	theme : 'default',
     	sortInitialOrder: "desc"
    });


    //Messages Scrolling
    $('#messages-list').slimScroll({
        height: '415px'
    });


    //Succes Upload Modal
	$('#modalUploadSuccess').on('shown.bs.modal', function (e) {
		$('#modalUploadFile').modal('hide');
	  	
	  	setTimeout(function () {
			$('#modalUploadSuccess').modal('hide');
		}, 1500);

	});


    //Succes Upload Modal
	$('#modalDeleteSuccess').on('shown.bs.modal', function (e) {
		$('#modalDelete').modal('hide');
	  	
	  	setTimeout(function () {
			$('#modalDeleteSuccess').modal('hide');
		}, 1500);
	});

	//Price Select
	function changePrice(){
		$('.tariff-period-select').each(function(){
			var select = $(this);
			var priceBlock = select.parents('.col-tariff:first').find('.tafiff-price');
			var selectPrice = select.find('option:selected').data('price').toString().split('.');
			$('.text-large', priceBlock).text(selectPrice[0]);
			$('.text-small', priceBlock).text('.'+selectPrice[1]);
		});
	};

	$('.tariff-period-select').change(changePrice);
	changePrice();


	// Menu Main
	$(".mobi-toggler").on("click", function(event) {
        event.preventDefault();//the default action of the event will not be triggered
        
        $("#header").toggleClass("menuOpened");
        $("#header").find("#main-navigation").toggle(300);
    });

    $("#header .navbar-toggle").click(function () {
        if ($("#header .navbar-collapse").hasClass("open")) {
            $("#header .navbar-collapse").slideDown(300)
            .removeClass("open");
        } else {             
            $("#header .navbar-collapse").slideDown(300)
            .addClass("open");
        }
    });


	// Menu Categories
	function catMenuToggle(){
	    $(".mobi-toggler-cat").on("click", function(event) {
	        event.preventDefault();//the default action of the event will not be triggered
	        
	        $("#cat-list").toggleClass("menuOpened");
	        $("#cat-list").find(".cat-list-menu").toggle(300);
	    });

	    $("#cat-list .navbar-toggle").click(function () {
	        if ($("#cat-list .navbar-collapse").hasClass("open")) {
	            $("#cat-list .navbar-collapse").slideDown(300)
	            .removeClass("open");
	        } else {             
	            $("#cat-list .navbar-collapse").slideDown(300)
	            .addClass("open");
	        }

	    });
	};

	catMenuToggle();


	//Categories menu moving	
	function catRemove(){
		var winWidth = $('.container:first').width();

		if(winWidth < 768){
			if($('#layout-middle #cat-list-wrapper').length == 0){

				if($('#layout-left #cat-list-wrapper').length){
					var catCode = $('#layout-left #cat-list-wrapper').html();
					$('#layout-middle h3.page-title:first').after('<div id="cat-list-wrapper">'+ catCode + '</div>');
					$('#layout-left  #cat-list-wrapper').remove();
					$('#layout-left .cat-list-menu').css('display', 'none');
					catMenuToggle();
				}
				else{
				}

			};
		}
		else if(winWidth > 768){
			if($('#layout-left #cat-list-wrapper').length == 0){
				if($('#layout-middle #cat-list-wrapper').length){
					var catCode = $('#layout-middle #cat-list-wrapper').html();
					$('#layout-left .sibebar-section:first').before('<div id="cat-list-wrapper">'+ catCode + '</div>');
					$('#layout-middle #cat-list-wrapper').remove();
					$('#layout-left .cat-list-menu').css('display', 'block');
				}
				else{
				}			

			}
		}

		/*if(winWidth < 768){
			if($('#layout-left #cat-list-wrapper').length){
					//var catCode = $('#layout-left #cat-list-wrapper').html();

					if($('#layout-middle #cat-list-wrapper').length){

					}
					else{
						$('#layout-middle h3.page-title:first').after(catCode);
						$('#layout-left  #cat-list-wrapper').remove();
						catMenuToggle();					
					}

		};*/
		/*
		else(winWidth > 768){
				if($('#layout-middle #cat-list-wrapper').length){
				}				}
				else{
					if($('#layout-left #cat-list-wrapper').length){

					}
					else{
						var catCode = $('#layout-middle #cat-list-wrapper').html();
						$('#layout-left .sibebar-section:first').before(catCode);
						$('#layout-middle #cat-list-wrapper').remove();
					}

				}
				
		}*/
		
	};

	catRemove();

	$(window).resize(function() {
		catRemove();
	});


});



/*
 * Revolution Slider options
 *-----------------------------------*/
 