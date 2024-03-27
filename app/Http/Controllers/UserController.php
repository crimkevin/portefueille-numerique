<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\UserStatueNofication;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Models\Activity;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alluser = User::all();

        if(count($alluser)>0){
            return  response()->json([
                'code'=>200,
                'user'=>$alluser,
                'message'=>'listes des user prensent dans la bd'
            ]);
         }else{
             return response()->json([
                 'code'=>500,
                 'message'=> 'aucun user trouver',
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
    // public function store(Request $request)

    // {
    //     //recuperer le role de l'user authentifier
    //     // $role = User::auth()->typeusers()
    //     // ->where('role', 'admin')
    //     // ->first();

    //     // si $role est vrai il poura creer les autres utulisateurs
    //     try{


    //             $request->validate([
    //                 'name' => 'required|max:255',
    //                 'email' => 'required|email|unique:users',
    //                 'password'=>'required|min:6',
    //                 'userSurname'=>'required',
    //                 'adrUser'=>'required',
    //                 'secretCode'=>'required',
    //                 'accountNumber'=>'required',
    //                 'accountDateCreation'=>'required',
    //                 'ammount'=>'required',
    //                 'accountStatue'=>'required',
    //             ]);

    //                 // recuperer l'image
    //                 $getImage = time().".".$request->file('profilePicture');

    //                 $user = new User();
    //                 $user->name = $request->name;
    //                 $user->userSurname = $request->userSurname;
    //                 $user->email = $request->email;
    //                 $user->password = Hash::make($request->password);
    //                 $user->adrUser = $request->adrUser;
    //                 $user->secretCode = $request->secretCode;
    //                 $user->accountNumber = $request->accountNumber;
    //                 $user->accountDateCreation = $request->accountDateCreation;
    //                 $user->ammount = $request->ammount;
    //                 $user->accountStatue = $request->accountStatue;
    //                 $user->profilePicture = $getImage;

    //                 // save image in the storage
    //                 Storage::disk('local')->put('pictureimage',$getImage);
    //                 // $user->profilePicture = $request->file('picture')->storeAs('localpicture',$user->name);

    //                 $user->save();

    //                 $token = $user->createToken('auth_token')->accessToken;

    //         if($user->save()){

    //             // creation des variables pour personnaliser notre notification
    //             $post = ['title' => 'Register Successfully!!!!!!!'];
    //             // envoyer un mail lorsque le user es enregistrer
    //             $user->notify(new UserStatueNofication($user,$post));

    //              // enregistrement des log de transaction dans la BD
    //              Activity::all()->last();

    //             return response()->json([
    //                 'code'=>200,
    //                 'user'=>$user,
    //                 'message'=>'user Enregistrer',
    //                 'token'=>$token,

    //                 // $user->notify(new UserStatueNofication ($user))
    //             ]);
    //         }else{
    //             return response()->json([
    //                 'code'=>500,
    //                 'message'=> 'user pas enregister',
    //             ]);
    //         }

    //     }catch(ValidationException $e){
    //         // throw'vous n\'avez pas l\'autorisation nessecaire pour effectuer cette operation';
    //         return response()->json([
    //             'code'=>404,
    //             'message'=> $e->getMessage(),
    //             'body'=>$e->errors()]);
    //     }


    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $allTransaction = Transaction::where('user_id', $id)->get();
        return response()->json([
            'message '=>'affichage de toutes les transaction de cet user ',
            'alltransaction'=> $allTransaction,
            'code'=> 200
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id_user = User::where('id','=',$id);

        if($id_user){
            return response()->json(
                [
                    'id_user'=>$id_user,
                    'message'=>'liste de tout les users',
                    'code' => 200
                ]
                );
        }else{
            return response()->json([
                'code'=>302,
                'message' => 'on n\'arrive pas a avoir acces a la liste des users '
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update([

            'name' => $request->name,
            'userSurname' => $request->userSurname,
             'email'=> $request->email,
            'password' => $request->password,
             'adrUser' => $request->adrUser,
             'secretCode' => $request->secretCode,
             'accountNumber' => $request->accountNumber,
             'accountDateCreation' => $request->accountDateCreation,
             'ammount' => $request->ammount,
             'accountStatue' => $request->accountStatue,
             'profilePicture' => $request->profilePicture,

         ]);

         if($user->update()){
            return response()->json([
                'operator'=>$user,
                'code' => 200,
                'message'=>'liste des users modifiers'
            ]);
         }else{
            return response()->json([
                'code'=>302,
                'messages'=>'mise a jour n\'a pas pue etre effectuer'
            ]);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            if($user->delete()){
                 return response()->json([
                    'message'=>'supression efectuer',
                 ], 200);
            }else{
                return response()->json('echec de suprpresion');
            }
        }catch(ValidationException $e){

            return response()->json([
                'code'=>404,
                'message'=> $e->getMessage(),
                'body'=>$e->errors()
            ]);
        }


    }

    // affichage des transaction de la semaine de ce user
    public function weekTransaction($id){
        $week_transaction = Transaction::where("user_id",$id)
        ->whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->get();
        return response()->json([
            'message'=> 'liste des transaction du weekend',
            'week_transaction '=>$week_transaction ,
            'code'=>200
        ]);
    }
    // affichage des transaction du mois de ce user
    public function mounthTransaction($id){
        $mounth_transactions = Transaction::where("user_id",$id)
          ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
          ->get();
          return response()->json([
            'message'=> 'liste des transaction du mois',
            'mounth_transactions '=>$mounth_transactions ,
            'code'=>200
        ]);
    }

}
