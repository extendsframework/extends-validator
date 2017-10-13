<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Logical;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class XorConstraint extends AbstractLogicalConstraint
{
    /**
     * When none of the constraints are valid.
     *
     * @const string
     */
    public const NONE_VALID = 'noneValid';

    /**
     * When multiple of the constraints are valid.
     *
     * @const string
     */
    public const MULTIPLE_VALID = 'multipleValid';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        $results = [];
        foreach ($this->constraints as $constraint) {
            $results[] = $constraint->validate($value, $context) === null;
        }

        $sum = array_sum($results);
        if ($sum === 1) {
            return null;
        }

        return $this->getViolation($sum === 0 ? self::NONE_VALID : self::MULTIPLE_VALID, [
            'count' => count($this->constraints),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NONE_VALID => 'None of the {{count}} constraint(s) are valid.',
            self::MULTIPLE_VALID => 'Multiple of the {{count}} constraint(s) are valid.',
        ];
    }
}
