<?php

declare(strict_types=1);

namespace Redox\Validator\Rules\Contracts;

interface DataAwareRule
{
    /**
     * @param array<string, array<string>> $data
     * @return void
     */
    public function setData(array $data): void;
}