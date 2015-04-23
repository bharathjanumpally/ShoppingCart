<?php
	session_start();
		require_once 'dbconnect.php';
//session_destroy();
	/*
	 * To change this template, choose Tools | Templates
	 * and open the template in the editor.
	 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <title>Shop - Cart</title>
		<link rel = "stylesheet" type = "text/css" href = "style.css"/>
		<script src = "script.js" type = "text/javascript"></script>
		<link rel = "icon" href = "favicon.ico" type = "image/ico"/>
		<link rel = "shortcut icon" href = "favicon.ico" type = "image/ico"/>
    </head>
	<body>
		<?php include 'menu.php'; ?>
		<div id = "content">
			<h1>Your Cart!</h1>
			<?php
			
				if (isset($_SESSION['email'])) {
					$email = $_SESSION['email'];
					$table = "user where email=\"$email\"";
					$hasStuff = false;
					$query = mysqli_query($con,"select * from $table");
					while ($field = mysqli_fetch_array($query)) {
						$hasStuff = true;
						echo $field['name'] . "'s Shopping Cart:";
						echo "<br/>";
						$items = $field['cart'];
						echo "<br/>";
						$cart = true;
						include 'displayItems.php';
						//+-------+-------------+------+-----+---------+----------------+
						//| Field | Type        | Null | Key | Default | Extra          |
						//+-------+-------------+------+-----+---------+----------------+
						//| id    | int(11)     | NO   | PRI | NULL    | auto_increment |
						//| email | varchar(64) | YES  | UNI | NULL    |                |
						//| name  | varchar(64) | YES  | UNI | NULL    |                |
						//| pass  | varchar(64) | YES  |     | NULL    |                |
						//| cart  | text        | YES  |     | NULL    |                |
						//| bio   | text        | YES  |     | NULL    |                |
						//| photo | text        | YES  |     | NULL    |                |
						//| birth | date        | YES  |     | NULL    |                |
						//+-------+-------------+------+-----+---------+----------------+
						?>
						<div id = "total">
							<table>
								<tr>
									<td>Subtotal: </td>
									<td style = "text-align: right">$<?php echo number_format($total, 2, '.', ','); ?><br/></td>
								</tr>
								<tr>
									<td>Tax (7%): </td>
									<td style = "text-align: right">$<?php echo number_format($total * 0.07, 2, '.', ','); ?><br/></td>
								</tr>
								<tr>
									<td>Total: </td>
									<td style = "text-align: right">$<?php echo number_format($total * 1.07, 2, '.', ','); ?><br/></td>
								</tr>
							</table>
							<a href = "checkout.php">Check Out</a>
						</div>
						<?php
					}
					if (!$hasStuff) echo "Empty set";
				} else {
					echo "Not logged on";
				}
				//mysqli_close($con);
			?>
		</div>
    </body>
</html>
