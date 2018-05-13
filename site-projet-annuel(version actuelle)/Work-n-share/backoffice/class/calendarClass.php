<?php


class Calendar{

	private $daysName = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Samedi", "Dimanche");
	private $currentDay = 0;
	private $currentMonth = 0;
	private $currentYear = 0;

	private $currentDate = null;
	private $nDaysInMonth = 0;

	public function createCalendar(){

		$year == null;
		$month == null;
		$day == null;
		$weeks == null;
		//RECUPERATION DE L'ANNEE
		if($year == null && isset($_GET["year"])){
			$year = $_GET["year"];
			var_dump($year);
		}else if($year == null){
			$year = date("Y", time());
			var_dump($year);
		}
		//RECUPERATION DU MOIS
		if($month == null && isset($_GET["month"])){
			$month = $_GET["month"];
			var_dump($month);
		}else if($month == null){
			$month = date("m", time());
			var_dump($month);
		}
		//LA RECUPERATION DU JOUR DE SE CALCULER EN FONCTION DU MOIS


		$day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$weeks = 
		$this->currentYear = $year;
		$this->currentMonth = $month;
		$this->currentDay = $day;

		return '
			<div id="calendarBooking">
				<div id="calendarHeader">
					
				</div>
				<div id="daysName">
					<ul id="labels">
						
					</ul>
				</div>
			</div>'
	;

	}

	private function createNavigation(){

		//LE MOIS SUIVANT
		if($this->currentMonth == 12){ //SI ARRIVE AU MOIS DE DECEMBRE
			$this->currentMonth = 1;
			$nextMonth = $this->currentMonth;
		}else{
			$this->currentMonth = intval($this->currentYear) + 1;
			$nextMonth = $this->currentMonth;
		}
		//L'ANNEE SUIVANTE
		if($this->currentMonth == 12){ //SI ARRIVE AU MOIS DE DECEMBRE
			$this->currentMonth = intval($this->currentYear + 1);
			$nextYear = $this->currentMonth;
		}else{
			$this->currentMonth = $this->currentYear;
			$nextYear = $this->currentMonth;
		}
		//LE MOIS PRECEDENT
		if($this->currentMonth == 1){ //SI ARRIVE AU MOIS DE DECEMBRE
			$this->currentMonth = 12;
			$previousMonth = $this->currentMonth;
		}else{
			$this->currentMonth = intval($this->currentYear) - 1;
			$previousMonth = $this->currentMonth;
		}
		//L'ANNEE PRECEDENTE
		if($this->currentMonth == 1){ //SI ARRIVE AU MOIS DE DECEMBRE
			$this->currentMonth = intval($this->currentYear - 1);
			$nextYear = $this->currentMonth;
		}else{
			$this->currentMonth = $this->currentYear;
			$nextYear = $this->currentMonth;
		}

		return
            '<div class="header">'.
                '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
                    '<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
                '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
            '</div>';
	}


}