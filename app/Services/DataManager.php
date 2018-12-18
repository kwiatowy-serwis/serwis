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

        $out = [];
        foreach ($rzeszowData as $flowerDetails)
        {
            $path = '/images/flowers/%s.jpg';
            $flower = sprintf(public_path().$path, $flowerDetails->name);

            if(!file_exists($flower))
            {
                continue;
            }

            if($this->isFlowerExist($flowerDetails->name, $out)){
                continue;
            }
            $flowerDetails->flowerImage = asset(sprintf($path, $flowerDetails->name));
            $flowerDetails->name = ucfirst($flowerDetails->name);
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