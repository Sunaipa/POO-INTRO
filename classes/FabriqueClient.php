<?php

class FabriqueClient {

    public static function getClient(int $numClient) {
        $clientList = json_decode(
            file_get_contents("data/clients.json"),
        );

        $clientData = array_filter($clientList, function($item) use ($numClient){
            return $item->numClient === $numClient;
        });

        $clientData = array_values($clientData);


        if (count($clientData) > 0) {
            $client = new Client($clientData[0]->numClient, $clientData[0]->nom);
            return $client;
        } else {
            throw new Exception("Impossible de trouver le client");
        }
    }
};