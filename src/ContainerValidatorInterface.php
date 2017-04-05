<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Container\ContainerInterface;

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
     * Returns container interface with constraint violations after validation.
     *
     * When validator is not validated, a exception will be thrown.
     *
     * @return ContainerInterface
     * @throws ValidatorException
     */
    public function violations(): ContainerInterface;
}
