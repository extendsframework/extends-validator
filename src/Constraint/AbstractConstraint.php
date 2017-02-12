<?php

namespace ExtendsFramework\Validator\Constraint;

use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;

abstract class AbstractConstraint implements ConstraintInterface
{
    /**
     * Associative array with templates to use for the violation.
     *
     * @var array
     */
    protected $templates = [];

    /**
     * Set templates for constraint.
     *
     * Associative array with keys and templates. Given $templates keys will replace default template keys.
     *
     * @param array $templates
     */
    public function __construct(array $templates = [])
    {
        $this->templates = array_replace($this->templates, $templates);
    }

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null)
    {
        try {
            $this->assert($value, $context);
            return true;
        } catch (ConstraintViolation $violation) {
            return false;
        }
    }

    /**
     * Create violation with template $key and $parameters.
     *
     * @param string $key
     * @param array  $parameters
     * @return ConstraintViolation
     */
    protected function violate($key, array $parameters = [])
    {
        $message = $this->templates[$key];
        $violation = new ConstraintViolation($message, $parameters);
        return $violation;
    }
}
