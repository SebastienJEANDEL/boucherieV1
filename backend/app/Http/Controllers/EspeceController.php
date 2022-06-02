<?php

namespace App\Http\Controllers;

use App\Models\Espece;
use Illuminate\Http\Request;

class EspeceController extends Controller
{
    /**
     * /especes
     * GET
     */
    public function list()
    {
        // Get all items
        $list = Espece::all();

        // Return JSON of this list
        return response()->json($list, 200);
    }
    public function read($id)
    {
        // Get item or send 404 response if not
        $item = Espece::find($id);

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
