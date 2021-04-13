<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';

    protected $fillable = [
		'type_of_category',
        'type_of_transaction',
        'added_by',
    ];

    protected $hidden = [
        'added_by',
    ];

    public $timestamps = true;

    public function user(){
		  return $this->belongsTo(User::class, 'added_by');
    }

    public function transaction(){
		  return $this->belongsTo(Transaction::class, 'category_id');
    }

}
