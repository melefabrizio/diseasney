<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Rating;
use App\User;
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
        return response()->json(Movie::all());
    }

    public function one($movieId){
        return response()->json(Movie::find($movieId));
    }

    public function movieRatings($movieId){

        return response()->json(Movie::find($movieId)->ratings);

    }

    public function storeRating(Request $request, $movieId){
        $rating = new Rating();

        $alreadyRated = Rating::where('movie_id',$movieId)
            ->where('user_id',$request->auth->id)->exists();

        if($alreadyRated){
            return response(json_encode(array(
                "status" => "error",
                "message" => "You have already rated this movie!"
            )), 409);
        }

        $this->validate($request,[
            'overall' => 'required|numeric|min:0|max:10',
            'score' => 'required|numeric|min:0|max:10',
            'animation' => 'required|numeric|min:0|max:10',
            'universe' => 'required|numeric|min:0|max:10',
            'story' => 'required|numeric|min:0|max:10',
            'good_guy' => 'required|numeric|min:0|max:10',
            'bad_guy' => 'required|numeric|min:0|max:10',

            ]);

        $rating->overall = $request->overall;
        $rating->score = $request->score;
        $rating->animation = $request->animation;
        $rating->story = $request->story;
        $rating->universe = $request->overall;
        $rating->bad_guy = $request->bad_guy;
        $rating->good_guy = $request->good_guy;

        $rating->movie()->associate(Movie::find($movieId));
        $rating->user()->associate(User::find($request->auth->id));

        $rating->save();

        return response($rating->toJson(),201);

    }
}
