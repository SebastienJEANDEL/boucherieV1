<?php

namespace App\Http\Controllers;

use App\Models\Animal;


class AnimalController extends Controller
{
    /**
     * /animals
     * GET
     */
    public function list()
    {
        // Get all items
        $list = Animal::all();

        // Return JSON of this list
        return response()->json($list, 200);
    }
/**
     * /animals/[id]
     * GET
     */
    public function read($id)
    {
        // Get item or send 404 response if not
        $item = Animal::find($id);

        // Si on a un résultat
        if (!empty($item)) {

            // Return JSON of this list
            return response()->json($item, 200);
        } else { // Sinon
            // HTTP status code 404 Not Found
            return response('', 404);
        }
    }
     /**
     * /animals/[id]/pieces
     * GET
     */
    public function getPieces($id)
    {
        // Get item or send 404 response if not
        $item = Animal::find($id);

        // Si on a un résultat
        if (!empty($item)) {
            // Retrieve all related Reviews (thanks to Relationships)
            $pieces = $item->pieces->load(['animal']);

            // Return JSON of this list
            return response()->json($pieces, 200);
        } else { // Sinon
            // HTTP status code 404 Not Found
            return response('', 404);
        }
    }
}
