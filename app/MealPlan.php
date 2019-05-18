<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{

  protected $fillable = ['name','cover','slug','half_day','full_day'];

    /*
    * Get Plan Includes
    */
    public function getIncludes(){
      return $this->hasMany('App\MealPlanIncludes','plan_id');
    }
}
