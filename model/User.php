<?php
class User{
    private int $idUser;
    private string $lName;
    private string $fName;
    private string $birthDate;
    private string $gender;
    private float $size;
    private float $weight;
    private string $email;
    private string $password;

    public function  __construct() { }

    public function init($id,$lN, $fN, $birth, $g, $s, $w, $mail, $pw){
        $this->idUser = $id;
        $this->lName = $lN;
        $this->fName = $fN;
        $this->birthDate = $birth;
        $this->gender = $g;
        $this->size = $s;
        $this->weight = $w;
        $this->email = $mail;
        $this->password = $pw;
    }

    // public function setId($id){
    //     $this->idUser = $id;
    // }

    public function getID(): int { return $this->idUser; }
    public function getLName(): string { return $this->lName; }
    public function getFName(): string { return $this->fName; }
    public function getBirthDate(): string { return $this->birthDate; }
    public function getGender(): string { return $this->gender; }
    public function getSize(): float { return $this->size; }
    public function getWeight(): float { return $this->weight; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }

    public function  __toString(): string { return $this->idUser. " ".
                                            $this->lName. " ". $this->fName. " ". 
                                            $this->birthDate. " ". $this->gender. " ". 
                                            $this->size. " ". $this->weight. " ".  
                                            $this->email. " ". $this->password;}
}
?>