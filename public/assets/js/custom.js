(function ($) {

	"use strict";

	// Page loading animation
	$(window).on('load', function() {

        $('#js-preloader').addClass('loaded');

    });


	$(window).scroll(function() {
	  var scroll = $(window).scrollTop();
	  var box = $('.header-text').height();
	  var header = $('header').height();

	  if (scroll >= box - header) {
	    $("header").addClass("background-header");
	  } else {
	    $("header").removeClass("background-header");
	  }
	})

	$('.owl-banner').owlCarousel({
	  center: true,
      items:1,
      loop:true,
      nav: true,
	  dots:true,
	  navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
      margin:30,
      responsive:{
        992:{
            items:1
        },
		1200:{
			items:1
		}
      }
	});

	var width = $(window).width();
		$(window).resize(function() {
		if (width > 767 && $(window).width() < 767) {
			location.reload();
		}
		else if (width < 767 && $(window).width() > 767) {
			location.reload();
		}
	})

	const elem = document.querySelector('.properties-box');
	const filtersElem = document.querySelector('.properties-filter');
	if (elem) {
		const rdn_events_list = new Isotope(elem, {
			itemSelector: '.properties-items',
			layoutMode: 'masonry'
		});
		if (filtersElem) {
			filtersElem.addEventListener('click', function(event) {
				if (!matchesSelector(event.target, 'a')) {
					return;
				}
				const filterValue = event.target.getAttribute('data-filter');
				rdn_events_list.arrange({
					filter: filterValue
				});
				filtersElem.querySelector('.is_active').classList.remove('is_active');
				event.target.classList.add('is_active');
				event.preventDefault();
			});
		}
	}


	// Menu Dropdown Toggle
	if($('.menu-trigger').length){
		$(".menu-trigger").on('click', function() {
			$(this).toggleClass('active');
			$('.header-area .nav').slideToggle(200);
		});
	}


	// Menu elevator animation
	$('.scroll-to-section a[href*=\\#]:not([href=\\#])').on('click', function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				var width = $(window).width();
				if(width < 991) {
					$('.menu-trigger').removeClass('active');
					$('.header-area .nav').slideUp(200);
				}
				$('html,body').animate({
					scrollTop: (target.offset().top) - 80
				}, 700);
				return false;
			}
		}
	});


	// Page loading animation
	$(window).on('load', function() {
		if($('.cover').length){
			$('.cover').parallax({
				imageSrc: $('.cover').data('image'),
				zIndex: '1'
			});
		}

		$("#preloader").animate({
			'opacity': '0'
		}, 600, function(){
			setTimeout(function(){
				$("#preloader").css("visibility", "hidden").fadeOut();
			}, 300);
		});
	});


    // //Pagination
    // $(document).on('click','.pagination a', function (e){
    //     e.preventDefault();
    //     let page = $(this).attr('href').split('page=')[1]
    //     prop(page)
    // })
    //
    // function prop(page){
    //     $.ajax({
    //         url:'/pagination?page=' + page,
    //         success:function (re){
    //             $('properties-box').html(re)
    //         }
    //     })
    // }

    //filter
    $(document).ready(function (){
        $('#filterForm li a').on('click', function (e){
            e.preventDefault()

            //console.log($('#filterForm li a'))
            $('#filterForm li a').removeClass('is_active')
            $(this).addClass('is_active')

            var data = $(this).data('id')
            // console.log(data)

            $.ajax({
                url:window.location.origin + '/property/filter/' + data ,
                method:'post',
                dataType:'json',
                success:function (prop){
                    let divZaIspis = document.querySelector('.properties-box')
                    for (let  p of prop) {
                        divZaIspis += `
                        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 adv ajax">
                        <div class="item">
                        <a href="#"><img src="assets/images/${p.image}" alt=""></a>

                        <span class="category">${p.type.type}</span>

                        <h6>$ ${p.price}</h6>
                        <h4><a href="#">${p.city.address_number} ${p.city.address}</a></h4>
                        <h4><a href="#">${p.city.state.state}</a></h4>
                        <ul>
                            <li>Bedrooms: <span>${p.number_of_bedrooms}</span></li>
                            <li>Bathrooms: <span>${p.number_of_bathrooms}</span></li>
                            <li>Total space: <span>${p.total_space} SqFt</span></li>
                            <li>Floors: <span>${p.number_of_floors}</span></li>
                        </ul>
                        <div class="main-button">

                            <a href="{{route('property.show', ['id'=>$p.id])}">Property Details</a>


                            @if( auth().check() && auth().user().role_id == 2)
                            <form action="{{route('property.delete', $p.id)}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="link-danger">Delete Property</button>
                            </form>

                            @endif
                            @if( auth().check() && auth().user().role_id == 2)
                            <a href="{{route('property.edit', $p.id)}" class="link-success">Edit Property </a>
                            @endif
                        </div>
                </div>
                </div>`;
                        divZaIspis.innerHTML += divZaIspis;
                        console.log(divZaIspis)
                    }
                //@foreach($prop as $p)
                // <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 adv ajax">
                //         <div class="item">
                //         <a href="#"><img src="{{asset('assets/images/' . $p.image)}" alt=""></a>
                //
                //     <span class="category">${p.type.type}</span>
                //
                //     <h6>$${p.price}</h6>
                //     <h4><a href="#">${p.city.address_number} {{ $p.city.address}</a></h4>
                //     <h4><a href="#">${p.city.state.state}</a></h4>
                //     <ul>
                //         <li>Bedrooms: <span>${p.number_of_bedrooms}</span></li>
                //         <li>Bathrooms: <span>${p.number_of_bathrooms}</span></li>
                //         <li>Total space: <span>${p.total_space} SqFt</span></li>
                //         <li>Floors: <span>${p.number_of_floors}</span></li>
                //     </ul>
                //     <div class="main-button">
                //         @if(auth().check())
                //         <a href="{{route('property.show', ['id'=>$p.id])}">Property RealEstateDetail</a>
                //         @endif
                //
                //         @if( auth().check() && auth().user().role_id == 2)
                //         <form action="{{route('property.delete', $p.id)}" method="POST">
                //             @csrf
                //             @method('delete')
                //             <button type="submit" class="link-danger">Delete Property</button>
                //         </form>
                //
                //         @endif
                //         @if( auth().check() && auth().user().role_id == 2)
                //         <a href="{{route('property.edit', $p.id)}" class="link-success">Edit Property </a>
                //         @endif
                //     </div>
                // </div>
                // </div>
                // @endforeach
                },
                error:function (xhr){
                    console.log(xhr)
                }
            })
        })
    })



})(window.jQuery);



