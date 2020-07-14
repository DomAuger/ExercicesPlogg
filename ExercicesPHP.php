<!-- Ecrit par Dominik Auger, juillet 2020 -->
<!DOCTYPE html>
	<html>
		<head>
			<title> Exercice PHP Dominik Auger </title>
			<meta charset="utf-8">
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
			<link rel="stylesheet" href="Styles/StyleForPhpExercice.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script type="text/javascript" src="ClientSideFormValidation.js"></script>
		</head>
		
		<body>

		<div class="container card border border-dark rounded perfect-centering">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
				<div class="form-group row">
					<div class="col-xs-3">
						<label for="baseline"> Baseline between 0 and 100 </label>
						<input class="form-control" name="baseline" type="number" min="0" max="100" placeholder="baseline" />
						<label for="total"> Total </label>
						<input class="form-control" name="total" type="number" placeholder="total" />
						<label for="start_date">Start date </label>
						<input class="form-control" name="start_date" type="date" />
						<label for="end_date">End date </label>
						<input class="form-control" name="end_date" type="date" />
					</div>
				</div>

				<input type="submit" value="Submit" class="btn btn-primary">
				<input type="reset" value=" Reset  " class="btn btn-warning">

			 </form>
		</div>

		</body>
	</html>

<?php
	require 'AmountDistributer.php';

	$baselineValue = !isset($_POST["baseline"]) || $_POST["baseline"] == "" ? 0 : $_POST["baseline"];
	$totalValue = !isset($_POST["total"]) || $_POST["total"] == "" ? 0 : $_POST["total"];
	$startDateValue = !isset($_POST["start_date"]) || $_POST["start_date"] == "" ? 0 : $_POST["start_date"];
	$endDateValue = !isset($_POST["end_date"]) || $_POST["end_date"] == "" ? 0 : $_POST["end_date"];

	$randomAmountDistributer = new RandomAmountDistributer($baselineValue, $totalValue, $startDateValue, $endDateValue);
	$randomAmountDistributer->displayResults();
?>