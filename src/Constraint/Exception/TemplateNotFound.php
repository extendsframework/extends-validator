<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Exception;

use Exception;
use ExtendsFramework\Validator\Constraint\ConstraintException;

class TemplateNotFound extends Exception implements ConstraintException
{
    /**
     * Template not found for $key.
     *
     * @param string $key
     */
    public function __construct(string $key)
    {
        parent::__construct(sprintf(
            'No constraint violation template found for key "%s".',
            $key
        ));
    }
}
