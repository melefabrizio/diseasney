<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class UsersController extends Controller
{

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function all(Request $request){
        return response()->json(User::all());
    }

    public function one($userId){
        return response()->json(User::find($userId));
    }

    public function userRatings($userId){

        return response()->json(User::find($userId)->ratings);

    }
}
