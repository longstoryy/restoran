<?php

namespace App\Models\Food;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    use HasFactory;
    protected $table ="deliverydetails";

    protected $fillable = [
        'id',
        'created_at',
        'name',
        'phone_number',
        'status',

        
    ];



    public $timestamps =true;

}
