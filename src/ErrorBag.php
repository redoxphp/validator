<?php

declare(strict_types=1);

namespace Redox\Validator;

use function count;

class ErrorBag
{
    /**
     * @param array<string, array<string>> $messages
     */
    public function __construct(
        private readonly array $messages = []
    ) {
    }

    /**
     * Return all error messages.
     *
     * @return array<string, array<string>>
     */
    public function all(): array
    {
        return $this->messages;
    }

    /**
     * Return first error message for specific attribute.
     *
     * @param string $attribute
     * @return string
     */
    public function first(string $attribute): string
    {
        return $this->has($attribute) ? (string) current($this->messages[$attribute]) : '';
    }

    /**
     * Check if we have any error messages for specific attribute.
     *
     * @param string $attribute
     * @return bool
     */
    public function has(string $attribute): bool
    {
        return isset($this->messages[$attribute]) && count($this->messages[$attribute]) > 0;
    }
}