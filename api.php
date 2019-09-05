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
			$data= json_decode(file_get_contents('php://input'),true);
			putData($data);
			break;
		case 'DELETE':
			$data= json_decode(file_get_contents('php://input'),true);
			deleteData($data);
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
		echo '{"Result":"Data Inserted Successfully!"}';
	}
	else {
		echo '{"Result":"Data Insertion Failled!"}';
	}

}

function putData($data) {
	include 'db.php';
	$id= $data['id'];
	$name= $data['name'];
	$email= $data['email'];
	$sql= "UPDATE `user` SET `name`='$name',`email`='email',`created_at`=NOW() WHERE `id`= $id";

	if (mysqli_query($conn,$sql)) {
		echo '{"Result":"Data Updated Successfully!"}';
	}
	else {
		echo '{"Result":"Data Update Failed!"}';
	}
}

function deleteData($data) {
	include 'db.php';
	$id= $data['id'];
	$sql= "DELETE FROM `user` WHERE `id`= $id";

	if (mysqli_query($conn,$sql)) {
		echo '{"Result":"Data Deleted Successfully!"}';
	}
	else {
		echo '{"Result":"Data Detele Failed!"}';
	}
}



?>