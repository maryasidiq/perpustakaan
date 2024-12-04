<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    Protected $table = 'chatbot'; 
    protected $fillable = [ 
        'queries', 
        'replies' 
    ]; 
    use HasFactory;
}
