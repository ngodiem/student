<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Danh sách sinh viên</title>
	<link rel="shortcut icon" href="public/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="public/vendor/bootstrap-4.5.3-dist/css/bootstrap.min.css">
</head>
<body class="container-fluid">
	<h1>Danh sách sinh viên</h1>
	<form action="index.php" method="GET" class="mb-3">
		<label>Tìm kiếm: </label>
		<?php 
		$search = !empty($_GET["search"]) ? $_GET["search"] : null;
		?>
		<input type="search" class="form-control w-auto d-inline-block" name="search" value="<?=$search?>">
		<button class="btn btn-primary">Tìm</button>
	</form>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Id</th>
					<th scope="col">Firstname</th>
					<th scope="col">Lastname</th>
					<th scope="col">Email</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					// Create connection
					$servername = "localhost";
					$username= "root";
					$password = "";
					$dbname = "study_k34";
					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
					    die("Kết nối thất bại: " . $conn->connect_error);
					}
					mysqli_set_charset($conn,"utf8");

					
					$sql = "SELECT * FROM student";
					if (!empty($search)) {
						$sql .= " WHERE firstname LIKE '%$search%' 
										OR lastname LIKE '%$search%'
										OR email LIKE '%$search%'";
					}
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
					    // output data of each row
					    // false: false, 0, "", null
					    while($row = $result->fetch_assoc()) {
				?>
					       <tr>
								<th scope="row"><?=$row["id"]?></th>
								<td><?=$row["firstname"]?></td>
								<td><?=$row["lastname"]?></td>
								<td><?=$row["email"]?></td>
				</tr>
				<?php
					    }
					}
				?>
				
			</tbody>
		</table>
	</div>

	<script type="text/javascript" src="public/vendor/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="public/vendor/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
	<script src="public/js/script.js"></script>
</body>
</html>