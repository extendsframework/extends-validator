<?php

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
     * Violation templates.
     *
     * @var array
     */
    protected $templates = [
        self::NOT_VALID => 'Value {{value}} must match regular expression {{pattern}}.',
    ];

    /**
     * Regular expression to assert.
     *
     * @var string
     */
    protected $pattern;

    /**
     * Constructor to set $pattern and $templates.
     *
     * @param string $pattern
     * @param array  $templates
     */
    public function __construct($pattern, array $templates = [])
    {
        parent::__construct($templates);

        $this->pattern = $pattern;
    }

    /**
     * @inheritDoc
     */
    public function assert($value, $context = null)
    {
        if (!preg_match($this->pattern, $value)) {
            $violation = $this->violate(self::NOT_VALID, [
                'value' => $value,
                'pattern' => $this->pattern,
            ]);
            throw $violation;
        }
        return true;
    }
}
