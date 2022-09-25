<?php
class Data{
    private int $idData;
    private string $time; 
    private int $cardiacFreq;
    private float $longitude;
    private float $latitude;
    private int $altitude;
    private int $idAct;

    public function  __construct() { }
    public function init($id, $t, $cFrq, $long, $lat, $alt, $idA){
        $this->idData = $id;
        $this->time = $t;   
        $this->cardiacFreq = $cFrq;
        $this->longitude = $long;
        $this->latitude = $lat;
        $this->altitude = $alt;
        $this->idAct = $idA;
    }

    public function setId($id){
        $this->idData = $id;
    }

    public function getIdData(): int { return $this->idData; }
    public function getTime(): string { return $this->time; }
    public function getCardiacFreq(): int { return $this->cardiacFreq; }
    public function getLongitude(): float { return $this->longitude; }
    public function getLatitude(): float { return $this->latitude; }
    public function getAltitude(): int { return $this->altitude; }
    public function getIdAct(): int { return $this->idAct; }

    public function  __toString(): string { return $this->idData. " ". $this->time. " ". 
                                            $this->cardiacFreq. " ". $this->longitude. " ".
                                            $this->latitude. " ". $this->altitude. " ". 
                                            $this->idAct; }
}
?>