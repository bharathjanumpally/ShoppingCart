<?php

if(!isset ($_SESSION))
{
session_start();
}

//require_once 'dbconnect.php';
$host = "localhost";
		$database="test";
		$username="root";
		$password="";

		$con=mysqli_connect($host, $username, $password, $database);

    // Check connection
    if (mysqli_connect_errno($con)){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


	if (isset($items)) {
		/*$username = "root";
		$password = "";
		$db_name = "test";
		$connect2 = mysqli_connect("localhost", $username, $password) or die("Error connecting");
		mysqli_select_db($db_name) or die("Error selecting database");*/
		?>
		<table border = "1" style = "width: 100%; background-color: #c2e1f6;">
			<tr><th>Picture</th><th>Name</th><th>Price</th><th>Quantity</th><?php if (isset($cart)) { ?><th>Remove</th><?php } ?><th>Description</th></tr>
			<?php
			$stuff = str_getcsv($items);
			//echo " ".$stuff.length;
			$total = 0;
			for ($i = 0; $i < count($stuff); $i+= 2) {
			
			
			//$str = "select * from inventory";
			$str = "select * from test.inventory where id=". $stuff[$i];
			//echo $str;	
				$query = mysqli_query($con,$str);
				 
				while ($field = mysqli_fetch_array($query)) {
					$name = $field['name'];
					$price = $field['price'];
					$total += $price * $stuff[$i + 1];
					$img = $field['img'];
					$description = $field['description'];
				}
				?>
				<tr>
					<td style = "background-color: #c2e1f6; text-align: center;">
						<img src = "images/<?php echo $img ?>"
							 style = "max-width: 100px; max-height: 100px;"
							 alt = ""/>
					</td>
					<?php
					echo "<td>" . $name . "</td>";
					echo "<td style = \"text-align: center;\">$" . number_format($price, 2, '.', ',') . "</td>";
					?>
					<td style = "text-align: center;"><?php echo $stuff[$i + 1] ?></td><?php if (isset($cart)) { ?>
						<td width = "75px" style = "text-align: center"><a href = "remove.php?id=<?php echo base64_encode($stuff[$i] * 123.456); ?>">Remove 1</a></td>
						<?php
					}
					echo "<td>" . $description . "</td>";
					echo "</tr>\n";
				}
				?>
		</table>
		<?php
		mysqli_close($con);
	 
	}
	else {
		echo "Nothing to display!";
		$total = 0;
	}
?>