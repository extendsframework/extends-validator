<?php

namespace ExtendsFramework\Validator\Constraint\Exception;

use DomainException;

class ConstraintViolation extends DomainException
{
    /**
     * Parameters to replace in violation message.
     *
     * @var array
     */
    protected $parameters = [];

    /**
     * Set $message and $parameters.
     *
     * @param string $message
     * @param array  $parameters
     */
    public function __construct($message, array $parameters)
    {
        parent::__construct($message);

        $this->parameters = $parameters;
    }

    /**
     * Get parameters to use for string representation.
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * String representation of the violation.
     *
     * @return string
     */
    public function __toString()
    {
        $message = $this->getMessage();
        foreach ($this->parameters as $key => $parameter) {
            $message = str_replace(sprintf('{{%s}}', $key), $parameter, $message);
        }
        return $message;
    }
}
