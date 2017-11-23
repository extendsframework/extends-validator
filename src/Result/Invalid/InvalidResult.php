<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Result\Invalid;

use ExtendsFramework\Validator\Result\ResultInterface;

class InvalidResult implements ResultInterface
{
    /**
     * Error code.
     *
     * @var string
     */
    protected $code;

    /**
     * Error message.
     *
     * @var string
     */
    protected $message;

    /**
     * Message parameters.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Violation constructor.
     *
     * @param string $code
     * @param string $message
     * @param array  $parameters
     */
    public function __construct(string $code, string $message, array $parameters)
    {
        $this->code = $code;
        $this->message = $message;
        $this->parameters = $parameters;
    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return [
            'code' => $this->code,
            'message' => $this->message,
            'parameters' => $this->parameters,
        ];
    }

    /**
     * Return result as a string.
     *
     * @return string
     */
    public function __toString(): string
    {
        $replacement = [];
        foreach ($this->parameters as $key => $parameter) {
            $replacement[sprintf('{{%s}}', $key)] = $parameter;
        }

        return strtr($this->message, $replacement);
    }
}
