<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category', 'content'];

    protected $casts = [
        'content' => 'array',
    ];

    public function project()
    {
        return $this->hasOne(Project::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function blog()
    {
        return $this->hasOne(Blog::class);
    }

}
