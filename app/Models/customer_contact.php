<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer_contact extends Model
{
    protected $primaryKey = 'id';
  	protected $table = 'customer_contact';
    protected $guarded = [];


    public function product()
    {
        return $this->belongsTo(product::class,'product_id');
    }
}
