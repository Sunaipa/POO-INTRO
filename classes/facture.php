<?php
class Facture
{
    const STATUT_EN_COURS = 1;
    const STATUT_PAYEE = 2;
    const STATUT_ANNULLE = 3;

    public static $tva = .20;
    private int $numFacture;
    private int $montant;
    private DateTime $date;
    private Client $client;
    private int $statut = 0;

    public function __construct(int $numFacture, int $montant, Datetime $date, Client $client)
    {
        $this->numFacture = $numFacture;
        $this->montant = $montant;
        $this->date = $date;
        $this->client = $client;
    }


    //GETTERS & SETTERS
    /**
     * Get the value of numFacture
     */
    public function getNumFacture(){
        return $this->numFacture;
    }
    /**
     * Set the value of numFacture
     *
     * @return  self
     */
    public function setNumFacture($numFacture){
        $this->numFacture = $numFacture;

        return $this;
    }

    /**
     * Get the value of montant
     */
    public function getMontant(){
        return $this->montant;
    }

    public function getMontantTTC() {
        return $this->montant * (1 + self::$tva);
    }

    /**
     * Set the value of montant
     *
     * @return  self
     */
    public function setMontant($montant){
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate(){
        return $this->date;
    }
    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date){
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of client
     */ 
    public function getClient(){
        return $this->client;
    }
    /**
     * Set the value of client
     *
     * @return  self
     */ 
    public function setClient($client){
        $this->client = $client;

        return $this;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }
    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }
}
