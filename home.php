<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Page 1 [Home]</title>
</head>
<body>
	


	<?php
	define("filepath", "data.txt");
	define("filepath1", "conversion-rate.txt");

	$value = $result = $converter = $error ="";

	$fileData1 = read1();
	$data1= json_decode($fileData1);


	

	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$value = $_POST['value'];
		$result = $_POST['result'];
		$converter = $_POST['converter'];


		if(empty($value)) {
			$error = "Please enter a value";
		}

		else{
			$fileData1 = read1();
			$data1= json_decode($fileData1);

			for ($i=0; $i <sizeof($data1) ; $i++) { 
				if($converter==$data1[$i]->category){
					$result = $value*$data1[$i]->rate;

					$fileData = read();
					if(empty($fileData)) {
						$data[] = array("conversion" => $data1[$i]->category, "value" => $value, "result" => $result);
					}
					else {
						$data= json_decode($fileData);
						array_push($data, array("conversion" => $data1[$i]->category, "value" => $value, "result" => $result));
					}
					$data_encode = json_encode($data);
					write("");
					$res = write($data_encode);
				}
				

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

	function read1() {
		$file = fopen(filepath1, "r");
		$fz = filesize(filepath1);
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
			<h1>Page 1 [Home]</h1>

			<h2>Conversion Site</h2>
			<br>
			<td>1</td> <a href="home.php">Home</a>
			<td>2</td> <a href="conversion-rate.php">Conversion Rate</a>
			<td>3</td> <a href="history.php">History</a>
			<br>
			<h2>Converter:</h2>
			<br>

			<label for="converter">Converter:</label>
			<select id="converter" name="converter">
				
				<option selected="converter"><?php echo $converter; ?></option>
				<?php


				for ($i = 0;$i < sizeof($data1);$i++)
				{
					echo "<option>".$data1[$i]->category ."</option>";
				}
				?>
			</select>
			<br><br>
			<label for="value">Value:</label>
			<input type="number" id="value" name="value" value="<?php echo $value; ?>">

			<input type="submit" name="submit" value="Submit">

			<br><br>
			<label for="result">Result:</label>
			<input type="text" id="result" name="result" value="<?php echo $result; ?>" readonly>

		</fieldset>
		<br><br>

	</form>
	<span style="color: red"><?php echo $error; ?></span>


</body>
</html>