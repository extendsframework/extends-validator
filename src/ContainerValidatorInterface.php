<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Container\ContainerInterface;
use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;

interface ContainerValidatorInterface
{
    /**
     * Validate $container against validators.
     *
     * @param ContainerInterface $container
     * @return bool
     */
    public function validate(ContainerInterface $container): bool;

    /**
     * Returns list with constraint violations after validation grouped per container path.
     *
     * @return ConstraintViolation[][]
     */
    public function violations(): array;
}
