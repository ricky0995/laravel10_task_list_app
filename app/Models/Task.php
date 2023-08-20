<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // in a model we need to define which column in db is permitted to modify, the column not specified below will not be able to modify
    protected $fillable = ['title', 'description', 'long_description'];
}
