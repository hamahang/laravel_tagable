<?php

namespace ArtinCMS\LTS\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'lts_tags';
    public function user()
    {
        return $this->belongsTo(config('laravel_tagable.userModel'), 'created_by');
    }

    public function faqs()
    {
        return $this->morphedByMany('ArtinCMS\FAQ\Models\Faq', 'taggable','lts_taggables');
    }

}
