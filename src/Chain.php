<?php

declare(strict_types=1);

namespace Redox\Validator;

use Redox\Validator\Rules\Contracts\Rule;

class Chain
{
    /**
     * @param string $attribute
     * @param array<Rule> $rules
     */
    public function __construct(
        public readonly string $attribute,
        public readonly array $rules,
    ) {
    }
}