<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Page 3 [History]</title>
</head>
<body>
	<h1>Page 3 [History]</h1>

	<h2>Conversion Site</h2>
	<br>
	<td>1</td> <a href="home.php">Home</a>
	<td>2</td> <a href="conversion-rate.php">Conversion Rate</a>
	<td>3</td> <a href="history.php">History</a>
	<br>
	<h2>History:</h2>
	<br>

	<?php
	define("filepath", "data.txt");

	$fileData = read();
	$data= json_decode($fileData);
	echo "<ol>";

	for ($i=0; $i < sizeof($data); $i++) { 
		echo "<li>" . $data[$i]->conversion ." ". $data[$i]->value ." ". $data[$i]->result . "</li>";
	}
	echo"</ol>";

	function read() {
		$file = fopen(filepath, "r");
		$fz = filesize(filepath);
		$fr = "";
		if($fz > 0) {
			$fr = fread($file, $fz);
		}
		fclose($file);
		return $fr;
	}


	?>

</body>
</html>