<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Exception;

use ExtendsFramework\Validator\Constraint\ConstraintException;

class ConstraintViolation extends ConstraintException
{
    /**
     * Parameters to replace in violation message.
     *
     * @var iterable
     */
    protected $parameters = [];

    /**
     * Set $message and $parameters.
     *
     * @param string   $message
     * @param iterable $parameters
     */
    public function __construct($message, iterable $parameters)
    {
        parent::__construct($message);

        $this->parameters = $parameters;
    }

    /**
     * Get parameters to use for string representation.
     *
     * @return iterable
     */
    public function getParameters(): iterable
    {
        return $this->parameters;
    }

    /**
     * String representation of the violation.
     *
     * @return string
     */
    public function __toString(): string
    {
        $replacement = [];
        foreach ($this->parameters as $key => $parameter) {
            $replacement[sprintf('{{%s}}', $key)] = $parameter;
        }

        return strtr($this->getMessage(), $replacement);
    }
}
