<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vr_wedding";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["name"])) {
    $ip = $_SERVER["REMOTE_ADDR"];
    $name = $_POST["name"];
    $attendance = $_POST["attendance"];

    if(isset($_POST["tangerang"])) {
        $tangerang = 1;
    } else {
        $tangerang = 0;
    }

    if(isset($_POST["malang"])) {
        $malang = 1;
    } else {
        $malang = 0;
    }
    
    $query = "INSERT INTO rsvp(ip, name, attendance, tangerang, malang) VALUES ('$ip', '$name', '$attendance', $tangerang, $malang) ON DUPLICATE KEY UPDATE attendance = values(attendance), tangerang = values(tangerang), malang = values(malang)";

    if ($conn->query($query) === FALSE) {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

if (isset($_POST["prayerName"])) {
    $ip = $_SERVER["REMOTE_ADDR"];
    $name = $_POST["prayerName"];
    $prayer = $_POST["prayer"];

    $query = "INSERT INTO prayer(ip, name, prayer) VALUES ('$ip', '$name', '$prayer') ON DUPLICATE KEY UPDATE prayer = values(prayer)";
    if ($conn->query($query) === FALSE) {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans|Raleway|Pacifico" rel="stylesheet">

    <title>Robby & Via Wedding Invitation</title>
    <meta charset="utf-8" name="description" content="Bismillahirrahmanirrahim, Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan. Ya Allah, perkenankanlah kami untuk menikahkan putra-putri kami, Via Apriyani, S.Si. dan Robby Izaty Ramadhan, S.T. yang akan diselenggarakan pada Minggu, 1 Juli 2018.">

  </head>
  <body>
    <div class="segment">
    	<div class="outer-content">
    		<div class="middle-content">
    			<div class="inner-content text-center">
    				<div class="name">
    					Via Apriani, S.Si.<br>
    					&<br>
    					Robby Izaty Ramadhan, S.T.
    				</div>
    			</div>
    		</div>
    	</div>
    	<div>
    		<a class="scroll-slow" href="#detail"><img class="arrow" src="img/arrow-down.png" title="Scroll Down"></a>
    	</div>
    </div>
    <div id="detail" class="segment">
    	<div class="outer-content">
    		<div class="middle-content">
    			<div class="inner-content text-center">
                    <div class="segment-title">Details</div>
                    <div class="segment-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="details-container">
                                        <div class="details-title">
                                            Tangerang (Akad + Resepsi)
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="details-container">
                                        <div class="details-title">
                                            Malang (Resepsi)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
    			</div>
    		</div>
            <div>
            <a class="scroll-slow" href="#rsvp"><img class="arrow" src="img/arrow-down.png" title="Scroll Down"></a>
            </div>
    	</div>
    	
    </div>
    <div id="rsvp" class="segment">
    	<div class="outer-content">
    		<div class="middle-content">
    			<div class="inner-content text-center">
    				<h1 class="segment-title">RSVP</h1>
                    <div class="segment-body">
                        <form class="form-container" action="index.php#rsvp" method="post" onsubmit="return submitRSVP()">
                            <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                            <div class="form-group row">
                                <label for="name-input" class="col-sm-2 col-form-label-lg">Name</label>
                                <div class="col-sm-10">
                                    <input id="name-input" name="name" class="form-control form-control-lg" type="text" placeholder="Full Name" aria-describedby="nameError">
                                    <small id="nameError" class="form-text">*Please fill out your name</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="attendance-input" class="col-sm-2 col-form-label-lg">Attendance</label>
                                <div class="col-sm-10">
                                    <select id="attendance-input" class="custom-select custom-select-lg mb-3" name="attendance">
                                        <option value="yes">Yes, I will come</option>
                                        <option value="maybe">Maybe, I'm not sure</option>
                                        <option value="no">No, I can't come</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="place-attendance">
                                <div class="h4">Place of attendance</div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input class="custom-control-input" type="checkbox" name="tangerang" id="tangerang" value="true">
                                    <label class="custom-control-label" for="tangerang">Tangerang</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input class="custom-control-input" type="checkbox" name="malang" id="malang" value="true">
                                    <label class="custom-control-label" for="malang">Malang</label>
                                </div>
                                <br>
                                <small id="placeError" class="form-text">*Please choose at lease one place</small>
                            </div>
                            <button id="submit-rsvp" class="btn btn-lg btn-primary" type="submit" style="margin-top: 20px">Submit</button>
                        </form>
                    </div>
    			</div>
    		</div>
    	</div>
    	<div>
    		<a class="scroll-slow" href="#prayer"><img class="arrow" src="img/arrow-down.png" title="Scroll Down"></a>
    	</div>
    </div>
    <div id="prayer" class="segment">
    	<div class="outer-content">
    		<div class="middle-content">
    			<div class="inner-content text-center">
                    <div class="segment-title">
                        <h1 aria-describeby="notes">Prayer</h1>
                        <small id="notes" class="form-text">This is optional, fill it if you want :)</small>
                    </div>
    				<div class="segment-body">
                        <form class="form-container" action="index.php#prayer" method="post" onsubmit="return submitPrayer()">
                            <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                            <div class="form-group row">
                                <label for="name-input2" class="col-sm-2 col-form-label-lg">Name</label>
                                <div class="col-sm-10">
                                    <input id="name-input2" class="form-control form-control-lg" type="text" placeholder="Full Name" aria-describedby="nameError" name="prayerName">
                                    <small id="nameError2" class="form-text">*Please fill out your name</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prayer-input" class="col-sm-2 col-form-label-lg">Prayer</label>
                                <div class="col-sm-10">
                                    <textarea id="prayer-input" class="form-control form-control" aria-describedby="nameError" rows="8" placeholder="Your Prayer" name="prayer"></textarea>
                                    <small id="prayError" class="form-text">*Please fill out the prayer</small>
                                </div>
                            </div>
                            <button id="submit-prayer" class="btn btn-lg btn-primary" type="submit" style="margin-top: 20px">Submit</button>
                        </form>            
                    </div>
    			</div>
    		</div>
    	</div>
        <div>
            <a class="scroll-slow" href="#thanks"><img class="arrow" src="img/arrow-down.png" title="Scroll Down"></a>
        </div>
    </div>
    <div id="thanks" class="segment">
        <div class="outer-content">
            <div class="middle-content">
                <div class="inner-content text-center">
                    <div class="segment-title thanks">
                        Thank You
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
  </body>
</html>