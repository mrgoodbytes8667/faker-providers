<?php

namespace Bytes\Common\Faker\Tests\Providers;

use Bytes\Common\Faker\Factory;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testImageUrl()
    {
        self::assertNotEmpty(Factory::create()->imageUrl());
    }
}
