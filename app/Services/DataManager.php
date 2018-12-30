<?php

namespace App\Services;

use App\Services\Kwiaciarnia as KwiaciarniaAPI;
/**
 * Artur Pilch <artur.pilch12@gmail.com>
 */
class DataManager
{
    public function getRzeszowFlowers()
    {
        $rzeszow = new KwiaciarniaAPI\Rzeszow();
        $rzeszowData = $rzeszow->pobierzDane();

        return $this->getFlowersWithPhoto($rzeszowData, "Rzeszow");
    }

    public function getKrakowFlowers()
    {
        $rzeszow = new KwiaciarniaAPI\Krakow();
        $rzeszowData = $rzeszow->pobierzDane();

        return $this->getFlowersWithPhoto($rzeszowData, "Krakow");
    }

    public function getCouriers()
    {
        $couriers = new Kurier\GlobalKurier();

        return $couriers->pobierzKurierow();
    }


    private function getFlowersWithPhoto($flowers, $city)
    {
        $out = [];

        foreach ($flowers as $flowerDetails)
        {
            $path = '/images/flowers/%s.jpg';
            $flower = sprintf(public_path().$path, $flowerDetails->name);

            if(!file_exists($flower))
            {
                continue;
            }

            if($this->isFlowerExist($flowerDetails->name, $out))
            {
                continue;
            }

            $flowerDetails->flowerImage = asset(sprintf($path, $flowerDetails->name));
            $flowerDetails->name = ucfirst($flowerDetails->name);
            $flowerDetails->city = $city;
            $flowerDetails->serialized = base64_encode(\GuzzleHttp\json_encode($flowerDetails));
            $out[] = $flowerDetails;

        }

        return $out;
    }



    private function isFlowerExist($flower, $flowers){

        foreach ($flowers as $ex){
            if($ex->name == ucfirst($flower))
                return true;
        }
        return false;

    }

}