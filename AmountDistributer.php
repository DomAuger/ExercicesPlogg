<?php
	require "Constants.php";

	// besoin de refactoring
	// Ecrit par Dominik Auger juillet 2020
	class RandomAmountDistributer{
		
		private $baseline;
		private $total; 
		private $results; 
		private $start_date;
		private $end_date;

		function __CONSTRUCT ($baseline, $total, $start_date, $end_date){

			$this->results = array();

			if ($total <= 0){
				return;
			}

			if ($baseline < DEFAULT_VALUE || $baseline > MAX_BASELINE_VALUE){
				return;
			}

			if (strtotime($this->start_date) >= strtotime($this->end_date)){
				return;
			}

			$this->baseline = $baseline;
			$this->start_date = $start_date;
			$this->end_date = $end_date;
			$this->total = $total;

			if ($start_date == 0 || $end_date == 0)
				return;

			$this->fillResults();
		}

		function fillResults(){
			$weekDays = 0;
			$arrayTmp = array();

			while (strtotime($this->start_date) <= strtotime($this->end_date)){
				
				$dayOfTheWeek = strtolower(date("l", strtotime($this->start_date)));
				
				if ($dayOfTheWeek == "saturday" || $dayOfTheWeek == "sunday"){
					$arrayTmp = array($this->start_date => number_format(DEFAULT_VALUE,2));
				}
				else {
					$weekDays++;
					$arrayTmp = array($this->start_date => number_format(DEFAULT_VALUE + 1, 2));
				}

				$this->results = array_merge($this->results, $arrayTmp) ;
				$this->start_date = date ("Y-m-d", strtotime("+1 day", strtotime($this->start_date)));
			}

			$totalTmp = $this->total;
			$weekDaysTmp = $weekDays;

			foreach ($this->results as $key => &$value){
				
				if ($value == DEFAULT_VALUE + 1){
					
					$currentNumber = 0;

					while ($currentNumber < $this->baseline / $weekDaysTmp){
						
						$currentNumber = rand(( $this->baseline / $weekDays), ($this->total - $currentNumber) / $weekDays) ;
					}

					$this->total -= $currentNumber;
					$value = number_format($currentNumber, 2);
					$weekDays--;
				}
			}

			if ($this->total > 1 || $this->total < -1){
				
				foreach ($this->results as $key => &$value){
					
					if ($value > 0){
						$value = number_format($value + ($this->total / $weekDaysTmp), 2);
					}
				}
			}
		}

		function getResults(){
			 return $this->results;
		}

		function displayResults(){
			echo "<div class=container>";
			echo "<table class=table>";
			echo "<thead class=thead-dark>";
			echo "<tr>";
			echo "<th scope=col>" . " Dates " . "</th>";
			echo "<th scope=col>" . " Values " . "</th>";
			echo "</tr>";
			echo "<tbody>";

			foreach ($this->getResults() as $key => $value){
				echo "<tr>";
				echo "<td>" . $key . "</td>";
				echo "<td>" . $value . "</td>";
				echo "</tr>";
			}

			echo "</tbody>";
			echo "</table>";
			echo "</div>";

			echo "<div class=container>";
			echo "<div class=footer>
				  <p>Made by Dominik Auger July 2020</p>
				  </div></div>";
		}
	}
?>