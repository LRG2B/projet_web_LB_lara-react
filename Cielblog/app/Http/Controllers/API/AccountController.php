<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
class AccountController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (session_status() > 1)
            disconnect();
        $user = Account::where('mail', '=',$request->mail)->first(); //recup utilisateur corespondant dans la BD (le mail est unique)
        if ($user != Null) {
            if($user->password == $request->password) { //si le mot de passe correspont 
                $timeout = 300;
                ini_set( "session.gc_maxlifetime", $timeout ); //def durrée de vie de la session
                setcookie('PHPSESSID',session_id(), time() + $timeout,);
                session_start(); 
                $_SESSION['connect'] = true; //ajout booléen pour savoir le statut de connexion
                $_SESSION['account_id'] = $user->id; //stokage aussi de l'id pour verif les droit 
                $_SESSION['admin'] = $user->admin; //stokage aussi de l'id pour verif les droit 
                return response()->json([
                    "message" => "Bienvenue, déconnexion automatique dans .$timeout. secondes "
                ]);
            }
            
        }       
        else { //si le mail existe pas que le mot de passe correspont pas
            return response()->json([
                "message" => "Identifiants Introuvable"
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'mail' => 'required',
            'password' => 'required|min:8',
        ]);

        $account = Account::created([
            'name' => $request->name,
            'mail' => $request->mail,
            'password' => $request->password,
            'admin' => false
        ]);

        return response()->json($account, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        session_start();

        if (isset($_COOKIE['PHPSESSID']) && isset($_SESSION['account_id'])) {
            if ($_COOKIE['PHPSESSID'] == session_id()){

                if ($_SESSION['account_id'] == $account->id || $_SESSION['admin'])
                    return response()->json([
                        'name' => $account->name,
                        'mail' => $account->mail
                    ]);
                else
                    return response()->json([
                        "message" => "Vous n'avez pas l'autorisation pour accéder a ce contenu"
                    ]);
                }
        } else {
            return response()->json([
                "message" => "Il faut aller ce connecter"
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        session_start();

        if (isset($_COOKIE['PHPSESSID']) && isset($_SESSION['account_id'])) {
            if ($_COOKIE['PHPSESSID'] == session_id()){

                if ($_SESSION['account_id'] == $account->id || $_SESSION['admin']){
                    
                    $this->validate($request,[
                        'name' => 'required|max:100',
                        'mail' => 'required|mail',
                        'password' => 'required|min:8',
                    ]);

                    $account->update([
                        'name' => $request->name,
                        'mail' => $request->mail,
                        'password' => $request->password
                    ]);
                    return response()->json($account, 201);
                    
                } else
                    return response()->json([
                        "message" => "Vous n'avez pas l'autorisation pour accéder a ce contenu"
                    ]);
                }
        } else {
            return response()->json([
                "message" => "Il faut aller ce connecter"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {     
        session_start();

        if (isset($_COOKIE['PHPSESSID']) && isset($_SESSION['account_id'])) {
            if ($_COOKIE['PHPSESSID'] == session_id() || $_SESSION['admin']){

                if ($_SESSION['account_id'] == $account->id){
                    $account->delete();
                    return response()->json([
                        "message" => "Compte supprimer"
                    ]);
                } else
                    return response()->json([
                        "message" => "Vous n'avez pas l'autorisation pour accéder a ce contenu"
                    ]);
                }
        } else {
            return response()->json([
                "message" => "Il faut aller ce connecter"
            ]);
        }
    }


    public function logout()
    {
        if (session_status() > 1)
            disconnect();
        return response()->json([
                "message" => "deconnexion réussi"
        ]);
    }
}




function disconnect()
{
    session_destroy();
    reset_cookies();
}

function reset_cookies()
{
    if (isset($_COOKIE['PHPSESSID'])) {
        unset($_COOKIE['PHPSESSID']);
        setcookie('PHPSESSID', '', time() - 3600, '/');
    }
}
