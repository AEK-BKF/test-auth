<?php

namespace Modules\Post\Entities;

use App\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{    

    protected $fillable = ['title', 'content', 'user_id', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
}
