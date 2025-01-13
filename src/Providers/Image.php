<?php

namespace Bytes\Common\Faker\Providers;

use Faker\Generator;
use Faker\Provider\Base;
use Mmo\Faker\PicsumProvider;

/**
 * @property Generator $generator
 */
class Image extends Base
{
    /**
     * Generate the URL that will return a random image.
     *
     * Set randomize to false to remove the random GET parameter at the end of the url.
     *
     * @example 'http://via.placeholder.com/640x480.png/CCCCCC?text=well+hi+there'
     *
     * @param int         $width
     * @param int         $height
     * @param string|null $category
     * @param bool        $randomize
     * @param string|null $word
     * @param bool        $gray
     * @param string      $format
     *
     * @return string
     */
    public static function imageUrl(
        $width = 640,
        $height = 480,
        $category = null,
        $randomize = true,
        $word = null,
        $gray = false,
        $format = 'jpg',
    ) {
        return PicsumProvider::picsumUrl(width: $width, height: $height, randomize: $randomize, gray: $gray, imageExtension: $format);
    }
}
