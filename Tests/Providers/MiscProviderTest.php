<?php

namespace Bytes\Common\Faker\Tests\Providers;

use Bytes\Common\Faker\Factory;
use Bytes\Common\Faker\Generator as FakerGenerator;
use Bytes\Common\Faker\Tests\Fixtures\FixtureEnum;
use Generator;
use PHPUnit\Framework\TestCase;
use function Symfony\Component\String\u;

class MiscProviderTest extends TestCase
{
    private ?FakerGenerator $faker = null;

    /**
     * Test is mostly for coverage, there isn't a good way to test this function.
     */
    public function testCamelWords()
    {
        $words = $this->faker->camelWords();
        self::assertEquals(u($words)->camel()->toString(), $words);
    }

    /**
     * Test is mostly for coverage, there isn't a good way to test this function.
     */
    public function testSnakeWords()
    {
        $words = $this->faker->snakeWords();
        self::assertEquals(u($words)->snake()->toString(), $words);
    }

    public function testOneOrMoreOf()
    {
        $result = $this->faker->oneOrMoreOf($this->faker->words());
        self::assertGreaterThanOrEqual(1, count($result));
    }

    /**
     * @dataProvider provideWords
     */
    public function testOneOrMoreOfMultiple($words)
    {
        $result = $this->faker->oneOrMoreOf($words);
        self::assertGreaterThanOrEqual(1, count($result));
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

    /**
     * @before
     */
    protected function setupFaker(): void
    {
        if (is_null($this->faker)) {
            $this->faker = Factory::create();
        }
    }

    public function testRangeBetween()
    {
        $range = $this->faker->rangeBetween(4, 1, 2);

        $count = count($range);
        self::assertGreaterThanOrEqual(2, $count);
        self::assertLessThanOrEqual(4, $count);

        foreach ($range as $i) {
            self::assertGreaterThanOrEqual(1, $i);
            self::assertLessThanOrEqual(4, $i);
        }
    }

    public function testRangeBetweenForInvalidEndStart()
    {
        $range = $this->faker->rangeBetween(4, 1, 0);

        $count = count($range);
        self::assertGreaterThanOrEqual(1, $count);
        self::assertLessThanOrEqual(4, $count);

        foreach ($range as $i) {
            self::assertGreaterThanOrEqual(1, $i);
            self::assertLessThanOrEqual(4, $i);
        }
    }

    /**
     * @dataProvider provideRangeBetween412
     */
    public function testRangeBetween412($range)
    {
        $count = count($range);
        self::assertGreaterThanOrEqual(2, $count);
        self::assertLessThanOrEqual(4, $count);

        foreach ($range as $i) {
            self::assertGreaterThanOrEqual(1, $i);
            self::assertLessThanOrEqual(4, $i);
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
        self::assertGreaterThanOrEqual(5, $count);
        self::assertLessThanOrEqual(9, $count);

        foreach ($range as $i) {
            self::assertGreaterThanOrEqual(1, $i);
            self::assertLessThanOrEqual(9, $i);
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
        self::assertEquals(18, strlen($result));
        foreach (array_merge(range(0, 47), range(58, 64), range(91, 96), range(123, 127)) as $dec) {
            self::assertStringNotContainsString(chr($dec), $result);
        }

        // Tests string $possibilities
        $result = $this->faker->randomAlphanumericString(10, 'A');
        self::assertEquals(10, strlen($result));
        self::assertEquals('AAAAAAAAAA', $result);

        // Tests non-string and non-array $possibilities
        $result = $this->faker->randomAlphanumericString(12, 5);
        self::assertEquals(12, strlen($result));
        foreach (array_merge(range(0, 47), range(58, 64), range(91, 96), range(123, 127)) as $dec) {
            self::assertStringNotContainsString(chr($dec), $result);
        }
    }

    public function testParagraphsMinimumChars()
    {
        $minChars = $this->faker->numberBetween(1000, 1500);

        self::assertGreaterThanOrEqual($minChars, strlen($this->faker->paragraphsMinimumChars($minChars)));
    }

    /**
     * @dataProvider provideParagraphsMinimumChars
     */
    public function testParagraphsMinimumCharsMultiple($minChars, $value)
    {
        self::assertGreaterThanOrEqual($minChars, strlen($value));
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

    /**
     * @after
     */
    protected function tearDownFaker(): void
    {
        $this->faker = null;
    }
}
