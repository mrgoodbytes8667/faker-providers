<?php

namespace Bytes\Common\Faker\Tests\Providers;

use Bytes\Common\Faker\TestFakerTrait;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    use TestFakerTrait;

    public function testImageUrl()
    {
        self::assertNotEmpty($this->faker->imageUrl());
    }
}
