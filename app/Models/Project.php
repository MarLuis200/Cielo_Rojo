<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['post_id', 'title', 'category', 'content'];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
