<?php

namespace App\Models;

use App\Models\Post;
use App\Models\PostContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakeUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'fake_user_id');
    }

    public function postContent()
    {
        return $this->hasMany(PostContent::class, 'fake_user_id');
    }
}
