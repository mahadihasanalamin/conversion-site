<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Page 2 [Conversion Rate]</title>
</head>
<body>


	<?php
	define("filepath", "conversion-rate.txt");


	$category = $unit = $rate = $error ="";
	$error1 = $error2 = $error3 = "";
	$successfulMessage = $errorMessage = "";
	$flag = false;

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$category = $_POST['category'];
		$unit = $_POST['unit'];
		$rate = $_POST['rate'];

		if(empty($category)) {
			$error1 = "Please enter a value";
			$flag = true;
		}
		if(empty($unit)) {
			$error2 = "Please enter a value";
			$flag = true;
		}
		if(empty($rate)) {
			$error3 = "Please enter a value";
			$flag = true;
		}

		if(!$flag){

			$fileData = read();
			if(empty($fileData)) {
				$data[] = array("category" => $category, "unit" => $unit, "rate" => $rate);
			}
			else {
				$data= json_decode($fileData);
				array_push($data, array("category" => $category, "unit" => $unit, "rate" => $rate));
			}


			$data_encode = json_encode($data);
			write("");
			$res = write($data_encode);
			if($res) {
				$successfulMessage = "Sucessfully saved.";
			}
			else {
				$errorMessage = "Error! while saving.";
			}
		}

		
	}


	function write($content) {
		$file = fopen(filepath, "w");
		$fw = fwrite($file, $content . "\n");
		fclose($file);
		return $fw;
	}

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

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

		<fieldset>

			<h1>Page 1 [Conversion Rate]</h1>
			<h2>Conversion Site</h2>
			<br>
			<td>1</td> <a href="home.php">Home</a>
			<td>2</td> <a href="conversion-rate.php">Conversion Rate</a>
			<td>3</td> <a href="history.php">History</a>
			<br>
			<h2>Conversion Rate:</h2>
			<br>

			<label for="category">Category:</label>
			<input type="text" id="category" name="category">
			<span style="color: red"><?php echo $error1; ?></span>

			<label for="unit">Unit:</label>
			<input type="number" id="unit" name="unit">
			<span style="color: red"><?php echo $error2; ?></span>

			<label for="rate">Rate:</label>
			<input type="float" id="rate" name="rate">
			<span style="color: red"><?php echo $error3; ?></span>

			<input type="submit" name="submit" value="Submit">

			<span style="color: green"><?php echo $successfulMessage; ?></span>
			<span style="color: red"><?php echo $errorMessage; ?></span>

		</fieldset>
		<br><br>
	</form>
	

</body>
</html>