<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
		    'type_of_transaction',
    ];
    
    public function category(){
		  return $this->hasMany(Category::class, 'type_of_transaction');
    }
}
