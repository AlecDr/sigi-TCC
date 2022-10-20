<?php

namespace App\Http\Controllers\Api;

use App\Imovel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Imovel as ImovelResource;

class ImovelController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $imovels = Imovel::all();

        $geoJSONdata = $imovels->map(function ($imovel) {
            return [
                'type'       => 'Feature',
                'properties' => new ImovelResource($imovel),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $imovel->longitude,
                        $imovel->latitude,
                    ],
                ],
            ];
        });

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }
}
