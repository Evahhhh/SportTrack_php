<?php
class Activities{
    private int $idAct;
    private string $description;
    private string $date; 
    private string $startTime;
    private string $duration;
    private float $distance;        //en km
    private int $cardiacFreqMin;
    private int $cardiacFreqAvg;
    private int $cardiacFreqMax;
    private int $idUser;

    public function  __construct() { }
    public function init($id, $desc, $date, $start, $dur, $dist, $cFrqMin, $cFrqAvg, $cFrqMax, $idU){
        $this->idAct = $id;
        $this->description = $desc; 
        $this->date = $date;
        $this->startTime = $start;
        $this->duration = $dur;
        $this->distance = $dist;
        $this->cardiacFreqMin = $cFrqMin;
        $this->cardiacFreqAvg = $cFrqAvg;
        $this->cardiacFreqMax = $cFrqMax;
        $this->idUser = $idU;
    }

    public function setId($id){
        $this->idAct = $id;
    }

    public function getIdAct(): int { return $this->idAct; }
    public function getDescription(): string { return $this->description; }
    public function getDate(): string { return $this->date; }
    public function getStartTime():string {return $this->startTime; }
    public function getDuration(): string { return $this->duration; }
    public function getDistance(): float { return $this->distance; }
    public function getCardiacFreqMin(): int { return $this->cardiacFreqMin; }
    public function getCardiacFreqAvg(): int { return $this->cardiacFreqAvg; }
    public function getCardiacFreqMax(): int { return $this->cardiacFreqMax; }
    public function getIdUser(): int { return $this->idUser; }

    public function  __toString(): string { return $this->idAct. " ". $this->description. " ". 
                                            $this->date. " ". $this->startTime. " ". 
                                            $this->duration. " ". $this->distance. " ".
                                            $this->cardiacFreqMin. " ". $this->cardiacFreqAvg. " ". 
                                            $this->cardiacFreqMax. " ". $this->idUser; }
}
?>