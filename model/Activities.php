<?php
class Activities{
    private int $idAct;
    private string $description;
    private string $date;
    private int $idUser;

    public function  __construct() { }
    public function init($id, $desc, $d, $idU){
        $this->idAct = $id;
        $this->description = $desc;
        $this->date = $d;
        $this->idUser = $idU;
    }

    public function getIdAct(): int { return $this->idAct; }
    public function getDescription(): string { return $this->description; }
    public function getDate(): string { return $this->date; }
    public function getIdUser(): int { return $this->idUser; }

    public function  __toString(): string { return $this->idAct. " ". $this->description. " ". 
                                            $this->date. " ". $this->idUser; }
}
?>