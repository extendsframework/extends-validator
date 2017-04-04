<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator\Constraint\Exception;

use ExtendsFramework\Validator\Constraint\ConstraintException;

class TemplateNotFound extends ConstraintException
{
    /**
     * Exception when template can not be found for $key.
     *
     * @param string $key
     * @return ConstraintException
     */
    public static function forKey(string $key): ConstraintException
    {
        return new static(sprintf(
            'Template MUST exist for key "%s".',
            $key
        ));
    }
}
