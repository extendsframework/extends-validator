<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;

class RegexConstraint extends AbstractConstraint
{
    /**
     * Key when value does not match pattern.
     *
     * @const string
     */
    const NOT_VALID = 'notValid';

    /**
     * Regular expression to assert.
     *
     * @var string
     */
    protected $pattern;

    /**
     * Constructor to set $pattern for validation.
     *
     * @param string $pattern
     */
    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @inheritDoc
     */
    public function assert($value, $context = null): void
    {
        if (!\preg_match($this->pattern, $value)) {
            throw $this->getViolation(self::NOT_VALID, [
                'value' => $value,
                'pattern' => $this->pattern,
            ]);
        }
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_VALID => 'Value {{value}} must match regular expression {{pattern}}.',
        ];
    }
}
