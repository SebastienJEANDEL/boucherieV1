<?php

namespace App\Http\Controllers;

use App\Models\Videogame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideogameController extends Controller
{
    /**
     * /videogames
     * GET
     */
    public function list()
    {
        // On récupère tous les jeux
        $items = Videogame::all();
        // On renvoie la liste (même si elle est vide) en répondant en 200
        return response()->json($items, 200);
    }

    /**
     * /videogames
     * POST
     */
    public function create(Request $request)
    {
        // On valide les données saisies
        $validator = Validator::make($request->input(), [
            'name' => 'required',
            'editor' => 'required'
        ]);

        // Si les données ne sont pas valides
        if ($validator->fails()) {
            // On renvoie les messages d'erreur avec un statut HTTP 422
            return response()->json($validator->errors(), 422);
        }

        // Sinon, on crée le videogame...
        $videogame = new Videogame();
        
        // ...on récupère les données validées
        $input = $validator->validated();

        // ...on renseigne les attributs du videogame
        $videogame->name = $input['name'];
        $videogame->editor = $input['editor'];

        // On enregistre le videogame en BDD
        if ($videogame->save()) {
            // Si l'enregistrement s'est bien passé on répond avec l'objet et un statut HTTP 201
            return response()->json($videogame, 201);
        } else {
            // Sinon on donne une réponse vide avec un statut HTTP 500
            return response(null, 500);
        }
    }

    /**
     * /videogames/[id]
     * GET
     */
    public function read($id)
    {
        // Get item or send 404 response if not
        $item = Videogame::find($id);

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
     * /videogames/[id]/reviews
     * GET
     */
    public function getReviews($id)
    {
        // Get item or send 404 response if not
        $item = Videogame::find($id);

        // Si on a un résultat
        if (!empty($item)) {
            // Retrieve all related Reviews (thanks to Relationships)
            $reviews = $item->reviews->load(['videogame', 'platform']);

            // Return JSON of this list
            return response()->json($reviews, 200);
        } else { // Sinon
            // HTTP status code 404 Not Found
            return response('', 404);
        }
    }
}
