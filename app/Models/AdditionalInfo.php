<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'languages',
        'about',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'google_plus_link',
        'template',
        'career_goal'
    ];
}
