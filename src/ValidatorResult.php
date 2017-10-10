<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Constraint\ConstraintException;

class ValidatorResult implements ValidatorResultInterface
{
    /**
     * If validation was valid.
     *
     * @var bool
     */
    protected $valid;

    /**
     * Validator violations.
     *
     * @var ConstraintException[]
     */
    protected $violations;

    /**
     * Create new validator result.
     *
     * @param bool  $valid
     * @param array $violations
     */
    public function __construct(bool $valid, array $violations)
    {
        $this->valid = $valid;
        $this->violations = $violations;
    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * @inheritDoc
     */
    public function getViolations(): array
    {
        return $this->violations;
    }
}
