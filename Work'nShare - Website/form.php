<?php
class Form{

	private $data;
	public $surround ='label';

	public function __construct($data = array()){
		$this->data = $data;
	}

	private function surround($html){
		return "<$this->surround>$html</$this->surround>";
	}

	private function getValue($index){
		return isset($this->data[$index]) ? $this->data[$inputndex] : null;
	}

	public function input ($name, $label){
		if($name === "passwordUser" || $name === "passwordUser2"){
			return $this->surround(
				'<label>' . $this->getValue($label). '</label><input type="password" name="'. $name .'"value="'.$this->getValue($name).'">');
		}else{

			return $this->surround(
				'<label>' . $label. '</label> <input type="text" name="'. $name .'"value="'.$this->getValue($name).'">');
		}
	}
	

	public function submit(){
		return $this->surround('<button type="submit">Envoyer</button>');
	}


}

