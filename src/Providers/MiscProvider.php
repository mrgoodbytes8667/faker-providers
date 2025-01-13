<?php

namespace Bytes\Common\Faker\Providers;

use BackedEnum;
use Faker\Core\Color;
use Faker\Provider\Base;

use function Symfony\Component\String\u;

/**
 * Class MiscProvider.
 */
class MiscProvider extends Base
{
    /**
     * @return string
     */
    public function camelWords(int $nb = 3)
    {
        return u($this->generator->words($nb, true))->camel()->toString();
    }

    /**
     * @return string
     */
    public function snakeWords(int $nb = 3)
    {
        return u($this->generator->words($nb, true))->snake()->toString();
    }

    /**
     * Returns randomly ordered subsequence of 1 to $count elements from a provided array.
     *
     * @param array $source          Array to take elements from
     * @param int   $count           Maximum number of elements to take. Defaults to the number of elements in $source
     * @param false $allowDuplicates Allow elements to be picked several times. Defaults to false
     *
     * @return array
     */
    public function oneOrMoreOf($source, int $count = 0, $allowDuplicates = false)
    {
        if (0 === $count || $count > count($source)) {
            $count = count($source);
        }

        return $this->generator->randomElements($source, $this->generator->numberBetween(1, $count), $allowDuplicates);
    }

    /**
     * Returns a range() between $start and $max where the maximum number is a possible number between $endStart and $max.
     *
     * @example rangeBetween(4, 1, 2) -> Returns a range between 1 and either 2, 3, or 4
     *
     * @return array
     */
    public function rangeBetween(int $max = 3, int $start = 1, int $endStart = 1)
    {
        if ($endStart < $start) {
            $endStart = $start;
        }

        return range($start, $this->generator->numberBetween($endStart, $max));
    }

    /**
     * Returns a random string (default alphanumeric) of $length characters.
     *
     * @param int                        $length        = 16
     * @param string[]|string|mixed|null $possibilities = self::getAlphanumerics()
     *
     * @return string
     */
    public function randomAlphanumericString(int $length = 16, $possibilities = null)
    {
        if (empty($possibilities)) {
            $possibilities = self::getAlphanumerics();
        }

        if (is_string($possibilities)) {
            $possibilities = str_split($possibilities);
        }

        if (!is_array($possibilities)) {
            $possibilities = self::getAlphanumerics();
        }

        $output = '';
        foreach (range(1, $length) as $i) {
            $output .= $this->generator->randomElement($possibilities);
        }

        return $output;
    }

    /**
     * @return string[]
     */
    public static function getAlphanumerics()
    {
        return str_split('0123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz');
    }

    /**
     * @return string
     */
    public function paragraphsMinimumChars(int $minChars = 100)
    {
        $text = '';
        do {
            $text .= $this->generator->paragraph();
        } while (strlen($text) <= $minChars);

        return $text;
    }

    /**
     * @param BackedEnum|class-string<BackedEnum> $class
     */
    public function randomEnum(BackedEnum|string $class): ?BackedEnum
    {
        return self::randomElement($class::cases());
    }

    /**
     * @param BackedEnum|class-string<BackedEnum> $class
     */
    public function randomEnumValue(BackedEnum|string $class): int|string|null
    {
        return self::randomElement($class::cases())?->value;
    }

    /**
     * Returns a value that evaluates to a boolean true if passed to filter_var($value, FILTER_VALIDATE_BOOLEAN).
     */
    public function randomTruthyValue(): bool|string|int|null
    {
        return self::randomElement(self::getTruthyValues());
    }

    /**
     * Returns a value that evaluates to a boolean false if passed to filter_var($value, FILTER_VALIDATE_BOOLEAN).
     */
    public function randomFalsyValue(): bool|string|int|null
    {
        return self::randomElement(self::getFalsyValues());
    }

    public static function getTruthyValues(): array
    {
        return [true, '1', 'true', 'on', 'yes', 1];
    }

    public static function getFalsyValues(): array
    {
        return [false, '0', 'false', 'off', 'no', 0];
    }

    /**
     * @example 'fa3cc2'
     *
     * @see Color::hexColor() for the original function that includes the prefix
     */
    public static function hexColorNoPrefix(): string
    {
        return str_pad(dechex(self::numberBetween(1, 16777215)), 6, '0', STR_PAD_LEFT);
    }

    /**
     * @example 'ff0044'
     *
     * @see Color::safeHexColor()for the original function that includes the prefix
     */
    public static function safeHexColorNoPrefix(): string
    {
        $color = str_pad(dechex(self::numberBetween(0, 255)), 3, '0', STR_PAD_LEFT);

        return $color[0].$color[0].$color[1].$color[1].$color[2].$color[2];
    }
}
