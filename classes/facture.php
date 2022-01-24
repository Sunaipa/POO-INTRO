<?php
class Facture
{
    private int $numFacture;
    private int $montant;
    private DateTime $date;
    private Client $client;

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
    public function getNumFacture()
    {
        return $this->numFacture;
    }
    /**
     * Set the value of numFacture
     *
     * @return  self
     */
    public function setNumFacture($numFacture)
    {
        $this->numFacture = $numFacture;

        return $this;
    }

    /**
     * Get the value of montant
     */
    public function getMontant()
    {
        return $this->montant;
    }
    /**
     * Set the value of montant
     *
     * @return  self
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }
}
