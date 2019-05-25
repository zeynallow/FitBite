<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPlan extends Model
{

  protected $fillable = ['plan_id','user_id','select_day','amount','currency','select_day_per_week','select_eat_time','status','payment_status','start_date'];


  /*
  * Get Plan
  */
  public function getPlan(){
    return $this->belongsTo('App\MealPlan','plan_id');
  }

  /*
  * Get User
  */
  public function getUser(){
    return $this->belongsTo('App\User','user_id');
  }

  /*
  * Get Data
  */
  public function getData($type,$data){
    $data = MealPlanData::where('type',$type)->where('data',$data)->first();
    return $data->value;
  }



}
