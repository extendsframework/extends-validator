<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint;

use JsonSerializable;

interface ConstraintViolationInterface extends JsonSerializable
{
    /**
     * Get raw violation message.
     *
     * @return string
     */
    public function getMessage(): string;

    /**
     * Get replacement parameters for raw violation message.
     *
     * @return array
     */
    public function getParameters(): array;

    /**
     * Get parsed violation message.
     *
     * @return string
     */
    public function jsonSerialize(): string;
}
