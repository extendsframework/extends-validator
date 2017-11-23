<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Result\Valid;

use ExtendsFramework\Validator\Result\ResultInterface;

class ValidResult implements ResultInterface
{
    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return null;
    }
}
