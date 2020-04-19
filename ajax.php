<?php

	$conn = new mysqli("db", "root", "root", "gestion");
	/*
	$sql = "SELECT id, name FROM country ";

	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

	$data = array();

	while( $rows = mysqli_fetch_assoc($resultset) ) {
		$data[] = [
			'id' => $rows['id'],
			'name' => $rows['name']
		];

	}

	$results = array('data' => $data );


	echo json_encode($results);

    //exit;
			
	*/

	
	
	if(isset($_POST['key']))
	{

	    $conn = new mysqli("db", "root", "root", "gestion");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		if($_POST['key'] == 'getAllData'){

			$sql = "SELECT id, name FROM country ";

			$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

			$data = array();

			while( $rows = mysqli_fetch_assoc($resultset) ) {
				$data[] = [
					'id' => $rows['id'],
					'name' => $rows['name'],
					'action' => '
						<input type ="button" onclick= "edit('.$rows["id"].')" value="edit"  class="btn btn-primary">
						<input type ="button" value="delete"  class="btn btn-danger">
						<input type ="button" value="view"  class="btn">
					'
				];
			}

			$results = array('data' => $data );

			echo json_encode($results);

		}
		
	    
	    if($_POST['key'] == 'addNew'){

	    	$name = $conn->real_escape_string($_POST['name']);
			$shortDescription = $conn->real_escape_string($_POST['shortDescription']);
			$longDescription= $conn->real_escape_string($_POST['longDescription']);


	    	$sql = $conn->query("SELECT id FROM country  WHERE name = $name");

	    	if($sql  && $sql->num_rows > 0){
	    		exit('this country is aulready exist');
	    	} else {
	    		$sql = $conn->query("INSERT INTO country (name, shortDescription, longDescription ) VALUES('$name','$shortDescription', '$longDescription')");
	    		exit('country has inserted')	;
	    	}
	    }

	    if($_POST['key'] == 'getRowdata'){

	    	$id = $conn->real_escape_string($_POST['id']);

	    	$sql = $conn->query("SELECT id, name, shortDescription, longDescription FROM country  WHERE id = $id");

	    	$data = $sql->fetch_array();

	    	$response = [
	    		'id' => $data['id'],
	    		'name' => $data['name'],
	    		'shortDescription' => $data['shortDescription'],
	    		'longDescription' => $data['longDescription'],
	    	];

	    	echo json_encode($response);
	    }

	    if($_POST['key'] == 'update'){
	    	//owID: editRowID.val()
	    	$id = $conn->real_escape_string($_POST['id']);
	    	$name = $conn->real_escape_string($_POST['name']);
			$shortDescription = $conn->real_escape_string($_POST['shortDescription']);
			$longDescription= $conn->real_escape_string($_POST['longDescription']);

	    	$sql = $conn->query("UPDATE country SET name='$name', shortDescription='$shortDescription', 
	    		longDescription='$longDescription' WHERE id = '$id'");
	    	echo 'success';
	    }

}else{
	exit('KO');
}

?>