<?php

namespace App\Http\Controllers;

use App\Models\TypeUser;
use Illuminate\Http\Request;
use App\Models\User;
// use App\Http\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserStatueNofication;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthentificationController extends Controller
{

    public function Viewlogin(){
        return view('auth.login');
    }



    // public function login(Request $request){

    //     $request->validate([
    //         'email' => 'required',
    //         'password'=>'required'
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if(!$user || !Hash::check($request->password, $user->password)){

            
    //         return response([
    //             'message' => 'the provide credentials are not correct'
    //         ]);
    //     }

    //     // $token = $user->createToken('auth_token')->accessToken;

    //         // return response([
    //         //     // 'token'=>$token,
    //         //     'message' => 'the provide credentials are correct'
    //         // ]);
    //         redirect()->route('operation')->with('success', 'the provide credentials are correct!');
    // }


    public function login(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            // L'authentification a réussi...
            redirect()->route('operation')->with('success', 'the provide credentials are correct!');;
        }else{
            return back()->withErrors([
                'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
            ]);
        }

    }

    public function logout(Request $request){

        $request->user()->token()->revoke();
        return response([
            'message' => 'logged out succefully'
        ]);
    }

    public function Viewregister(){

        return view('auth.register');
    }
     public function register(Request $request){

        try{


                $request->validate([
                    'name' => 'required|max:255',
                    'email' => 'required|email|unique:users',
                    'password'=>'required|min:6',
                    'userSurname'=>'required',
                    'adrUser'=>'required',
                    'secretCode'=>'required',
                    'accountNumber'=>'required',
                    // 'accountDateCreation'=>'required',
                    // 'ammount'=>'required',
                    'accountStatue'=>'required',
                ]);

                    // recuperer l'image
                    $getImage = time().".".$request->file('profilePicture');

                    $user = new User();
                    $user->name = $request->name;
                    $user->userSurname = $request->userSurname;
                    $user->email = $request->email;
                    $user->password = Hash::make($request->password);
                    $user->adrUser = $request->adrUser;
                    $user->secretCode = $request->secretCode;
                    $user->accountNumber = $request->accountNumber;
                    $user->accountDateCreation = now();
                    $user->ammount = 0;
                    $user->accountStatue = $request->accountStatue;
                    $user->profilePicture = $getImage;
                    // $type_user_id = TypeUser::find($request->TypeUser_id);

                    // save image in the storage
                    Storage::disk('local')->put('pictureimage',$getImage);
                    // $user->profilePicture = $request->file('picture')->storeAs('localpicture',$user->name);

                    $user->save();
                    // $type_user_id->user()->save($user);

                    // $token = $user->createToken('auth_token')->accessToken;

            if($user->save()){

                // creation des variables pour personnaliser notre notification
                $post = ['title' => 'recorded perfectly!!!!!!!'];
                // envoyer un mail lorsque le user es enregistrer
                $user->notify(new UserStatueNofication($user,$post));

                 // enregistrement des log de transaction dans la BD
                 Activity::all()->last();

                return response()->json([
                    'code'=>200,
                    'user'=>$user,
                    'message'=>'user Enregistrer',
                    // 'token'=>$token,

                    // $user->notify(new UserStatueNofication ($user))
                ]);
            }else{
                return response()->json([
                    'code'=>500,
                    'message'=> 'user pas enregister',
                ]);
            }

        }catch(ValidationException $e){

            return response()->json([
                'code'=>404,
                'message'=> $e->getMessage(),
                'body'=>$e->errors()]);
        }


    }

    public function updatePassword(Request $request){

        $data = $request->validate([
            'token' => 'required',//recuperation de l'ancien mots de passe
            'password' => 'required|min:8',//new password
            'c_password' => 'required|same:password',//verify the same new password
        ]);

        $user = User::where('forgot_password_token', $data['token'])->first();
        $user = User::where('email', $request->email)->first();
        if (! $user) {
            return response()->json(['message' => 'Lien de réinitialisation de mot de passe invalide'], 401);
        }

        $user->password = Hash::make($data['password']);
        $user->forgot_password_token = null;
        $user->save();

        return response()->json(['message' => 'Mot de passe mis à jour avec succès'], 200);
    }

//     public function forgotPassword(Request $request)
// {
//     $data = $request->validate([
//         'email' => 'required|email',
//     ]);

//     $user = User::where('email', $data['email'])->first();

//     if (! $user) {
//         return response()->json(['message' => 'Utilisateur non trouvé'], 404);
//     }

//     $token = Str::random(60);
//     $user->forgot_password_token = $token;
//     $user->save();

//     Mail::send('emails.forgot_password', [
//         'token' => $token,
//     ], function ($message) use ($user) {
//         $message->to($user->email);
//     });

//     return response()->json(['message' => 'Lien de réinitialisation de mot de passe envoyé'], 200);
// }

}
