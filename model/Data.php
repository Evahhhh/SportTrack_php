<?php
class Data{
    private int $idData;
    private string $startTime;
    private string $duration;
    private float $distance;
    private int $cardiacFreqMin;
    private int $cardiacFreqAvg;
    private int $cardiacFreqMax;
    private float $longitude;
    private float $latitude;
    private int $altitude;
    private int $idAct;

    public function  __construct() { }
    public function init($id, $start, $d, $dist, $cFrqMin, $cFrqAvg, $cFrqMax, $long, $lat, $alt, $idA){
        $this->idData = $id;
        $this->startTime = $start;
        $this->duration = $d;
        $this->distance = $dist;
        $this->cardiacFreqMin = $cFrqMin;
        $this->cardiacFreqAvg = $cFrqAvg;
        $this->cardiacFreqMax = $cFrqMax;
        $this->longitude = $long;
        $this->latitude = $lat;
        $this->altitude = $alt;
        $this->idAct = $idA;
    }

    public function getIdData(): int { return $this->idData; }
    public function getStartTime(): string { return $this->startTime; }
    public function getDuration(): string { return $this->duration; }
    public function getDistance(): float { return $this->distance; }
    public function getCardiacFreqMin(): int { return $this->cardiacFreqMin; }
    public function getCardiacFreqAvg(): int { return $this->cardiacFreqAvg; }
    public function getCardiacFreqMax(): int { return $this->cardiacFreqMax; }
    public function getLongitude(): float { return $this->longitude; }
    public function getLatitude(): float { return $this->latitude; }
    public function getAltitude(): int { return $this->altitude; }
    public function getIdAct(): int { return $this->idAct; }

    public function  __toString(): string { return $this->idData. " ". $this->startTime. " ". 
                                            $this->duration. " ". $this->distance. " ".
                                            $this->cardiacFreqMin. " ". $this->cardiacFreqAvg. " ". 
                                            $this->cardiacFreqMax. " ". $this->longitude. " ".
                                            $this->latitude. " ". $this->altitude. " ". 
                                            $this->idAct; }
}
?>