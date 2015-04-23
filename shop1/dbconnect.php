
	<?php		
		$host = "localhost";
		$database="test";
		$username="root";
		$password="";

		$con=mysqli_connect($host, $username, $password, $database);

    // Check connection
    if (mysqli_connect_errno($con)){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	
?>