<?php
/**
 * Created by PhpStorm.
 * User: serj
 * Date: 8/4/18
 * Time: 1:53 PM
 */

namespace App\Services;


class BasicNormalizer
{

    public function bulkNormalize(array $objects): array
    {
        $normalized = array_map(function ($object) {
            return $this->normalize($object);
        }, $objects);

        return $normalized;
    }


}