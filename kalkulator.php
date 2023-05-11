<?php
    class Kalkulator{
        private $rozmiar;
        private $rozmiar_zamiennika;

        private $procent_zgodnosci;
        private $czyZgodne;

        function __construct(){ 
            $this-> rozmiar = new Rozmiar();
            $this->rozmiar_zamiennika = new Rozmiar();
        }

        function setRozmiar($s, $p, $sr){
            $this->rozmiar->setRozmiar($s, $p, $sr);
        }

        function setRozmiarZamiennik($s, $p, $sr){
            $this->rozmiar_zamiennika->setRozmiar($s, $p, $sr);
        }

        function getRozmiarSrednica(){
            $temp = $this->rozmiar->getSrednicaOpony();
            if($temp- floor($temp) >= 0.5) {
                $temp = ceil($temp);
            } else {
                $temp = floor($temp);
            }
            return $temp;
        }

        function getRozmiarZamiennikaSrednica(){
            $temp = $this->rozmiar_zamiennika->getSrednicaOpony();
            if($temp- floor($temp) >= 0.5) {
                $temp = ceil($temp);
            } else {
                $temp = floor($temp);
            }
            return $temp;
        }

        function czyMoznaZastosowacZamiennik(){ 
            $this->rozmiar->obliczSredniceOpony();
            $this->rozmiar_zamiennika->obliczSredniceOpony();

            $this->procent_zgodnosci = (1 - $this->rozmiar_zamiennika->getSrednicaOpony() / $this->rozmiar->getSrednicaOpony()) * -1;
            if($this->rozmiar_zamiennika->getSrednicaOpony() >= $this->rozmiar->getSrednicaOpony() *0.98 && $this->rozmiar_zamiennika->getSrednicaOpony() <= $this->rozmiar->getSrednicaOpony() * 1.015){
                $this->czyZgodne = "TAK";
            } else {
                $this->czyZgodne = "NIE";
            }
        }

        function getProcentZgodnosci(){
            return number_format($this->procent_zgodnosci * 100, 2).'%';
        }

        function getZgodnosc(){
            return $this->czyZgodne;
        }
        

    }

    class Rozmiar{
        private $szerokosc;
        private $profil;
        private $srednica;

        private $srednica_opony;
        
        function setRozmiar($szerokosc, $profil, $srednica){
            $this->szerokosc = $szerokosc;
            $this->profil = $profil;
            $this->srednica = $srednica;
        }

        function obliczSredniceOpony(){
            if($this->szerokosc == null || $this->profil == null || $this->srednica == null){
                echo "wszystkie zmienne muszą być zainicjowane <br>";
                return;
            }
            $this->srednica_opony = ($this->szerokosc * $this->profil / 100 * 2) * 1.04 + 25.4 * $this->srednica;
        }

        function getSrednicaOpony(){
            return $this->srednica_opony;
        }
    }

    
?>