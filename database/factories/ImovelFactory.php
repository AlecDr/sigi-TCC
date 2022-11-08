<?php

use App\User;
use App\Imovel;
use Faker\Generator as Faker;

$factory->define(Imovel::class, function (Faker $faker) {
    $mapCenterLatitude = config('leaflet.map_center_latitude');
    $mapCenterLongitude = config('leaflet.map_center_longitude');
    $minLatitude = $mapCenterLatitude - 0.05;
    $maxLatitude = $mapCenterLatitude + 0.05;
    $minLongitude = $mapCenterLongitude - 0.07;
    $maxLongitude = $mapCenterLongitude + 0.07;

    return [
        'seq'       => ucwords($faker->words(2, true)),
        'setor'     => $faker->setor,
        'quadra'    => $faker->quadra,
        'lote'      => $faker->lote,
        'owner_id'  => $faker->owner_id,
        'latitude'  => $faker->latitude($minLatitude, $maxLatitude),
        'longitude' => $faker->longitude($minLongitude, $maxLongitude),
        'creator_id'=> function () {
            return factory(User::class)->create()->id;
        },
    ];
});

