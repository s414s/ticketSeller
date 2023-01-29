<?php

class Redirect {
  public static function goToPage($header){
    header("Location: ".$header);
    return;
  }
}


class Verification {
  private $token;
  private $rawData;
  public $pwdFileName;

  function __construct($pwdFileName) {
    $this->pwdFileName = $pwdFileName;
  }

  function isLogged($token){
    $pwdFile = fopen($this->pwdFileName, "r");
    $return = false;

    while ($line = fgets($pwdFile)) {
        list($user, $pwd, $rtoken) = explode(":",rtrim($line));
        if($token === $rtoken){
        $return = true;
        }
    }

    fclose($pwdFile);
    return $return;
  }
  
  function createToken($content){
    return sha1(time().$usrpwd);
  }

  function pwdCorrect($userName, $password){
    $usrpwd = $userName.":".$password;
    $pwdFile = fopen($this->pwdFileName, "r");
    $return = false;
    $result = "";

    while ($line = fgets($pwdFile)) {
      list($user, $pwd, $token) = explode(":",rtrim($line));
      if($usrpwd === $user.":".$pwd){
        $return = true;
        $this->token = $this->createToken($usrpwd);
        $result .= $usrpwd.":".$this->token."\n";
      }else{

        $result .= $line;
      }
    }
    fclose($pwdFile);
    
    $this->rawData = $result;

    return $return;
  }
  
  function createCookie($daysDuration){
    $endDate = time() + $daysDuration * 86400;
    setcookie("log", $this->token, $endDate, "/");
    return;
  }

  function updateLog(){
    unlink($this->pwdFileName);
    
    $targetFile = fopen($this->pwdFileName, "w");
    fwrite($targetFile, $this->rawData);
    fclose($targetFile);

  }

  function logOut($keyName){
    setcookie($keyName, null);
  }

  function getUserName($token){
    $pwdFile = fopen($this->pwdFileName, "r");

    while ($line = fgets($pwdFile)) {
        list($user, $pwd, $rtoken) = explode(":",rtrim($line));
        if($token === $rtoken){
          $userName = $user;
        }
    }

    return $userName;
  }
}


class Ticket {
  public $name;
  public $surname;
  public $dni;
  public $age;
  public $country;
  public $sex;
  public $disability;
  private $basePrice = 50;

  function __construct($data) {
    @$this->name = $data["name"];
    @$this->surname = $data["surname"];
    @$this->dni = $data["dni"];
    @$this->age = $data["age"];
    @$this->country = $data["country"];
    @$this->sex = $data["sex"];
    @$this->disability = $data["disability"];
  }

  function getPrice(){
    $price = $this->basePrice;
    if ($this->age < 15){$price = 30;}
    if ($this->age >= 60){$price = 20;}
    if ($this->disability === "visual"){$price *= 0.5;}
    if ($this->disability === "auditiva"){$price *= 0.75;}
    return $price;
  }

  function saveJson($jsonFolder, $nameEmployee){

    function setName($folder){
          $numFiles = count(scandir($folder))-2;
          $id = str_pad($numFiles+1, 4, '0', STR_PAD_LEFT);
          $date = date("o-m-d");
          return $date."-".$id;
    }

    $targetFile = fopen($jsonFolder.setName($jsonFolder).".txt", "w");

    $dataJson = array(
      "name" => $this->name,
      "surname" => $this->surname,
      "dni" => $this->dni,
      "age" => $this->age,
      "country" => $this->country,
      "sex" => $this->sex,
      "disability" => $this->disability,
      "price" => $this->getPrice(),
      "seller" => $nameEmployee
    );

    $json = json_encode($dataJson);

    fwrite($targetFile, $json);
    fclose($targetFile);
    return;

  }

  function isDataMissing(){
    $return = false;
    if (empty($this->name) || empty($this->surname) || empty($this->age) || empty($this->dni)) {
      $return = true;
    }
    return $return;
  }

  function checkDni(){
    $num = substr($this->dni, 0, 8);
    $letter = substr($this->dni, -1);
    $len = strlen($this->dni);
    $validation = false;

    if (substr("TRWAGMYFPDXBNJZSQVHLCKE",$num%23,1) === $letter){
      $validation = true;
    }

    return $validation;
  }

  function getInformation(){

    $information = array(
      "name" => $this->name,
      "surname" => $this->surname,
      "dni" => $this->dni,
      "age" => $this->age,
      "country" => $this->country,
      "sex" => $this->sex,
      "disability" => $this->disability,
      "price" => $this->getPrice()
    );

    return $information;

  }
}

?>