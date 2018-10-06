<?php

namespace ArtinCMS\LTS\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'lts_tags';
    public function user()
    {
        return $this->belongsTo(config('laravel_tagable.user_model'), 'created_by');
    }

    public function faqs()
    {
        return $this->morphedByMany('ArtinCMS\FAQ\Models\Faq', 'taggable','lts_taggables');
    }

    public function portfolios()
    {
        return $this->morphedByMany('ArtinCMS\LPM\Model\Portfilio', 'taggable','lts_taggables');
    }

    public function categories()
    {
        return $this->morphedByMany('ArtinCMS\LPM\Model\Category', 'taggable','lts_taggables');
    }

}
