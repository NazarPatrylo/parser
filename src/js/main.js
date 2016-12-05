//FUNCTIONS
function changeSamples(){
	var macSample = $(".section-1-2 .mac-sample");
	var iphoneSample = $(".section-1-2 .iphone-sample");
	var ipadSample = $(".section-1-2 .ipad-sample");

	if(macSample.hasClass("mac-sample-1")){
		macSample.removeClass("mac-sample-1").addClass("mac-sample-2");
	} else if(macSample.hasClass("mac-sample-2")){
		macSample.removeClass("mac-sample-2").addClass("mac-sample-3");
	} else if(macSample.hasClass("mac-sample-3")){
		macSample.removeClass("mac-sample-3").addClass("mac-sample-1");
	};

	if(iphoneSample.hasClass("iphone-sample-1")){
		iphoneSample.removeClass("iphone-sample-1").addClass("iphone-sample-2");
	} else if(iphoneSample.hasClass("iphone-sample-2")){
		iphoneSample.removeClass("iphone-sample-2").addClass("iphone-sample-3");
	} else if(iphoneSample.hasClass("iphone-sample-3")){
		iphoneSample.removeClass("iphone-sample-3").addClass("iphone-sample-1");
	};

	if(ipadSample.hasClass("ipad-sample-1")){
		ipadSample.removeClass("ipad-sample-1").addClass("ipad-sample-2");
	} else if(ipadSample.hasClass("ipad-sample-2")){
		ipadSample.removeClass("ipad-sample-2").addClass("ipad-sample-3");
	} else if(ipadSample.hasClass("ipad-sample-3")){
		ipadSample.removeClass("ipad-sample-3").addClass("ipad-sample-1");
	};
};

function changeSamples2() {
	var iphoneSample2 = $(".section-1-4 .iphone2-sample");

	if(iphoneSample2.css("background-position") == "50% 0%"){
		iphoneSample2.css({"background-position": "50% 33%"});
	} else if (iphoneSample2.css("background-position") == "50% 33%"){
		iphoneSample2.css({"background-position": "50% 66%"});
	} else if (iphoneSample2.css("background-position") == "50% 66%"){
		iphoneSample2.css({"background-position": "50% 100%"});
	} else if (iphoneSample2.css("background-position") == "50% 100%"){
		iphoneSample2.css({"background-position": "50% 0%"});
	}
};

function toggleloginForm(){
	if($('.login-form').is(':visible')){
		$('.login-form').slideUp(200);
		$('.login-button').text("Войти");
		return false;
	} else{
		$('.login-form').slideDown(200);
		$('.login-button').text("X");
		return false;
	}
}

function closeloginForm(){
	if($('.login-form').is(':visible')){
		$('.login-form').slideUp(200);
		$('.login-button').text("Войти");
		return false;
	}
}

function openReg(){
	closeloginForm();
	$('#registrationForm').slideDown(200);
	$("body").addClass("body-disabled");
	return false;
}

function closeReg(){
	$('#registrationForm').slideUp(200);
	$("body").removeClass("body-disabled");
	return false;
}

function openNewPass(){
	closeloginForm();
	$('#newpassForm').slideDown(200);
	$("body").addClass("body-disabled");
	return false;
}

function closeNewPass(){
	$('#newpassForm').slideUp(200);
	$("body").removeClass("body-disabled");
	return false;
}

function langChanger(){
	var menuInterval;

	$('.langwich-changer-toogle').hover(function(){
		var langmenu = $('.langwich-changer');
		if($('.langwich-changer').is(':hidden')){
			langmenu.slideDown();
			clearInterval(menuInterval);
			menuInterval = setInterval(function () {
				langmenu.slideUp();
			}, 2000);
		}

		langmenu.mouseenter(function(){
			clearInterval(menuInterval);
		});

		langmenu.mouseleave(function(){
			$(this).slideUp();
		});
	});
}

$(window).load(function(){
	//CALL FUNCTIONS AFTER LOAD
	$(".loader").removeClass("loader-on");
	$("body").removeClass("body-disabled");

	new WOW({
            offset: "200"
	}).init();
});

$(function(){
	//CALL FUNCTIONS
	$(".loader").addClass("loader-on");
	$("body").addClass("body-disabled");

	langChanger();

	setInterval(changeSamples2, 2000);
	setInterval(changeSamples, 3000);

	$('.login-button').click(toggleloginForm);
	$(document).scroll(closeloginForm);

	$('#reg').click(openReg);
	$('#reg-close').click(closeReg);
	$('.reg-open').click(openReg);
	$('#new-pass').click(openNewPass);
	$('#newpass-close').click(closeNewPass);
});
