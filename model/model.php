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

if(isset($_POST["name"])) {
	$ip = $_SERVER["REMOTE_ADDR"];
	$name = $_POST["name"];
	$attendance = $_POST["attendance"];
	$tangerang = $_POST["tangerang"];
	$malang = $_POST["malang"];
	$query = "INSERT INTO rsvp (ip, name, attendance, tangerang, malang) VALUES ('$ip', '$name', '$attendance', '$tangerang', '$malang') ON DUPLICATE KEY UPDATE attendance = VALUES(attendance), tangerang = VALUES(tangerang), malang = VALUES(malang)";

	$response = array();
	if ($conn->query($query) === FALSE) {
		$response['error'] = "Error: " . $query . "<br>" . $conn->error;
	    echo json_encode($response);
	} else {
		$response['success'] = "rsvp berhasil";
		echo json_encode($response);
	}
}

if(isset($_POST["prayerName"])) {
	$ip = $_SERVER["REMOTE_ADDR"];
	$name = $_POST["prayerName"];
	$prayer = $_POST["prayer"];
	$query = "INSERT INTO prayer (ip, name, prayer) VALUES ('$ip', '$name', '$prayer') ON DUPLICATE KEY UPDATE prayer = VALUES(prayer)";

	$response = array();
	if ($conn->query($query) === FALSE) {
		$response['error'] = "Error: " . $query . "<br>" . $conn->error;
	    echo json_encode($response);
	} else {
		$response['success'] = "prayer berhasil";
		echo json_encode($response);
	}
}

?>