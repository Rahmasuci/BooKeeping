<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
		    'type_of_category',
        'transaction_id',
        'user_id',
    ];

    protected $hidden = [
        'user_id',
    ];

    public $timestamps = true;
    
    public function transaction(){
		  return $this->belongsTo(Transaction::class, 'type_of_transaction');
    }

    public function user(){
		  return $this->belongsTo(User::class, 'user_id');
    }

}
