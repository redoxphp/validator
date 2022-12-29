<?php

declare(strict_types=1);

namespace Redox\Validator\Rules\Contracts;

interface Rule
{
    /**
     * Perform validation of the data.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes(string $attribute, mixed $value): bool;

    /**
     * Get error message if rule has failed to validate data.
     *
     * @return string
     */
    public function getMessage(): string;
}