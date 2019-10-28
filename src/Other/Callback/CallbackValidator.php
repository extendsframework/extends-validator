<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other\Callback;

use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\ValidatorInterface;

class CallbackValidator implements ValidatorInterface
{
    /**
     * Callback to use for validation.
     *
     * @var callable
     */
    private $callback;

    /**
     * CallbackValidator constructor.
     *
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        return $this->getCallback()($value, $context);
    }

    /**
     * Get callback.
     *
     * @return callable
     */
    private function getCallback(): callable
    {
        return $this->callback;
    }
}
