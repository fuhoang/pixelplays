<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'video_link',
        'published_at',
        'category_id',
    ];


    /**
     *  An video is owned by a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the category associated with the given video.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
