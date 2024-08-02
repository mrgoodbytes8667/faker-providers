<?php

namespace Bytes\Common\Faker\Tests\Providers;

use Bytes\Common\Faker\TestFakerTrait;
use Bytes\Common\Faker\Tests\Fixtures\FixtureEnum;
use Generator;
use PHPUnit\Framework\TestCase;

use function Symfony\Component\String\u;

/**
 * Class MiscProviderTest.
 */
class MiscProviderTest extends TestCase
{
    use TestFakerTrait;

    /**
     * Test is mostly for coverage, there isn't a good way to test this function.
     */
    public function testCamelWords()
    {
        $words = $this->faker->camelWords();
        $this->assertEquals(u($words)->camel()->toString(), $words);
    }

    /**
     * Test is mostly for coverage, there isn't a good way to test this function.
     */
    public function testSnakeWords()
    {
        $words = $this->faker->snakeWords();
        $this->assertEquals(u($words)->snake()->toString(), $words);
    }

    public function testOneOrMoreOf()
    {
        $result = $this->faker->oneOrMoreOf($this->faker->words());
        $this->assertGreaterThanOrEqual(1, count($result));
    }

    /**
     * @dataProvider provideWords
     */
    public function testOneOrMoreOfMultiple($words)
    {
        $result = $this->faker->oneOrMoreOf($words);
        $this->assertGreaterThanOrEqual(1, count($result));
    }

    /**
     * @return Generator
     */
    public function provideWords()
    {
        $this->setupFaker();

        foreach (range(1, 1000) as $index) {
            yield [$this->faker->words($this->faker->numberBetween(3, 9))];
        }
    }

    public function testRangeBetween()
    {
        $range = $this->faker->rangeBetween(4, 1, 2);

        $count = count($range);
        $this->assertGreaterThanOrEqual(2, $count);
        $this->assertLessThanOrEqual(4, $count);

        foreach ($range as $i) {
            $this->assertGreaterThanOrEqual(1, $i);
            $this->assertLessThanOrEqual(4, $i);
        }
    }

    public function testRangeBetweenForInvalidEndStart()
    {
        $range = $this->faker->rangeBetween(4, 1, 0);

        $count = count($range);
        $this->assertGreaterThanOrEqual(1, $count);
        $this->assertLessThanOrEqual(4, $count);

        foreach ($range as $i) {
            $this->assertGreaterThanOrEqual(1, $i);
            $this->assertLessThanOrEqual(4, $i);
        }
    }

    /**
     * @dataProvider provideRangeBetween412
     */
    public function testRangeBetween412($range)
    {
        $count = count($range);
        $this->assertGreaterThanOrEqual(2, $count);
        $this->assertLessThanOrEqual(4, $count);

        foreach ($range as $i) {
            $this->assertGreaterThanOrEqual(1, $i);
            $this->assertLessThanOrEqual(4, $i);
        }
    }

    /**
     * @return Generator
     */
    public function provideRangeBetween412()
    {
        $this->setupFaker();

        foreach (range(1, 1000) as $index) {
            yield [$this->faker->rangeBetween(4, 1, 2)];
        }
    }

    /**
     * @dataProvider provideRangeBetween915
     */
    public function testRangeBetween915($range)
    {
        $count = count($range);
        $this->assertGreaterThanOrEqual(5, $count);
        $this->assertLessThanOrEqual(9, $count);

        foreach ($range as $i) {
            $this->assertGreaterThanOrEqual(1, $i);
            $this->assertLessThanOrEqual(9, $i);
        }
    }

    /**
     * @return Generator
     */
    public function provideRangeBetween915()
    {
        $this->setupFaker();

        foreach (range(1, 1000) as $index) {
            yield [$this->faker->rangeBetween(9, 1, 5)];
        }
    }

    public function testRandomAlphanumericString()
    {
        // Tests empty $possibilities
        $result = $this->faker->randomAlphanumericString(18);
        $this->assertEquals(18, strlen($result));
        foreach (array_merge(range(0, 47), range(58, 64), range(91, 96), range(123, 127)) as $dec) {
            $this->assertStringNotContainsString(chr($dec), $result);
        }

        // Tests string $possibilities
        $result = $this->faker->randomAlphanumericString(10, 'A');
        $this->assertEquals(10, strlen($result));
        $this->assertEquals('AAAAAAAAAA', $result);

        // Tests non-string and non-array $possibilities
        $result = $this->faker->randomAlphanumericString(12, 5);
        $this->assertEquals(12, strlen($result));
        foreach (array_merge(range(0, 47), range(58, 64), range(91, 96), range(123, 127)) as $dec) {
            $this->assertStringNotContainsString(chr($dec), $result);
        }
    }

    public function testParagraphsMinimumChars()
    {
        $minChars = $this->faker->numberBetween(1000, 1500);

        $this->assertGreaterThanOrEqual($minChars, strlen($this->faker->paragraphsMinimumChars($minChars)));
    }

    /**
     * @dataProvider provideParagraphsMinimumChars
     */
    public function testParagraphsMinimumCharsMultiple($minChars, $value)
    {
        $this->assertGreaterThanOrEqual($minChars, strlen($value));
    }

    /**
     * @return Generator
     */
    public function provideParagraphsMinimumChars()
    {
        $this->setupFaker();

        foreach (range(1, 250) as $index) {
            foreach (range(1, 1500, 100) as $minChars) {
                yield ['minChars' => $minChars, 'value' => $this->faker->paragraphsMinimumChars($minChars)];
            }
        }
    }

    public function testRandomEnum()
    {
        self::assertContains($this->faker->randomEnum(FixtureEnum::class), FixtureEnum::cases());
        self::assertContains($this->faker->randomEnum(FixtureEnum::A), FixtureEnum::cases());
    }

    public function testRandomEnumValue()
    {
        $values = [];

        foreach (FixtureEnum::cases() as $case) {
            $values[] = $case->value;
        }

        self::assertContains($this->faker->randomEnumValue(FixtureEnum::class), $values);
        self::assertContains($this->faker->randomEnumValue(FixtureEnum::A), $values);
    }
}
