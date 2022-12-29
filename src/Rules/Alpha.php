<?php

declare(strict_types=1);

namespace Redox\Validator\Rules;

use Redox\Validator\Rules\Contracts\Rule;

class Alpha implements Rule
{
    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes(string $attribute, mixed $value): bool
    {
        return ctype_alpha($value);
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return 'The :attribute should only contain alphabetic characters';
    }
}