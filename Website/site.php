<!DOCTYPE html>

<?php
	$min_pic_size = 1;
	$max_pic_size = 17511219;
	
	$server_name = "localhost";
	$user_name = "root";
	$user_password = "";
	$database_name = "pictures";
	
	$connection = mysqli_connect($server_name, $user_name, $user_password, $database_name);
	
	if (!$connection)
	{
		header('Location: database/install.php');
	}
	
	if (isset($_POST['add']))
	{
		if ($_FILES['picture']['size'] <= $min_pic_size)
		{
			echo "Przesyłany obraz jest pusty.";
		}
		else if ($_FILES['picture']['size'] >= $max_pic_size)
		{
			echo "Przesyłany obraz ma rozmiar większy niż 16.7 MB";
		}
		else if ($connection)
		{
			$image = addslashes($_FILES['picture']['tmp_name']);
			$image = file_get_contents($image);
			$image = base64_encode($image);
		
			mysqli_query($connection, "INSERT INTO content VALUES('', '$image')");
		}
		else
		{
			echo "Błąd bazy danych.";
		}
	}
	
	if (isset($_GET['remove']))
	{
		$id = $_GET['remove'];
		
		if ($connection)
		{
			mysqli_query($connection, "DELETE FROM content WHERE content_id = $id");
		}
	}
?>

<html lang="pl-PL">
	<head>
		<meta charset="utf-8">
		<title>OBRAZKI</title>
		<link rel="stylesheet" href="styles/style.css"/>
	</head>
	
	<body>
		<header>
			<h1>Zarządzanie obrazkami</h1>
		</header>
		
		<section>
			<div class="option">
				Zarządzaj bazą danych:
				
				<a href="database/remove.php"><div class="button">Usuń</div></a>
			</div>
			
			<div class="option">
				Dodaj obrazek do bazy danych:
				
				<form action="site.php" method="post" enctype="multipart/form-data">
					<input type="file" name="picture" accept="image/*" required>
					<input type="submit" name="add" value="Dodaj"/>
					<div class="info">Maksymalny rozmiar przesyłanego zdjęcia wynosi 16.7 MB</div>
				</form>
			</div>
			
			<div class="option">
				Usuń obrazek z bazy danych:
				
				<form action="site.php" method="get">
					<select name="remove">
						<?php 
							$sql = mysqli_query($connection, "SELECT content_id FROM content");
							while ($row = $sql->fetch_assoc())
							{
								echo "<option value=" . $row['content_id'] . ">" . $row['content_id'] . "</option>";
							}
						?>
					</select>
					
					<button onclick="this.form.submit();">Usuń</button>
				</form>
			</div>
			
			<div class="option">
				Wyświetl obrazek z bazy danych:
				
				<form action="site.php" method="get">
					<select name="show">
						<?php 
							$sql = mysqli_query($connection, "SELECT content_id FROM content");
							while ($row = $sql->fetch_assoc())
							{
								echo "<option value=" . $row['content_id'] . ">" . $row['content_id'] . "</option>";
							}
						?>
					</select>
					
					<button onclick="this.form.submit();">Pokaż</button>
				</form>
				
				<?php
					if (isset($_GET['show']))
					{
						$id = $_GET['show'];
						
						if ($connection)
						{
							$query = mysqli_query($connection, "SELECT content_picture FROM content WHERE content_id = $id");
							echo '<img src="data:image/png;base64,' . mysqli_fetch_assoc($query)['content_picture'] . '" alt="Obrazek" style="width: 100%;">';
						}
					}
				?>
			</div>
			
		</section>
	</body>
	
</html>