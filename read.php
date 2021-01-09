<?php
    //database connection
    $con = mysqli_connect('localhost', 'root', 'root', 'task');
    ?>

<html>
	<head>
		<title>Read All Data</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>EMAIL</th>
            <th>PHONE NUMBER</th>
            <th>ADDRESS</th>

		</tr>
	</thead>
	<?php $results = mysqli_query($con, "SELECT * FROM user");
          while ($row = mysqli_fetch_array($results)) 
          { ?>
		<tr>
        
			<td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
			<td><?php echo $row['phonenumber']; ?></td>
            <td><?php echo $row['address']; ?></td>

			
		</tr>
	<?php } ?>
	<tr>
			<td><a href="index.php"><button type="button" name="back" class="btn">Back</button></a></td>
		</tr>
</table>

	</body>
</html>
