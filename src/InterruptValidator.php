<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Result\ResultInterface;

class InterruptValidator implements ValidatorInterface
{
    /**
     * The validator to assert.
     *
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * Whether or not the validation must be stopped.
     *
     * @var bool
     */
    protected $interrupt;

    /**
     * Set $validator and $interrupt flag.
     *
     * @param ValidatorInterface $validator
     * @param bool|null          $interrupt
     */
    public function __construct(ValidatorInterface $validator, bool $interrupt = null)
    {
        $this->validator = $validator;
        $this->interrupt = $interrupt ?? false;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        return $this->validator->validate($value, $context);
    }

    /**
     * Return the interrupt flag.
     *
     * @return bool
     */
    public function mustInterrupt(): bool
    {
        return $this->interrupt;
    }
}
