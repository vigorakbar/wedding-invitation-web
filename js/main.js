document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

$("#attendance-input").change(function(){
	if (this.value == "no") {
		$(".form-container input:checkbox").attr('checked',false).attr('disabled',true);
		$("#placeError").hide();
	} else {
		$(".form-container input:checkbox").attr('disabled',false);
	}
});

$("#submit-rsvp").click(function(){
	var valid = validateRSVP();
	if (valid) {
		$("#nameError").hide();
		$("#placeError").hide();
		var name = $("#name-input").val();
		var attendance = $("#attendance-input").val();
		var tangerang = 0;
		var malang = 0;
		if (attendance != "no") {
			if ($("#tangerang").is(":checked")) {
				tangerang = 1;
			}
			if ($("#malang").is(":checked")) {
				malang = 1;
			}
		}
		$.ajax({
			type: "POST",
			url: "model/model.php",
			data: {'name' : name, 'attendance' : attendance, 'tangerang' : tangerang, 'malang' : malang},
			success: function(data) {
			   alert(data);
			},
			 error: function(){
                alert("error in ajax form submission");
            }
		});
	} else {
		if ($("#name-input").val() == '') {
			$("#nameError").css('display', 'block');
		} else {
			$("#nameError").hide();
		}
		if ($("#attendance-input").val() != "no" && !($("#tangerang").is(":checked") || $("#malang").is(":checked"))) {
			$("#placeError").show();
		} else {
			$("#placeError").hide();
		}
	}
});

$("#submit-prayer").click(function(){
	var valid = validatePrayer();	
	if(valid) {
		$("#nameError2").hide();
		$("#prayError").hide();
		var name = $("#name-input2").val();
		var prayer = $("#prayer-input").val();
		$.ajax({
			type: "POST",
			url: "model/model.php",
			data: {'prayerName' : name, 'prayer' : prayer},
			success: function(data) {
			   alert(data);
			},
			 error: function(){
                alert("error in ajax form submission");
            }
		});
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
});

// function submitPrayer() {
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
// 	return valid;
// }

function validateRSVP() {
	return !($("#name-input").val() == '' || (($("#attendance-input").val() != 'no') && !($("#tangerang").is(":checked") || $("#malang").is(":checked"))));
}

function validatePrayer() {
	return !($("#name-input2").val() == '' || $("#prayer-input").val() == '');
}