<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\depositeUserNotification;
use App\Notifications\transfertUserNotification;
use App\Notifications\withdrawUserNotification;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Client\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\Models\Activity;
use GuzzleHttp\Client;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $apiKey;
     protected $apiSecret;
     protected $apiUrl;

     public function __construct()
     {
         $this->apiKey = env('ORANGE_MONEY_API_KEY');
         $this->apiSecret = env('ORANGE_MONEY_API_SECRET');
         $this->apiUrl = 'https://cameroun.orange-money.com/grweb/';
     }

     public function showdeposite(){
        return view('deposite.index');
     }
     public function showwithdraw(){
        return view('whitdraw.index');
     }
     public function showtransfer(){
        return view('transfert.index');
     }


    public function index()
    {
        $alltransaction = Transaction::all()->load('user');

        if(count($alltransaction)>0){
            return  response()->json([
                'code'=>200,
                'transaction'=>$alltransaction,
                'message'=>'listes des transaction effectuer'
            ]);
         }else{
             return response()->json([
                 'code'=>500,
                 'message'=> 'aucun transaction trouve',
             ]);
         }
    }

     // operation de transfert
     public function transfer(StoreTransactionRequest $request)

     {
         try{

         // getuser *** ici je veut recuperer l'id du user qui vas faire le transfert
         $sender = User::find($request->user_id);
         $receiver = User::find($request->user_id);

         //get amount**** ici je veut recuperer le solde de la personne qui veut faire le transfert
         $sender_solde = $sender->ammount;

         // getaccount number***ici je veut recuperer le nmero de compte de la personne qui veut effectuer le transfert
         $sender_number = $sender->accountNumber;

             // 1er cdtion qui concerne l'id de celui qui fait le transfert
             if($sender == null ){
                 throw "impossible d'effectuer cette operation";
             }
             // 2eme cdtion sur le numero de compte de la personne qui effectue le transfert
             if($sender_number == null){

                 throw 'le compte avec le numero ' + $sender_number + 'est introuvable';
             }
             // si les 2 cdtion sont ok on effectue le transfert
             else{

                 $transaction = new Transaction();
                 $transaction->amountTransaction = $request->amountTransaction;
                 $transaction->statue = 'Transfer';
                 $transaction->dateTransaction = now();
                 $transaction->refTransaction = 'TRANSFER-'.time();
                 $transaction->PaymentMethod = $request->PaymentMethod;
                 $transaction->senderName = $sender->name;
                 $transaction->receiverName = $receiver->name;

                 if($sender_solde < $transaction->amountTransaction){
                     return response()->json([
                         'message'=>'transaction impossible to process because your balance is insufficient'
                     ]);
                 }else{

                    $new_solde_sender = $sender_solde -= $request->amountTransaction;
                    $new_solde_receiver = $receiver->ammount += $request->amountTransaction;
                    $sender->save();
                    $receiver->save();
                    $sender->transactions()->save($transaction);
                    $receiver->transactions()->save($transaction);

                     if($transaction->save()){

                         if($sender->save() && $receiver->save()){
                             $sender_post = ['title' => 'Your operation was a success!!!!!'];
                             // $sender->notify(new transfertUserNotification($sender,$sender_post));

                                   // gestion des notifications si la transaction reussi
                         $receiver_post = ['title' => ' Your account has been successfully credited!!!!!'];
                         // envoyer un mail lorsque le user es enregistrer
                         // $receiver->notify(new transfertUserNotification($receiver,$receiver_post));


                         //  enregistrement du log dans le fichier transaction.log
                        Log::channel("lispayTransactionTransfer")->info("transaction ". json_encode($sender->transactions()->save($transaction)));
                        Log::channel("lispayTransactionTransfer")->info("transaction ". json_encode($receiver->transactions()->save($transaction)));
                         }

                         return response()->json([

                             'code'=>200,
                             'transaction'=>$transaction,
                             'message'=>'Your operation was a success!',
                             'new_solde_sender' => $new_solde_sender,
                             'new_solde_receiver' => $new_solde_receiver
                         ]);
                         }else{
                             return response()->json([
                                 'code'=>500,
                                 'message'=> 'Your operation fail!',
                             ]);
                         }
                 }
             }
         }catch(ValidationException $e){
             return response()->json([
                 'code'=>404,
                 'message'=> $e->getMessage(),
                 'body'=>$e->errors()
             ]);
         }
     }

      // operation de crediter
    public function deposite(StoreTransactionRequest $request){


        $user = Auth::user()->id;
        // $user = User::find($request->user_id);
        $transaction = new Transaction();
        $transaction->amountTransaction = $request->amountTransaction;
        $transaction->dateTransaction = now();
        $transaction->receiverName = $user->name;
        $transaction->refTransaction = 'CREDIT-'.time();
        $transaction->PaymentMethod = $request->PaymentMethod;
        $transaction->statue = 'Credited';

        $amount = $user->ammount += $request->amountTransaction;
        $user->save();
        $user->transactions()->save($transaction);

        if($user->transactions()->save($transaction)){

             // gestion des notifications si la transaction reussi
             $post = ['title' => ' Your account has been successfully credited!!!!!'];
             // envoyer un mail lorsque le user es enregistrer
             $user->notify(new depositeUserNotification($user,$post));

            //  enregistrement du log dans le fichier transaction.log
            Log::channel("lispayTransactionDeposite")->info("transaction ". json_encode($user->transactions()->save($transaction)));


            // enregistrement des log de transaction dans la BD
             Activity::all()->last();



        // Envoyer la requête à l'API Orange Money
        $client = new Client();
        $response = $client->post($this->apiUrl . '/deposit', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'json' => $transaction,
        ]);

        // Traiter la réponse de l'API Orange Money
        $data = json_decode($response->getBody()->getContents(), true);

        // Gérer les réponses et les erreurs renvoyées par l'API Orange Money
        // Retourner une réponse appropriée à l'utilisateur
        }

        return response()->json([
            'code' => 200,
            'message' => 'Your account has been successfully credited!.',
            'solde' => $amount
        ]);

    }

     // methode debiter
     public function withdraw(StoreTransactionRequest $request, $id){
        try{

              $user = User::findOrFail($request->user_id);

          if($user == null){
              throw "impossible to perform this operation";
          }
          if($user->accountNumber == null){
              throw 'the account with the number' + $user->accountNumber + 'is not found';
          }
          else{
              $transaction = new Transaction();
              $transaction->amountTransaction = $request->amountTransaction;
              $transaction->dateTransaction = now();
              $transaction->receiverName = $user->name;//system
              $transaction->refTransaction = 'DEBIT-' .time();
              $transaction->PaymentMethod = $request->PaymentMethod;
              $transaction->statue = 'Debited';

              if($user->ammount < $transaction->amountTransaction ){
                  return response()->json([
                      'message' => 'Insufficient balance.',
                      // 'solde' => $amount
                  ], 400);
              }else{
                   $amount = $user->ammount -= $request->amountTransaction;

                   $user->save();
                   $user->transactions()->save($transaction);
              }
              if($transaction->save()){

                  // gestion des notifications si la transaction reussi
                  $post = ['title' => ' Your account has been successfully debited!!!!!'];
                  // envoyer un mail lorsque le user es enregistrer
                  $user->notify(new withdrawUserNotification($user,$post));


                  //  enregistrement du log dans le fichier transaction.log
                    Log::channel("lispayTransactionWithdraw")->info("transaction ". json_encode($user->transactions()->save($transaction)));

                  return response()->json([
                      'code'=>200,
                      'transaction'=>$transaction,
                      'message'=>'The account has been successfully debited.',
                      'solde' => $amount,
                  ]);
              }
            }
              }catch(ValidationException $e){

                  return response()->json([
                      'code'=>404,
                      'message'=> $e->getMessage(),
                      'body'=>$e->errors()
                  ]);
              }


  }
  // ***********************************************


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
        //
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
        $id_transaction = Transaction::find($id);

        if($id_transaction){
            return response()->json(
                [
                    'id_transaction'=>$id_transaction,
                    'message'=>'liste de tout les transaction',
                    'code' => 200
                ]
                );
        }else{
            return response()->json([
                'code'=>302,
                'message' => 'on n\'arrive pas a avoir acces a la liste des transaction '
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( StoreTransactionRequest $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update([

            'amountTransaction' => $request->amountTransaction,
            'statue' => $request->statue,
             'dateTransaction'=> $request->dateTransaction,
            'senderName' => $request->senderName,
             'receiverName' => $request->receiverName,
             'refTransaction' => $request->refTransaction,
             'PaymentMethod' => $request->PaymentMethod,
             'user_id'=> $request->user_id,

         ]);

         if($transaction->update()){
            return response()->json([
                'operator'=>$transaction,
                'code' => 200,
                'message'=>'liste des transactions modifiers'
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
             $transaction = Transaction::findOrFail($id);
             $transaction->delete();

        if($transaction->delete()){
             return response()->json('supression efectuer', 200);
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
}
