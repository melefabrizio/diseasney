<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{

    protected $appends =['avg_overall','avg_score','avg_animation','avg_universe',
                        'avg_story','avg_bad_guy','avg_good_guy'];

    public function ratings(){
        return $this->hasMany('App\Rating');
    }


    public function getAvgOverallAttribute(){
        return round($this->ratings()->avg('overall'),1,PHP_ROUND_HALF_DOWN);
    }

    public function getAvgScoreAttribute(){
        return round($this->ratings()->avg('score'),1,PHP_ROUND_HALF_DOWN);
    }
    public function getAvgAnimationAttribute(){
        return round($this->ratings()->avg('animation'),1,PHP_ROUND_HALF_DOWN);
    }
    public function getAvgUniverseAttribute(){
        return round($this->ratings()->avg('universe'),1,PHP_ROUND_HALF_DOWN);
    }
    public function getAvgStoryAttribute(){
        return round($this->ratings()->avg('story'),1,PHP_ROUND_HALF_DOWN);
    }
    public function getAvgBadGuyAttribute(){
        return round($this->ratings()->avg('bad_guy'),1,PHP_ROUND_HALF_DOWN);
    }
    public function getAvgGoodGuyAttribute(){
        return round($this->ratings()->avg('good_guy'),1,PHP_ROUND_HALF_DOWN);
    }
}
