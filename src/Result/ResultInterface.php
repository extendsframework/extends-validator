<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Result;

use JsonSerializable;

interface ResultInterface extends JsonSerializable
{
    /**
     * If result is valid.
     *
     * @return bool
     */
    public function isValid(): bool;
}
