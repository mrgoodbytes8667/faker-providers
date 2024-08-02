<?php

namespace Bytes\Common\Faker;

use Bytes\Common\Faker\Providers\Image;
use Bytes\Common\Faker\Providers\MiscProvider;
use Faker\Factory as ParentFactory;
use Illuminate\Support\Arr;

class Factory extends ParentFactory
{
    /**
     * Create a new generator.
     *
     * @param string $locale
     *
     * @return Generator
     */
    public static function create($locale = self::DEFAULT_LOCALE)
    {
        $generator = new Generator();

        $defaultProviders = Arr::where(static::$defaultProviders, function ($value, $key) {
            return 'Image' !== $value;
        });
        foreach ($defaultProviders as $provider) {
            $providerClassName = self::getProviderClassname($provider, $locale);
            $generator->addProvider(new $providerClassName($generator));
        }

        $generator->addProvider(new MiscProvider($generator));
        $generator->addProvider(new Image($generator));

        return $generator;
    }
}
