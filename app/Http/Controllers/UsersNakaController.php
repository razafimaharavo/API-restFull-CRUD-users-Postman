<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersNaka;

class UsersNakaController extends Controller
{
    public function get(){
        try {
            $data = UsersNaka::all();
            return response()->json($data, 200);
        } catch (\Throwable $t) {
            return response()->json(['error' => $t->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        //dd('tonga eto koa zah eee');
        //Validation des données
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|unique:users_naka,Email',
            'Password' => 'required|string|min:8',
        ]);
        try {
            // Hachage du mot de passe
            $validated['Password'] = bcrypt($validated['Password']); //Ou bien mot de passe sont crypter
            // Création de l'utilisateur
            $user = UsersNaka::create($validated);
            // Réponse JSON
            return response()->json($user, 201); // Utilisez le code de statut 201 pour indiquer que la ressource a été créée
        } catch (\Throwable $t) {
            // En cas d'erreur, renvoyer un message d'erreur avec un code de statut 500
            return response()->json(['error' => $t->getMessage()], 500);
        }
    }


    public function getById($id){
        try {
            $user = UsersNaka::findOrFail($id);
            return response()->json($user, 200);
        } catch (\Throwable $t) {
            return response()->json(['error' => $t->getMessage()], 500);
        }
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'Name' => 'sometimes|required|string|max:255',
            'Email' => 'sometimes|required|email|unique:users_naka,Email,'.$id,
            'Password' => 'sometimes|required|string|min:8',
        ]);

        try {
            $user = UsersNaka::findOrFail($id);
            if (isset($validated['Password'])) {
                $validated['Password'] = bcrypt($validated['Password']);
            }
            $user->update($validated);
            return response()->json($user, 200);
        } catch (\Throwable $t) {
            return response()->json(['error' => $t->getMessage()], 500);
        }
    }

    public function delete($id){
        try {
            $user = UsersNaka::findOrFail($id);
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (\Throwable $t) {
            return response()->json(['error' => $t->getMessage()], 500);
        }
    }
}
