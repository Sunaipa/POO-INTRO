<?php

class FabriqueFacture {

    public static function getFacture(string $numFacture) {
        $factureList = json_decode(
            file_get_contents("data/factures.json"),
        );

        $factureData = array_filter($factureList, function($item) use ($numFacture){
            return $item->numFacture === $numFacture;
        });

        $factureData = array_values($factureData);
        if (count($factureData) > 0) {
            $client = FabriqueClient::getClient($factureData[0]->idClient);
            $facture = new Facture(
                $factureData[0]->numFacture,
                $factureData[0]->montant,
                new DateTime($factureData[0]->date),
                $client
            );
            $facture->setStatut($factureData[0]->statut);

            return $facture;
        } else {
            throw new Exception("Impossible de charger la facture");
        }
    }

    
    
    // public static function getFactureByIdClient($idClient) {
    //     $factureList = json_decode(
    //         file_get_contents("data/factures.json"),
    //     );

    //     $factureData[] = array_filter($factureList, function($item) use ($idClient){
    //         return $item->idClient === $idClient;
    //     });

    //     $factureData = array_values($factureData);


    //     if (count($factureData) > 0) {
    //         return $factureData;
    //     } else {
    //         throw new Exception("Le client n'a aucune facture associe");
    //     }

    // }
};