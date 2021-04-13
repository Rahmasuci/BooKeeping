<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    use HasFactory;
    protected $primaryKey = 'transaction_id';


    protected $table = 'transactions';

    protected $fillable = [
	    'amount',
        'date',
        'category_id',
        'created_by',
        'note'
    ];

    public function user(){
		  return $this->belongsTo(User::class, 'added_by');
    }

    public function category(){
		  return $this->belongsTo(Category::class, 'category_id');
    }
    
    
}
