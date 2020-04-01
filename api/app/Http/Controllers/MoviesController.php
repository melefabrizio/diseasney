<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class MoviesController extends Controller
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
        return Movie::all()->toJson();
    }
}
