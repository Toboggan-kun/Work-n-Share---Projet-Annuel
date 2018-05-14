<?php
require_once "conf.inc.php";
require "class/dataBaseClass.php";
require "class/messageClass.php";
class Booking{

	private $db;
	private $openspace;
	private $date;
	private $typeRoom;
	private $entranceHour;
	private $exitHour;
	private $idEquipement;
	private $bookingCode;
	private $quantityEquipment;
	private $idMenu;
	private $quantityMenu;
	private $error = false;
	public $message;
	public $listOfErrorsBooking = array();

	
	public function __construct(){
		$db = new DataBase();
		$this->db = $db;
		$this->message = new Message();
	}
	public function createBooking($idOpenSpace, $entranceHour, $exitHour, $quantityEquipment1, $quantityEquipment2, $quantityMenu){

		$this->bookingCode = self::generateBookingCode($idOpenSpace, "azertyuiop");
		if($idOpenSpace == "Bastille") $this->openspace = 1;
		if($idOpenSpace == "République") $this->openspace = 2;
		if($idOpenSpace == "Odéon") $this->openspace = 3;
		if($idOpenSpace == "PlaceItalie") $this->openspace = 4;
		if($idOpenSpace == "Ternes") $this->openspace = 5;
		if($idOpenSpace == "Beaubourg") $this->openspace = 6;
		
		$this->db->prepareQuery('INSERT INTO booking(
													idUser,
													idRoom,
													dateBookingStart,
													dateBookingEnd,
													qtyEquipment1,
													qtyEquipment2,
													qtyMenu,
													bookingCode

													)
								VALUES(	:idUser,
										:idRoom,
										:dateBookingStart,
										:dateBookingEnd,
										:qtyEquipment1,
										:qtyEquipment2,
										:qtyMenu,
										:bookingCode)'
								);
		$this->db->executeQuery([
			"idUser" => 1,
			"idRoom" => $this->openspace,
			"dateBookingStart" => $entranceHour,
			"dateBookingEnd" => $exitHour,
			"qtyEquipment1" => $quantityEquipment1,
			"qtyEquipment2" => $quantityEquipment2,
			"qtyMenu" => $quantityMenu,
			"bookingCode" => $this->bookingCode
		]);

		$this->error = false;



	}

	private function getIdLocation($value){
		if($value == "Bastille") $this->openspace = 1;
		if($value == "République") $this->openspace = 2;
		if($value == "Odéon") $this->openspace = 3;
		if($value == "PlaceItalie") $this->openspace = 4;
		if($value == "Ternes") $this->openspace = 5;
		if($value == "Beaubourg") $this->openspace = 6;

		return $this->openspace;
	}
	private function isError(){
		if($this->error == true){
			
			$_SESSION['error'] = $this->listOfErrorsBooking;
		}
	}
	public function createSchedule($idOpenSpace){

		$this->db->prepareQuery('SELECT openHour, closeHour FROM schedule WHERE idOpenSpace = :idOpenSpace');
		$this->db->executeQuery([
			"idOpenSpace" => $idOpenSpace
		]);
		$result = $this->db->fetchQuery(); //fetchAll

		$schedule = '<table>
			<caption>Horaires disponible pour cette date</caption>
			<tbody>
				<tr>

					<td><input type="button" value="'.$result[0]["openHour"].'"></input></td>
					<td><input type="button" value="'.$result[0]["closeHour"].'"></input></td>

				</tr>
			</tbody>		
		</table>';

		return $schedule;
	}

	public function openspacesAvailable($typeRoom){
		$this->db->prepareQuery('SELECT DISTINCT nameOpenSpace FROM openspace, room AS r WHERE r.typeRoom = :typeRoom');
		$this->db->executeQuery([
			"typeRoom" => $typeRoom
		]);

		return $this->db->fetchQuery();
	}
	public function scheduleAvailable($room){

		$this->db->prepareQuery('SELECT DISTINCT dateBookingStart, dateBookingEnd FROM room AS r, booking AS b WHERE r.idRoom = :idRoom');
		$this->db->executeQuery([

			"idRoom" => $room
		]);


		
		return $this->db->fetchQuery();

	}
	public function dateAvailable($date){

		$this->db->prepareQuery('SELECT openHour, closeHour FROM openspace WHERE idOpenSpace = :idOpenSpace');
		$this->db->executeQuery([
			"idOpenSpace" => $idOpenSpace
		]);
		$result = $this->db->fetchQuery(); //fetchAll

	}
	public function checkIsInt($value){
		if(!is_int($value)){
			$this->error = true;
			$this->listOfErrorsBooking[] = $this->message->listOfErrorsBooking(4); 
			self::isError();

		}
		return $this->error;
	}
	public function isEmpty($value, $index){

		if(empty($value) || strlen($value) < 1){
			$this->error = true;
			$this->listOfErrorsBooking[] = $this->message->listOfErrorsBooking($index);
			self::isError();
		}
		return $this->error;
	}
	/*public function setter($value){
	
		var_dump($this->openspace);
	}
	public function getter(){

		return $this->openspace;
	}*/
	public function checkDate($date){

		if($date < $_SESSION['currentDateEN'] || $date == null){
			$this->error = true;
			$this->listOfErrorsBooking[] = $this->message->listOfErrorsBooking(3);
			self::isError();
		}
		return $this->error;
	}
	public function loadScheduleByDay($day, $openspace){

		$this->day = $day;
		if($openspace == "Bastille") $this->openspace = 1;
		if($openspace == "République") $this->openspace = 2;
		if($openspace == "Odéon") $this->openspace = 3;
		if($openspace == "PlaceItalie") $this->openspace = 4;
		if($openspace == "Ternes") $this->openspace = 5;
		if($openspace == "Beaubourg") $this->openspace = 6;

		$this->db->prepareQuery('SELECT openHour, closeHour FROM schedule WHERE day = :day AND idOpenSpace = :idOpenSpace');
		$this->db->executeQuery([
			
			"idOpenSpace" => $this->openspace,
			"day" => $this->day
		]);

		$room = $this->db->fetchQuery(); //fetchAll
		return $room;
	}

	public function calculSchedule($date, $room){
		
		$this->db->prepareQuery('SELECT DISTINCT dateBookingStart, dateBookingEnd FROM booking AS b, room AS r WHERE b.idRoom = (SELECT DISTINCT r.idRoom FROM room WHERE r.nameRoom = :nameRoom)');

		$this->db->executeQuery([

			"nameRoom" => $room


		]);
		$result = $this->db->fetchQuery();
		

		if(empty($result)){

			$error = null;
		}else{
			$dateStart = date('H:i:s', strtotime($result[0]['dateBookingStart']));
			$date = $date.$dateStart;
			$date = date("Y-m-d H:i:s", strtotime($date));
			$this->db->prepareQuery('SELECT DISTINCT dateBookingStart, dateBookingEnd FROM booking AS b, room AS r WHERE b.idRoom = (SELECT DISTINCT r.idRoom FROM room WHERE b.dateBookingStart = :dateBookingStart AND r.nameRoom = :nameRoom)');

			$this->db->executeQuery([

				"nameRoom" => $room,
				"dateBookingStart" => $date
			]);
			$result2 = $this->db->fetchQuery();
		
			if(empty($result2)){

				$error = null;
			}else{

				$startHour = date("H:i", strtotime($result2[0]["dateBookingStart"]));
				$endHour = date("H:i", strtotime($result2[0]["dateBookingEnd"]));
				$error =  $startHour."-".$endHour;
			}
		}

		return $error;


		
	}
	public function choseRoom($idOpenSpace, $type){
		$idOpenSpace = self::getIdLocation($idOpenSpace);
		$this->db->prepareQuery('SELECT DISTINCT idRoom, nameRoom FROM room AS r WHERE r.idOpenSpace = :idOpenSpace AND r.typeRoom = :typeRoom AND stateRoom != 2');
		$this->db->executeQuery([
			"idOpenSpace" => $idOpenSpace,
			"typeRoom" => $type
		]);
		return $this->db->fetchQuery();
	}
	public function checkCardNumber($value){

		if(strlen($value) == 16 && ctype_digit($value)){ //SI FORMAT 0000000000000000
			$this->error = false;
		}else{
			$this->error = true;
			$this->listOfErrorsBooking[] = $this->message->listOfErrorsBooking(5);
		}
		self::isError();
		return $this->error;
	}
	public function checkCardSecurity($value){
		if(strlen($value) == 3 && ctype_digit($value)){
			$this->error = false;

		}else{
			$this->error = true;
			$this->listOfErrorsBooking[] = $this->message->listOfErrorsBooking(6);

		}
		self::isError();
		return $this->error;
	}

	public function checkCardMonth($month, $year){
		$currentYear = date("Y", strtotime($_SESSION['currentDateEN']));
		$currentMonth = date("m", strtotime($_SESSION["currentDateEN"])); //RECUPERATION DU MOIS D'AUJOURD'HUI
		if($year == $currentYear && strlen($month) == 2 && ctype_digit($month) && ($currentMonth < $month) && ($month >= 1 && $month <= 12)){

			$this->error = false;
		}else if($year > $currentYear && strlen($month) == 2 && ctype_digit($month) && ($month >= 1 && $month <= 12)){
			$this->error = false;
		}
		else{
			$this->error = true;
			$this->listOfErrorsBooking[] = $this->message->listOfErrorsBooking(7);
		}
		self::isError();
		return $this->error;
	}

	public function checkCardYear($value){
		//EN FRANCE, LA VALIDITE D'UNE CARTE BLEUE DURE EN MOYENNE 3 ANS
		//L'UTILISATEUR NE POURRA PAS AVOIR UNE CARTE QUI EXPIRE PLUS DE 3 ANS A PARTIR DE CETTE ANNEE
		$currentYear = date("Y", strtotime($_SESSION['currentDateEN']));
		if(strlen($value) == 4 && ctype_digit($value) && ($currentYear <= $value) && ($value >= $currentYear && $value <= $currentYear+3)){
			$this->error = false;
		}else{
			$this->error = true;
			$this->listOfErrorsBooking[] = $this->message->listOfErrorsBooking(7);
		}
		self::isError();
		return $this->error;
	}
	public function generateBookingCode($value1, $value2){

		//GENERATION D'UN CODE A 10 CARACTERES
		$string = $value1.$value2;
		$code = "";
		for ($i = 0; $i < 10; $i++) { 
			$code = $code.substr($string, rand()%strlen($string), 1);
		}

		return $code;
	}

	public function checkIfCardExist($user){
		
		$this->db->prepareQuery('SELECT * FROM card WHERE idUser = :idUser');

		$this->db->executeQuery([

			"idUser" => $user


		]);

		return $result = $this->db->fetchQuery();


	}

	public function hideCardNumber($card){

		$array = $card;

		for ($i=0; $i < 12; $i++) { 
			$array[$i] = "*"; // **** **** **** XXXX
		}
		

		return $array;

	}


}
?>