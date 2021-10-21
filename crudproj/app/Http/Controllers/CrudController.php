<?php

namespace App\Http\Controllers;
use App\Models\CrudModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Kreait\Firebase\Database;
use GuzzleHttp\Client;

class CrudController extends Controller
{
    private $request;
    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    // crud mongodb
    public function index(){
        try {

            $data = CrudModel::all();

            return response()->json(['message' => 'success', 'data'=>$data], 200);

        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }

    }
    public function add(Request $request){
        
        try {

            $crudval = new CrudModel;
            $crudval->namalengkap = $request->namalengkap;
            $crudval->alamat = $request->alamat;
            $crudval->username = $request->username;
            $crudval->password = app('hash')->make($request->password);
            $crudval->save();
    
            return response()->json(['message' => 'success'], 200);

        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }

    }
    public function by_id($id){

        try{
            
            $data = CrudModel::find($id);

            return response()->json(['message' => 'success', 'data'=>$data], 200);

        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }
    }
    public function update(Request $request, $id){
    // public function update(Request $request){
        
        try{

            $crudval = CrudModel::find($id);
            
            $crudval->namalengkap = $request->namalengkap;
            $crudval->alamat = $request->alamat;
            $crudval->username = $request->username;
            $crudval->password = $request->password;
            $crudval->save();

            return response()->json(['message' => 'success'], 200);

        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }
    }
    public function delete($id){
        
        try{
            
            $crudval = CrudModel::find($id);
            $crudval->delete();
            
            return response()->json(['message' => 'success'], 200);

        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }
    }
    // end crud mongodb

    // login & logout with JWT Token
    protected function jwt(User $user) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60*60 // Expire
        ];
        
        return JWT::encode($payload, env('JWT_SECRET'));
    } 
    public function login(User $user){
        
        try{

            $val = CrudModel::where('username', '=', $this->request->username)->first();

            if (!$val) {

                return response()->json(['message' => 'user does not exist.'], 400);

            }
            if(!Hash::check($this->request->password, $val->password)) {

                return response()->json(['message' => 'password doesnt match'], 400);

            }else{

                return response()->json(['message' => 'success', 'token' => $this->jwt($user), 'data' => $val], 200);

            }

        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }

    }
    public function logout(User $user){

        try{

            // expired token
            $payload = [
                'iss' => "lumen-jwt", // Issuer of the token
                'sub' => $user->id, // Subject of the token
                'iat' => 0, // Time when JWT was issued. 
                'exp' => 0 // Expire
            ];
            
            JWT::encode($payload, env('JWT_SECRET'));

            return response()->json(['message' => 'logout and destroy token success'], 200);

        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }
    }
    // end login & logout with JWT Token

    // firebase crud
    public function firebase_read(Database $database){
        
        try{

            $data = $database->getReference('cruds')->getValue();

            return response()->json(['message' => 'success', 'data' => $data], 200);

        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }

    }
    public function firebase_add(Database $database){
        
        try{
            $ref = $database->getReference('cruds');
            $key = $ref->push()->getKey();
            $ref->getChild($key)->set([
                'namalengkap' => $this->request->namalengkap,
                'alamat' => $this->request->alamat
            ]);

            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }

    }
    public function firebase_by_id(Database $database, $id){
        
        try{
            $data = $database->getReference('cruds')->getValue();
            
            return response()->json(['message' => 'success', 'data' => $data[$id]], 200);

        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }

    }
    public function firebase_update(Database $database, $id){
        
        try{

            $database->getReference('cruds/'.$id.'/namalengkap')->set($this->request->namalengkap);
            $database->getReference('cruds/'.$id.'/alamat')->set($this->request->alamat);

            return response()->json(['message' => 'success'], 200);

        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }
    }
    public function firebase_delete(Database $database, $id){
        
        try{

            $database->getReference('cruds/'.$id)->remove();
            
            return response()->json(['message' => 'success'], 200);

        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }

    }
    // end firebase crud


    // jawaban no 7
    public function filter_object(){

        try{
            $data = json_decode(file_get_contents(
                'https://gist.githubusercontent.com/Loetfi/fe38a350deeebeb6a92526f6762bd719/raw/9899cf13cc58adac0a65de91642f87c63979960d/filter-data.json'), true);
            
            $getDenom = [];
            $billdetails = $data['data']['response']['billdetails'];
            $keyval = 0;
            foreach ($billdetails as $key => $value) {
                $nulltext = (int)str_replace("DENOM           : ","",$value['body'][0]);
                if($nulltext>=100000){
                    if($key==2){
                        $getDenom[$keyval] = $nulltext;
                    }else{
                        $getDenom[$keyval+=1] = $nulltext;
                    }
                    
                }
            }
            echo print_r($getDenom);

        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => $exception], 400);
        }
    }
    // end jawaban no 7

    // jawaban no 6
    public function response_client_register(){
        try{
            $client = new Client();
            $res = $client->request('POST', 'https://reqres.in/api/register', [
                'form_params' => [
                    'email' => 'eve.holt@reqres.in',
                    'password' => 'pistol'
                ]
            ]);

            return response()->json(['message'=> 'success', 'data' => json_decode($res->getBody())], 200);
            
        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => 'failed '.$exception], 400);
        }
    }
    public function response_client_login(){
        try{
            $client = new Client();
            $res = $client->request('POST', 'https://reqres.in/api/login', [
                'form_params' => [
                    'email' => 'eve.holt@reqres.in',
                    'password' => 'cityslicka'
                ]
            ]);

            return response()->json(['message'=> 'success', 'data' => json_decode($res->getBody())], 200);
            
        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
            return response()->json(['message' => 'failed '.$exception], 400);
        }
    }
    // end jawaban no 6


    //
}
