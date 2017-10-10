<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint;

class ConstraintViolation implements ConstraintViolationInterface
{
    /**
     * Violation message.
     *
     * @var string
     */
    protected $message;

    /**
     * Violation parameters for the message.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Create new constraint violation.
     *
     * @param string $message
     * @param array  $parameters
     */
    public function __construct(string $message, array $parameters)
    {
        $this->message = $message;
        $this->parameters = $parameters;
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @inheritDoc
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): string
    {
        $replacement = [];
        foreach ($this->parameters as $key => $parameter) {
            $replacement[sprintf('{{%s}}', $key)] = $parameter;
        }

        return strtr($this->getMessage(), $replacement);
    }
}
