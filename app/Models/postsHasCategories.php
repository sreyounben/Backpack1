<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postsHasCategories extends Model
{
    use HasFactory;

    protected $table = 'posts_has_categories';
    protected $fillable = ['post_id', 'category_id'];

}
