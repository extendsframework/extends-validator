<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint;

use ExtendsFramework\ServiceLocator\Resolver\StaticFactory\StaticFactoryInterface;
use ExtendsFramework\Validator\Constraint\Exception\TemplateNotFound;

abstract class AbstractConstraint implements ConstraintInterface, StaticFactoryInterface
{
    /**
     * Create violation with template $key and $parameters.
     *
     * When template can not be found, an exception will be thrown.
     *
     * @param string $key
     * @param array  $parameters
     * @return ConstraintViolationInterface
     * @throws ConstraintException
     */
    protected function getViolation(string $key, array $parameters = null): ConstraintViolationInterface
    {
        $templates = $this->getTemplates();
        if (array_key_exists($key, $templates) === false) {
            throw new TemplateNotFound($key);
        }

        return new ConstraintViolation($templates[$key], $parameters ?? []);
    }

    /**
     * Get an associative array with templates to use for the violation.
     *
     * @return array
     */
    abstract protected function getTemplates(): array;
}
