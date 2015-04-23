<?php
	
	session_start();
	require_once 'dbconnect.php';
//session_destroy();
	/*
	 * To change this template, choose Tools | Templates
	 * and open the template in the editor.
	 */
?>


<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <title>Shop - Profile</title>
		<link rel = "stylesheet" type = "text/css" href = "style.css"/>
		<script src = "script.js" type = "text/javascript"></script>
		<link rel = "icon" href = "favicon.ico" type = "image/ico"/>
		<link rel = "shortcut icon" href = "favicon.ico" type = "image/ico"/>
    </head>
	<body>
		<?php include 'menu.php'; ?>
		<div id = "content">
			<h1>Your Profile!</h1>
			<?php
				
				if (isset($_SESSION['email'])) {
					$email = $_SESSION['email'];

					if (isset($_POST['submit'])) {
						$name = $_POST['name'];
						$bio = $_POST['bio'];
						
						$birth = $_POST['birth'];

						$table = "name=\"$name\", bio=\"$bio\", birth=\"$birth\" where email=\"$email\"";
						$query = mysqli_query($con,"update user set $table");
						if (!$query) echo "error";
						else header("Location: " . $_SERVER['PHP_SELF']);
					}

					$table = "user where email=\"$email\"";
					$query = mysqli_query($con,"select * from $table");
					while ($field = mysqli_fetch_array($query)) {
						$name = $field['name'];
						$bio = $field['bio'];
						//$photo = $field['photo'];
						$birth = $field['birth'];
						$items = $field['past'];
					}
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

					mysqli_close($con);
					if (isset($_POST['update'])) {
						?>
						<form action = "" method = "post">
							<table border = "0">
								<tr>
									<th>Name</th>
									<td><input type = "text" placeholder = "name" name = "name" value = "<?php echo $name ?>"/></td>
								</tr>
								<tr>
									<th>Bio</th>
									<td><textarea name = "bio" cols = "30" rows = "10"><?php echo $bio ?></textarea></td>
								</tr>
								
								<tr>
									<th>Birth Date</th>
									<td><input type = "date" placeholder = "YYYY-MM-DD" name = "birth" value = "<?php echo $birth ?>"/></td>
								</tr>
							</table>
							<input type = "submit" name = "submit" value = "Submit Edit"/>
						</form>
						<?php
					} else {
						?>
						<table border = "0">
							<tr>
								<th class = "profile">Name</th>
								<td><?php echo $name ?></td>
							</tr>
							<tr>
								<th class = "profile">Bio</th>
								<td><?php echo $bio ?></td>
							</tr>
							
							<tr>
								<th class = "profile">Birth Date</th>
								<td><?php echo $birth ?></td>
							</tr>
							<tr>
								<th class = "profile">Past purchases</th>
								<td><?php include 'displayItems.php'; ?></td>
							</tr>
						</table>
						<form action = "" method = "post">
							<input type = "submit" name = "update" value = "Edit Profile"/>
						</form>
						<?php
					}
				} else {
					echo "Not logged on";
				}
			?>
		</div>
    </body>
</html>
