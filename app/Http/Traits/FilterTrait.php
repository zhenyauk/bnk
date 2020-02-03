<?php

namespace App\Http\Traits;

trait FilterTrait{

    public function scopeFilter($builder, $filters)
    {
        $filters->apply($builder);
    }

}