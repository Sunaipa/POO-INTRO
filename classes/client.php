<?php


class client {
    //ATTRIBUTS
    private int $numClient;
    private string $nom;
    private array $factures = [];


    //FONCTIONS
    public function __construct(int $numClient, string $nom){
        $this->numClient = $numClient;
        $this->nom = $nom;
    }

    public function addFacture (Facture $facture){
        array_push($this->factures, $facture);
        // ou $this->factures[] = $facture;
        return $this;
    }

    public function getChiffreAffaire(){
        $total = 0;
        foreach($this->factures as $facture) {
            if ($facture->getStatut() === Facture::STATUT_PAYEE) {
                $total += $facture->getMontant();
            }
        }
        return $total;
    }

    //GETTERS & SETTERS
    /**
     * Get the value of factureList
     */ 
    public function getFactures()
    {
        return $this->factures;
    }
    /**
     * Set the value of factureList
     *
     * @return  self
     */ 
    public function setFactures($factureList)
    {
        $this->factureList = $factureList;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of numClient
     */ 
    public function getNumClient()
    {
        return $this->numClient;
    }
    /**
     * Set the value of numClient
     *
     * @return  self
     */ 
    public function setNumClient($numClient)
    {
        $this->numClient = $numClient;

        return $this;
    }
}