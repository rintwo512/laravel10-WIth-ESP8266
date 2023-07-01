

$(function() {
	"use strict";

  // Tooltops

    $(function () {
        $('[data-bs-toggle="tooltip"]').tooltip();
    })


	$(function() {
		for (var e = window.location, o = $(".sidebar-wrapper .tab-content a").filter(function() {
				return this.href == e
			}).addClass("active");

			o.is("a");)

			o = o.parent("").parent("").addClass("active show");
			console.log(o[0].id.toString())
			var tab = "#" + o[0].id.toString()
			$("[data-bs-target='" + tab + "']").addClass('active')

		});



    // $(".nav-toggle-icon").on("click", function() {
	// 	$(".wrapper").toggleClass("toggled")
	// })

    $(".mobile-toggle-icon").on("click", function() {
		$(".wrapper").addClass("toggled")
	})


	$(".search-toggle-icon").on("click", function() {
		$(".top-header .navbar form").addClass("full-searchbar")
	})
	$(".search-close-icon").on("click", function() {
		$(".top-header .navbar form").removeClass("full-searchbar")
	})


	$(".chat-toggle-btn").on("click", function() {
		$(".chat-wrapper").toggleClass("chat-toggled")
	}), $(".chat-toggle-btn-mobile").on("click", function() {
		$(".chat-wrapper").removeClass("chat-toggled")
	}), $(".email-toggle-btn").on("click", function() {
		$(".email-wrapper").toggleClass("email-toggled")
	}), $(".email-toggle-btn-mobile").on("click", function() {
		$(".email-wrapper").removeClass("email-toggled")
	}), $(".compose-mail-btn").on("click", function() {
		$(".compose-mail-popup").show()
	}), $(".compose-mail-close").on("click", function() {
		$(".compose-mail-popup").hide()
	})


	$(document).ready(function() {
		$(window).on("scroll", function() {
			$(this).scrollTop() > 300 ? $(".back-to-top").fadeIn() : $(".back-to-top").fadeOut()
		}), $(".back-to-top").on("click", function() {
			return $("html, body").animate({
				scrollTop: 0
			}, 600), !1
		})
	})


	// switcher

	// $("#LightTheme").on("click", function() {
	// 	$("html").attr("class", "light-theme")
	// }),

	// $("#DarkTheme").on("click", function() {
	// 	$("html").attr("class", "dark-theme")
	// }),

	// $("#SemiDarkTheme").on("click", function() {
	// 	$("html").attr("class", "semi-dark")
	// }),

	// $("#DefaultTheme").on("click", function() {
	// 	$("html").attr("class", "default-theme")
	// })


	new PerfectScrollbar(".iconmenu")
    new PerfectScrollbar(".textmenu")


	new PerfectScrollbar(".header-message-list")
    new PerfectScrollbar(".header-notifications-list")






});

// if(localStorage.getItem('theme') == 'dark-theme'){
// 	setDark(true)
// }
// function setDark(isDark) {
// 	if(isDark){

// 		$("html").attr("class", "dark-theme");
// 		document.getElementById('DarkTheme').checked = true;
// 		localStorage.setItem('theme', 'dark-theme');
// 	}else{
// 		$("html").attr("class", "light-theme");
// 		// document.getElementById('LightTheme').checked = true;
// 		localStorage.setItem('theme', 'light-theme');
// 	}

// };
