<?php
class Form{

	private $data;
	public $surround ='p';

	public function __construct($data = array()){
		$this->data = $data;
	}

	private function surround($html){
		return "<$this->surround>$html</$this->surround>";
	}

	private function getValue($index){
		return isset($this->data[$index]) ? $this->data[$inputndex] : null;
	}

	public function input ($name, $placehodler){
		if($name === "passwordUser" || $name === "passwordUser2"){
			return $this->surround('<input type="password" name="'. $name .'"value="'.$this->getValue($name).'">');
		}else{

			return $this->surround(
				'<input type="text" placeholder="'.$this->getValue($placeholder).'" name="'. $name .'" value="'.$this->getValue($name).'">');
		}
	}
	

	public function submit($name){

			return $this->surround('<input type="button" value="'.$name.'"></input>');

	}


}

