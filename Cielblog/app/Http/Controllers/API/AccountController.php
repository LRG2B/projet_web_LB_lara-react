<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
class AccountController extends Controller
{

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

        return response()->json([
            'name' => $account->name,
            'mail' => $account->mail
            ]);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {     
        $account->delete();
        return response()->json([
            "message" => "Compte supprimer"
        ]);
    }

    
}