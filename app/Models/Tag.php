<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'name',
    ];

    protected $guarded = [];


    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_tags','tag_id','post_id');
    }
}
