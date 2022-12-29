<?php

declare(strict_types=1);

namespace Redox\Validator\Rules;

use Redox\Validator\Rules\Contracts\Rule;

class LengthBetween implements Rule
{
    public function __construct(
        private readonly int $min,
        private readonly int $max,
    ) {
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes(string $attribute, mixed $value): bool
    {
        $valueLength = 0;

        if (is_array($value)) {
            $valueLength = count($value);
        }

        if (is_string($value) || is_numeric($value)) {
            $valueLength = strlen((string) $value);
        }

        return $valueLength >= $this->min && $valueLength <= $this->max;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return sprintf('The :attribute length must be between %s and %s', $this->min, $this->max);
    }
}