<?php

declare(strict_types=1);

namespace Redox\Validator;

use Redox\Validator\Rules\Contracts\Rule;
use Redox\Validator\Rules\Contracts\DataAwareRule;

use function explode;
use function str_replace;
use function str_contains;

class Validator
{
    /**
     * @var array<string, array<string>>
     */
    private array $data = [];

    /**
     * @var array<string, array<int, string>>
     */
    private array $errors = [];

    /**
     * @var array<Chain>
     */
    private array $chains = [];

    /**
     * Set custom rule messages.
     *
     * @param array<string, string> $messages
     * @param array<string, string> $attributes
     */
    public function __construct(
        private readonly array $messages = [],
        private readonly array $attributes = [],
    ) {
    }

    /**
     * Set key-value pair data which will be validated
     * against pre-defined rules.
     *
     * @param array<string, array<string>> $data
     * @return $this
     */
    public function setData(array $data): Validator
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Add new rules for specific attribute.
     *
     * @param string $attribute
     * @param Rule ...$rules
     * @return Validator
     */
    public function attribute(string $attribute, Rule ...$rules): Validator
    {
        $this->chains[] = new Chain($attribute, $rules);

        return $this;
    }

    /**
     * Perform the validation of data.
     *
     * @return bool
     */
    public function validate(): bool
    {
        foreach ($this->chains as $chain) {
            foreach ($chain->rules as $rule) {
                $this->evaluateRule($chain->attribute, $this->data, $rule);
            }
        }

        return empty($this->errors);
    }

    /**
     * @param string $attribute
     * @param array $data
     * @param Rule $rule
     * @return void
     */
    private function evaluateRule(string $attribute, array $data, Rule $rule): void
    {
        if ($rule instanceof DataAwareRule) {
            $rule->setData($this->data);
        }

        if (!$rule->passes($attribute, $data[$attribute])) {
            $this->addError($attribute, $this->messages[$rule::class] ?? $rule->getMessage());
        }
    }

    /**
     * @param string $attribute
     * @param string $message
     * @return void
     */
    private function addError(string $attribute, string $message): void
    {
        $this->errors[$attribute][] = str_replace(
            ':attribute',
            $this->attributes[$attribute] ?? $attribute,
            $message
        );
    }

    /**
     * Return all failed rule messages.
     *
     * @return ErrorBag
     */
    public function getErrors(): ErrorBag
    {
        return new ErrorBag($this->errors);
    }
}