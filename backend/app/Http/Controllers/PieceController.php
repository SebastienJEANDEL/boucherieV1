<?php

namespace App\Http\Controllers;

use App\Models\Piece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PieceController extends Controller
{
    /**
     * /pieces
     * GET
     */
    public function list()
    {
        // On récupère tous les jeux
        $items = Piece::all();
        // On renvoie la liste (même si elle est vide) en répondant en 200
        return response()->json($items, 200);
    }

    /**
     * /pieces
     * POST
     */
    public function create(Request $request)
    {

    }

    /**
     * /pieces/[id]
     * GET
     */
    public function read($id)
    {
        // Get item or send 404 response if not
        $item = Piece::find($id);

        // Si on a un résultat
        if (!empty($item)) {

            // Return JSON of this list
            return response()->json($item, 200);
        } else { // Sinon
            // HTTP status code 404 Not Found
            return response('', 404);
        }
    }


}
