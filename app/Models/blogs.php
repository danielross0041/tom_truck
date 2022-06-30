<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'blogs';
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
