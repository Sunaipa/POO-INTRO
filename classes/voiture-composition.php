<?php

    //Créé une classe voiture avec deux propriétés x et y
    //Le contructeur permet de définir les valeurs de x et y
    //on a des fonctions getters and setters

class Movable {
    //ATTRIBUTS
    protected int $x;
    protected int $y;
    protected array $orientation= [
        ["name" => "Nord", "axis" => "y", "sign" => "+"],
        ["name" => "Est", "axis" => "x", "sign" => "+"],
        ["name" => "Sud", "axis" => "y", "sign" => "-"],
        ["name" => "Ouest", "axis" => "x", "sign" => "-"]
    ];
    protected $currentOrientationIndex = 0;

    

    //FONCTIONS
    private function checkCoordinate(int $value){
        if($value < 0){
            throw new InvalidArgumentException("Les coordonées ne peuvent etre négative");
        }
    }
    public function turn(){
        $isLastIndex = $this->currentOrientationIndex == count($this->orientation)-1;

        if ($isLastIndex) {
            $this->currentOrientationIndex = 0;
        } else {
            $this->currentOrientationIndex ++;
        }
    }
    public function move(int $distance /** ,string $direction*/){

        $axis = $this->orientation[$this->currentOrientationIndex]["axis"];
        $sign = $this->orientation[$this->currentOrientationIndex]["sign"];

            if ($sign === '-') {
                $distance = -$distance;
            }
      
            if ($this->$axis < abs($distance)) {
               $this->$axis = 0;
            }else{
                $this->$axis += $distance;
            }


        // //LEFT
        // if (str_contains($direction, 'L')) {
        //     $this->x += $distance * -1;
        //     var_dump("LEFT:{$distance}");
        // }
        // //RIGHT
        // if (str_contains($direction, 'R')) {
        //     $this->x += $distance;
        //     var_dump("RIGHT:{$distance}");
        // }
        // //DOWN
        // if (str_contains($direction, 'D')) {
        //     $this->y += $distance * -1;
        //     var_dump("DOWN:{$distance}");
        // }
        // //UP
        // if (str_contains($direction, 'U')) {
        //     $this->y += $distance;
        //     var_dump("UP:{$distance}");
        // }
    }

    //GETTERS & SETTERS
    public function getX():int{
        return $this->x;
    }
    public function setX(int $x){
        $this->checkCoordinate($x);
        $this->x = $x;
    }

    public function getY ():int{
        return $this->y;
    }
    public function setY(int $y){
        $this->checkCoordinate($y);
        $this->y = $y;
    }

    public function getOrientationName() {
        return $this->orientation[$this->currentOrientationIndex]["name"];
    }

}

class Voiture {

    private Movable $movable;

    //CONSTRUCTOR & co
    public function __construct(int $x,int $y){
        $this->movable = new Movable();
        $this->movable->setX($x);
        $this->movable->setY($y);
    }
    
    public function __toString(){
        return "x ={$this->movable->getX}, y={$this->movable->getY}, orientation : {$this->movable->getOrientationName()}";
    }

    // public function __destruct(){
    //     var_dump("la voiture est détruite");
    // }
}

class Bateau extends MovableStuff {

    public function __construct(int $x,int $y){
        $this->setX($x);
        $this->setY($y);
    }

    public function __toString(){
        return "Je vogue sur les flots et ma position est : x ={$this->x}, y={$this->y}, orientation : {$this->orientation[$this->currentOrientationIndex]["name"]}";
    }
}