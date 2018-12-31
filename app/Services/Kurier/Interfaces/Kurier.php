<?php
/**
 * Created by PhpStorm.
 * User: Artur
 * Date: 02.12.2018
 * Time: 21:39
 */

namespace App\Services\Kurier\Interfaces;


interface Kurier
{
    public function pobierzKurierow();

    public function makeOrder($id, $receptionPlace, $deliverPlace);
}