<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;
use App\Models\User;
use App\Http\Requests\StoreOperatorRequest;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alloperator = Operator::all()->load('user');

        if(count($alloperator)>0){
            return  response()->json([
                'code'=>200,
                'personnel'=>$alloperator,
                'message'=>'operator lists'
            ]);
         }else{
             return response()->json([
                 'code'=>404,
                 'message'=> 'no operators found',
                 'body'=>[]
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
    public function store(StoreOperatorRequest $request)
    {
        
        $operator = new Operator();
        $operator->nomOperator = $request->nomOperator;
        $user = User::find($request->user_id);

        $user->operators()->save($operator);

        if($operator->save()){

            return response()->json([
                'code'=>200,
                'operator'=>$operator,
                'message'=>'operator Save'
            ]);
        }else{
            return response()->json([
                'code'=>302,
                'message'=> 'operator not Save',
                'body'=>[]
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
        $id_operator = Operator::find($id)->load(['user']);

        if($id_operator){
            return response()->json(
                [
                    'id_operator'=>$id_operator,
                    'message'=>' operator list',
                    'code' => 200
                ]
                );
        }else{
            return response()->json([
                'code'=>302,
                'message' => 'operator list not found '
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOperatorRequest $request, string $id)
    {
        $operateur = Operator::findOrFail($id);
        $operateur->update([

            'ope' => $request->nomOperator,
             'user_id'=> $request->user_id,

         ]);

         if($operateur->update()){
            return response()->json([
                'operator'=>$operateur,
                'code' => 200,
                'message'=>'list of modified operators'
            ]);
         }else{
            return response()->json([
                'code'=>302,
                'messages'=>'update could not be performed'
            ]);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $operateur = Operator::findOrFail($id);
        $operateur->delete();

        if( $operateur->delete()){
            return response()->json([
                'code'=>'200',
                'message' =>'operator delete'
            ]);
        }else{
           return response()->json([
            'message' =>'operator has not been deleted',
           ]);
        }
    }
}
