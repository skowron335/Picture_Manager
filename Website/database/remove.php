<!DOCTYPE html>

<html lang="pl-PL">
	<head>
		<meta charset="utf-8">
		<title>USUWANIE</title>
		<meta http-equiv="refresh" content="3; url=../index.php"/>
	</head>

	<body>
		<main>
		
			<?php
				$server_name = "localhost";
				$user_name = "root";
				$user_password = "";
				$database_name = "pictures";
				
				$connection = mysqli_connect($server_name, $user_name, $user_password);
				
				$sql = "DROP DATABASE IF EXISTS $database_name";
				mysqli_query($connection, $sql);
				
				echo "BAZA DANYCH ZOSTAŁA USUNIĘTA!!";
				?>
				<br /><br />
				<?php
				echo "ZA CHWILĘ NASTĄPI PRZEKIEROWANIE NA STRONĘ GŁÓWNĄ..";
			?>
			
		</main>
	</body>
</html>