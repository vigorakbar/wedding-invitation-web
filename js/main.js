document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

$("#attendance-input").change(function(){
	if(this.value == "no") {
		$(".form-container input:checkbox").attr('checked',false).attr('disabled',true);
		$("#placeError").hide();
	} else {
		$(".form-container input:checkbox").attr('disabled',false);
	}
});

// $("#submit-rsvp").click(function(){
// 	var valid = validateRSVP();
// 	if(valid) {
// 		$("#nameError").hide();
// 		$("#placeError").hide();

// 	} else {
// 		if ($("#name-input").val() == '') {
// 			$("#nameError").css('display', 'block');
// 		} else {
// 			$("#nameError").hide();
// 		}
// 		if (!($("#tangerang").is(":checked") || $("#malang").is(":checked"))) {
// 			$("#placeError").show();
// 		} else {
// 			$("#placeError").hide();
// 		}
// 	}
// });

function submitRSVP() {
	var valid = validateRSVP();
	if(valid) {
		$("#nameError").hide();
		$("#placeError").hide();

	} else {
		if ($("#name-input").val() == '') {
			$("#nameError").css('display', 'block');
		} else {
			$("#nameError").hide();
		}
		if (!($("#tangerang").is(":checked") || $("#malang").is(":checked"))) {
			$("#placeError").show();
		} else {
			$("#placeError").hide();
		}
	}
	return valid;
}

// $("#submit-prayer").click(function(){
// 	var valid = validatePrayer();
// 	if(valid) {
// 		$("#nameError2").hide();
// 		$("#prayError").hide();

// 	} else {
// 		if ($("#name-input2").val() == '') {
// 			$("#nameError2").css('display', 'block');
// 		} else {
// 			$("#nameError2").hide();
// 		}
// 		if ($("#prayer-input").val() == '') {
// 			$("#prayError").css('display', 'block');
// 		} else {
// 			$("#prayError").hide();
// 		}
// 	}
// });

function submitPrayer() {
	var valid = validatePrayer();
	if(valid) {
		$("#nameError2").hide();
		$("#prayError").hide();

	} else {
		if ($("#name-input2").val() == '') {
			$("#nameError2").css('display', 'block');
		} else {
			$("#nameError2").hide();
		}
		if ($("#prayer-input").val() == '') {
			$("#prayError").css('display', 'block');
		} else {
			$("#prayError").hide();
		}
	}
	return valid;
}

function validateRSVP() {
	return !($("#name-input").val() == '' || !($("#tangerang").is(":checked") || $("#malang").is(":checked")));
}

function validatePrayer() {
	return !($("#name-input2").val() == '' || $("#prayer-input").val() == '');
}