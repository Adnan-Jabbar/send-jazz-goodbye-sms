<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SendSmsLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request) {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

            $token = $user->createToken('my-app-token')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

        return response($response, 201);
    }

    private function executeURL($from, $to, $msg)
    {
        $URL = "http://example.com/abcd";

        return Http::get("$URL");

        // $URL = "http://example.com/abcd";

        // return Http::withHeaders([
        //     'Authorization' => 'Bearer $apiKey',
        //     'Content-Type' => 'application/x-www-form-urlencoded',
        // ])
        // ->withOptions(["verify"=>false])
        // ->get("$URL");
    }

    public function sendSMS(Request $request) {

        // $apiKey      = $request['apiKey'];
        // $username    = '03018610162';
        $request['username']    = $_ENV['APP_USERNAME'];
        $from                   = $request['from'];
        $to                     = $request['to'];
        $msg                    = $request['message'];
    
        $urlReq = $this->executeURL($from, $to, $msg);

        // echo "<pre> status:";
    	// print_r($urlReq->status());
    	// echo "<br/> ok:";
    	// print_r($urlReq->ok());
        // echo "<br/> successful:";
        // print_r($urlReq->successful());
        // echo "<br/> serverError:";
        // print_r($urlReq->serverError());
        // echo "<br/> clientError:";
        // print_r($urlReq->clientError());
        // echo "<br/> headers:";
        // print_r($urlReq->headers());
        // die;

        $reqData = SendSmsLogs::create($request->all());

        return response(['status' => 'OK', 'message' => 'Message sent successfully!', 'api' => $reqData], 200);

        // return response()->json([
        //     'status' => true,
        //     'message' => "Message sent successfully!",
        //     'post' => $post
        // ], 200);

    }

}


