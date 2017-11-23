<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Exception;

use Exception;
use ExtendsFramework\Validator\ValidatorException;

class TemplateNotFound extends Exception implements ValidatorException
{
    /**
     * Template not found for $key.
     *
     * @param string $key
     */
    public function __construct(string $key)
    {
        parent::__construct(sprintf(
            'No invalid result template found for key "%s".',
            $key
        ));
    }
}
