<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Repository\PokemonRepository;
use App\Http\Resources\PokemonCollection;
use App\Http\Resources\PokemonResource;
use App\Http\Response\BaseResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PokemonController extends Controller
{
    public function index()
    {
        $data = PokemonRepository::get();
        $response = new PokemonCollection($data);

        return BaseResponses::status(200, $response, 'Success');
    }

    public function catch(Request $request)
    {
        $probability = rand(0, 1);
        $validator = Validator::make($request->all(), [
            'pokemon_id' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return BaseResponses::status(417, null, $validator->errors());
        }

        try {
            $probability = $probability == 1 ? true : false;

            if ($probability) {
                $data = PokemonRepository::create($request);
                $response = new PokemonResource($data);

                return BaseResponses::status(200, $response, 'Pokemon Catched');
            } else {
                return BaseResponses::status(500, null, 'Pokemon Catched Failed');
            }
        } catch (\Throwable $th) {
            return BaseResponses::status(500, $th->getMessage());
        }
    }

    public function rename(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pokemon_id' => 'required|exists:pokemon,pokemon_id',
        ]);

        if ($validator->fails()) {
            return BaseResponses::status(417, null, $validator->errors());
        }

        try {
            $data = PokemonRepository::update($request);
            $response = new PokemonResource($data);

            return BaseResponses::status(200, $response, 'Pokemon Renamed');
        } catch (\Throwable $th) {
            return BaseResponses::status(500, $th->getMessage());
        }
    }

    public function release(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pokemon_id' => 'required|exists:pokemon,pokemon_id',
        ]);

        if ($validator->fails()) {
            return BaseResponses::status(417, null, $validator->errors());
        }

        try {
            $ran = rand(0, 9);
            if (Helpers::prima($ran)) {
                $data = PokemonRepository::delete($request);
                if ($data) {
                    return BaseResponses::status(200, null, 'Pokemon Released');
                } else {
                    return BaseResponses::status(500, null, 'Pokemon Not Found');
                }
            } else {
                return BaseResponses::status(500, null, 'Pokemon Release Failed');
            }
        } catch (\Throwable $th) {
            return BaseResponses::status(500, $th->getMessage());
        }
    }
}
