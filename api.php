<?php

header('content-type: application/json');

$request= $_SERVER['REQUEST_METHOD'];

	switch ($request) {
		case 'GET':
				getData();
			break;
		case 'POST':
			echo '{"name":"POST.....Rabid"}';
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



?>