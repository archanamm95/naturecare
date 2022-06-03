<?php

namespace AslamBpract\Laralegals\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \AslamBpract\LaraLegals\LaraLegals
 * @method static \AslamBpract\LaraLegals\EloquentLaraLegals eloquent($builder)
 * @see \AslamBpract\LaraLegals\LaraLegals
 */
class LaraLegals extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laralegals';
    }
}

