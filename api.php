<?php

header('content-type: application/json');

$request= $_SERVER['REQUEST_METHOD'];

	switch ($request) {
		case 'GET':
				getData();
			break;
		case 'POST':
			$data= json_decode(file_get_contents('php://input'),true);
			postData($data);
			break;
		case 'PUT':
			echo '{"name":"PUT.....Rabid"}';
			break;
		case 'DELETE':
			echo '{"name":"DELETE.....Rabid"}';
			break;
		
		default:
			echo '{"Result":"No Data Found!"}';
			break;
	}

function getData() {
	include 'db.php';
	$sql= "SELECT * FROM user";
	$result= mysqli_query($conn,$sql);	

	if(mysqli_num_rows($result) > 0) {
		$rows= array();
		while($r_data= mysqli_fetch_assoc($result)) {
			$rows['result'][]= $r_data;
		}
		echo json_encode($rows);
	}

	else {
		echo '{"Result":"No Data Found!"}';
	}

}

function postData($data) {
	include 'db.php';
	$name= $data['name'];
	$email= $data['email'];
	$sql= "INSERT INTO `user`(`id`, `name`, `email`, `created_at`) VALUES (NULL,'$name','$email',NOW())";

	if (mysqli_query($conn,$sql)) {
		echo '{"Result":"Data inserted Successfully!"}';
	}
	else {
		echo '{"Result":"Data insertion Failled!"}';
	}

}



?>