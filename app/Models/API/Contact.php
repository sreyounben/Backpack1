<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable =
   [
    'first_name',
    'last_name',
    'email',
    'city',
    'country',
    'job_title'
   ];

}
