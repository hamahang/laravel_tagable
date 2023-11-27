<?php

namespace Hamahang\LTS\Models;

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
        return $this->morphedByMany('Hamahang\FAQ\Models\Faq', 'tagable','lts_tagables');
    }

    public function portfolios()
    {
        return $this->morphedByMany('Hamahang\LPM\Model\Portfilio', 'tagable','lts_tagables');
    }

    public function categories()
    {
        return $this->morphedByMany('Hamahang\LPM\Model\Category', 'tagable','lts_tagables');
    }

}
