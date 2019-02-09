<?php
namespace App\Traits ;

trait LaraveTagablesSystem {
    public function tags()
    {
        return $this->morphToMany('ArtinCMS\LTS\Models\Tag' , 'tagable','lts_tagables','tagable_id','tag_id')->withPivot('type')->withTimestamps() ;
    }
}
