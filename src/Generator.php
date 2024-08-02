<?php

namespace Bytes\Common\Faker;

use BackedEnum;
use Faker\Generator as ParentGenerator;

/**
 * @method string          imageUrl($width = 640, $height = 480, $category = null, $randomize = true, $word = null, $gray = false, $format = 'jpg')
 * @method string          camelWords(int $nb = 3)
 * @method string          snakeWords(int $nb = 3)
 * @method array           oneOrMoreOf(array $source, int $count = 0, bool $allowDuplicates = false)
 * @method array           rangeBetween(int $max = 3, int $start = 1, int $endStart = 1)
 * @method string          randomAlphanumericString(int $length = 16, $possibilities = null)
 * @method string          paragraphsMinimumChars(int $minChars = 100)
 * @method BackedEnum|null randomEnum(BackedEnum|string $class)
 * @method int|string|null randomEnumValue(BackedEnum|string $class):
 */
class Generator extends ParentGenerator
{
}
