<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Logical;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;

abstract class AbstractLogicalConstraint extends AbstractConstraint
{
    /**
     * Constraints to validate.
     *
     * @var ConstraintInterface[]
     */
    protected $constraints = [];

    /**
     * @inheritDoc
     */
    public static function factory(array $config): ConstraintInterface
    {
        $instance = new static();
        foreach ($config['constraints'] ?? [] as $constraint) {
            if (is_string($constraint) === true) {
                $constraint = [
                    'constraint' => $constraint,
                ];
            }

            if (is_array($constraint) === true) {
                $constraint = $constraint['constraint']::factory($constraint['options'] ?? []);
            }

            $instance->addConstraint($constraint);
        }

        return $instance;
    }

    /**
     * Add $constraint.
     *
     * @param ConstraintInterface $constraint
     * @return AbstractLogicalConstraint
     */
    public function addConstraint(ConstraintInterface $constraint): AbstractLogicalConstraint
    {
        $this->constraints[] = $constraint;

        return $this;
    }
}
