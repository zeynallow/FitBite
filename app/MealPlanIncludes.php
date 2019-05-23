<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealPlanIncludes extends Model
{
    protected $fillable = ['name','cover','includes','plan_id'];
}
