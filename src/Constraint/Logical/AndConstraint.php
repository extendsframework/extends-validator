<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Logical;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class AndConstraint extends AbstractLogicalConstraint
{
    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        foreach ($this->constraints as $constraint) {
            $result = $constraint->validate($value, $context);
            if ($result instanceof ConstraintViolationInterface) {
                return $result;
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     * @codeCoverageIgnore
     */
    protected function getTemplates(): array
    {
        return [];
    }
}
