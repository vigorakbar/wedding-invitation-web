$(function() {
  AOS.init({
     duration: 800,
     offset:200
  });
});

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
		alertify.confirm("Submit RSVP?", function () {
			// user clicked "ok"
			$.ajax({
				type: "POST",
				url: "model/model.php",
				data: {'name' : name, 'attendance' : attendance, 'tangerang' : tangerang, 'malang' : malang},
				 success: function(data) {
					 swal("It's Done!", "Thank you for your response", "success");
				},
				 error: function(){
	                 alertify.error("error in ajax form submission");
	            }
			});
		}, function() {
			// user clicked "cancel"
			alertify.log("submit cancelled");
		});
		
	} else {
		alertify.error("please fill all the fields");
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
	alertify.logPosition
	var valid = validatePrayer();	
	if(valid) {
		$("#nameError2").hide();
		$("#prayError").hide();
		var name = $("#name-input2").val();
		var prayer = $("#prayer-input").val();
		alertify.confirm("Submit Prayer?", function () {
			// user clicked "ok"
			$.ajax({
				type: "POST",
				url: "model/model.php",
				data: {'prayerName' : name, 'prayer' : prayer},
				success: function(data) {
				    swal("It's Done!", "Thank you for your response", "success");
				},
				 error: function(){
	                alertify.error("error in ajax form submission");
	            }
			});
		}, function() {
			//user click cancel
			alertify.log("submit cancelled");
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

function validateRSVP() {
	return !($("#name-input").val() == '' || (($("#attendance-input").val() != 'no') && !($("#tangerang").is(":checked") || $("#malang").is(":checked"))));
}

function validatePrayer() {
	return !($("#name-input2").val() == '' || $("#prayer-input").val() == '');
}