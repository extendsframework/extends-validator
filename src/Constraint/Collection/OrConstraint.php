<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Collection;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class OrConstraint extends AbstractCollectionConstraint
{
    /**
     * Key when none of the constraints is valid.
     *
     * @const string
     */
    public const NONE_VALID = 'noneValid';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        foreach ($this->constraints as $constraint) {
            if ($constraint->validate($value, $context) === null) {
                return null;
            }
        }

        return $this->getViolation(self::NONE_VALID, [
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
        ];
    }
}
