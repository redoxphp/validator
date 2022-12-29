<?php

declare(strict_types=1);

namespace Redox\Validator\Rules;

use Redox\Validator\Rules\Contracts\Rule;

class Required implements Rule
{
    /**
     * @param mixed $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes(mixed $attribute, mixed $value): bool
    {
        return !empty($value);
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return 'The :attribute field is required';
    }
}