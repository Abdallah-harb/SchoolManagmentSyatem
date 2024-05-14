<?php

namespace App\Helpers;

use Illuminate\Support\Str;

     function keyOf(string $value)
    {
        return array_flip(self::keysAndValues())[$value] ?? null;
    }

     function getNames(): array
    {
        return array_column(self::cases(), "name");
    }

     function getValues(): array
    {
        return array_column(self::cases(), "value");
    }

     function keysAndValues(): array
    {
        return array_combine(self::getValues(), self::getNames());
    }

     function selectKeysAndValues(): array
    {
        return collect(self::keysAndValues())->map(function ($key, $value) {
            return str_replace('_', ' ', Str::ucfirst(Str::lower($key)));
        })->toArray();
    }

     function selectIdAndName(): array
    {
        $values = [];
        foreach (self::keysAndValues() as $key => $value) {
            $name = str_replace('_', ' ', Str::ucfirst(Str::lower($value)));
            $values[] = ['id' => $key, 'name' => $name];
        }
        return $values;
    }

