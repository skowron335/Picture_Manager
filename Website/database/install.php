<!DOCTYPE html>

<html lang="pl-PL">
    <head>
		<meta charset="utf-8">
		<title>INSTALACJA</title>
        <meta http-equiv="refresh" content="3; url=../site.php"/>
    </head>
	
	<body>
		<main>
			
			<?php
				$server_name = "localhost";
				$user_name = "root";
				$user_password = "";
				$database_name = "pictures";
				
				$connection = mysqli_connect($server_name, $user_name, $user_password);
				
				$sql = "CREATE DATABASE IF NOT EXISTS $database_name";
				$connection->query($sql);
				
				$connection = mysqli_connect($server_name, $user_name, $user_password, $database_name);
				
				$sql = "ALTER DATABASE $database_name CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
				mysqli_query($connection, $sql);
				
				
				
				$sql = "CREATE TABLE IF NOT EXISTS content
				(
					content_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					content_picture MEDIUMBLOB NOT NULL
				)";
				
				mysqli_query($connection, $sql);
				
				
				
				echo "INSTALACJA BAZY DANYCH ZOSTAŁA ZAKOŃCZONA!!";
				?>
				<br /><br />
				<?php
				echo "ZA CHWILĘ NASTĄPI PRZEKIEROWANIE..";
			?>
			
		</main>
	</body>
</html>