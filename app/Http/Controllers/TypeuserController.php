<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeUser;
use App\Models\User;

class TypeuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alluser= TypeUser::all()->load('user');

        if(count($alluser)>0){
            return  response()->json([
                'code'=>200,
                'transaction'=>$alluser,
                'message'=>'listes des utilisateurs et leur roles '
            ]);
         }else{
             return response()->json([
                 'code'=>500,
                 'message'=> 'aucun utilisateurs trouve',
             ]);
         }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type =  new TypeUser();
        $type->role = $request->role;
        $user = User::find($request->user_id);

        $user->user()->save($type);

        if($user->user()->save($type)){
            return response()->json([
                'message'=>'type utulisateur enregistrer avec success'
            ]);
        }else{
            return response()->json([
                'message'=>'type utulisateur non enregistrer'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $type_user = TypeUser::find($id);
        $type_user->delete();
        if( $type_user->delete()){
            return response()->json([
                'message'=> 'type utulisateur supprimer avec success'
            ]);
        }else{
            return response()->json([
                'message'=>'echec de suppression du type utulisateur'
            ]);
        }
    }
}
