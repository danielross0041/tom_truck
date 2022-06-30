<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
 	protected $primaryKey = 'id';
  	protected $table = 'product';
    protected $guarded = []; 

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function category()
    {
        return $this->belongsTo(category::class,'categoryid');
    } 
}
