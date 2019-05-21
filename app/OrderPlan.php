<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPlan extends Model
{

  protected $fillable = ['plan_id','user_id','select_day','select_day_per_week','select_eat_time','status','payment_status'];


  /*
  * Get Plan
  */
  public function getPlan(){
    return $this->belongsTo('App\MealPlan','plan_id');
  }

}
