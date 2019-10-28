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
    private $code;

    /**
     * Error message.
     *
     * @var string
     */
    private $message;

    /**
     * Message parameters.
     *
     * @var array
     */
    private $parameters;

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
            'code' => $this->getCode(),
            'message' => $this->getMessage(),
            'parameters' => $this->getParameters(),
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
        foreach ($this->getParameters() as $key => $parameter) {
            $replacement[sprintf('{{%s}}', $key)] = $parameter;
        }

        return strtr($this->getMessage(), $replacement);
    }

    /**
     * Get code.
     *
     * @return string
     */
    private function getCode(): string
    {
        return $this->code;
    }

    /**
     * Get message.
     *
     * @return string
     */
    private function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Get parameters.
     *
     * @return array
     */
    private function getParameters(): array
    {
        return $this->parameters;
    }
}
