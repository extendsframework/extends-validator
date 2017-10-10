<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Regex;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class RegexConstraint extends AbstractConstraint
{
    /**
     * Key when value does not match pattern.
     *
     * @const string
     */
    public const NOT_VALID = 'notValid';

    /**
     * Regular expression to validate.
     *
     * @var string
     */
    protected $pattern;

    /**
     * Create new regular expression constraint for $pattern.
     *
     * @param string $pattern
     */
    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if ((bool)preg_match($this->pattern, $value) === false) {
            return $this->getViolation(self::NOT_VALID, [
                'value' => $value,
                'pattern' => $this->pattern,
            ]);
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_VALID => 'Value "{{value}}" must match regular expression "{{pattern}}".',
        ];
    }
}
