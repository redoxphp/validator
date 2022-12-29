<?php

declare(strict_types=1);

namespace Redox\Validator\Rules;

use Redox\Validator\Rules\Contracts\Rule;

class Email implements Rule
{
    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes(string $attribute, mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return 'The :attribute must be a valid email address';
    }
}