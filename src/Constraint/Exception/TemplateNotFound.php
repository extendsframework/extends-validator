<?php

namespace ExtendsFramework\Validator\Constraint\Exception;

use ExtendsFramework\Validator\Constraint\ConstraintException;

class TemplateNotFound extends ConstraintException
{
    /**
     * Exception when template can not be found for $key.
     *
     * @param string $key
     * @return static
     */
    public static function forKey($key)
    {
        return new static(sprintf(
            'Template MUST exist for key "%s".',
            $key
        ));
    }
}
