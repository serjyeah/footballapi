<?php
/**
 * Created by PhpStorm.
 * User: serj
 * Date: 8/4/18
 * Time: 1:51 PM
 */

namespace App\Services;


class TeamNormalizer extends BasicNormalizer implements NormalizerInterface
{
    public function normalize($object)
    {
        return [

            'id' => $object->getId(),
            'name' => $object->getName(),
            'stripx' => $object->getStrip()
        ];

    }
}