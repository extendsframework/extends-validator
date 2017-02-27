<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator\Constraint;

use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;
use ExtendsFramework\Validator\Constraint\Exception\TemplateNotFound;

abstract class AbstractConstraint implements ConstraintInterface
{
    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): bool
    {
        try {
            $this->assert($value, $context);

            return true;
        } catch (ConstraintException $violation) {
            return false;
        }
    }

    /**
     * Create violation with template $key and $parameters.
     *
     * @param string $key
     * @param array  $parameters
     * @return ConstraintViolation
     * @throws ConstraintException
     */
    protected function getViolation(string $key, array $parameters = null): ConstraintViolation
    {
        $templates = $this->getTemplates();
        if (!isset($templates[$key])) {
            throw TemplateNotFound::forKey($key);
        }

        return new ConstraintViolation($templates[$key], $parameters ?: []);
    }

    /**
     * Get an associative array with templates to use for the violation.
     *
     * @return array
     */
    abstract protected function getTemplates(): array;
}
