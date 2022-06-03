<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Logo implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(null, 32, function ($constraint) {
                $constraint->aspectRatio();
        });
    }
}
