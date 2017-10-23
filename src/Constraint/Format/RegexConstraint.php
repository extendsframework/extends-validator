<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Format;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class RegexConstraint extends AbstractConstraint
{
    /**
     * When value does not match pattern.
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
        if (preg_match($this->pattern, $value) === 1) {
            return null;
        }

        return $this->getViolation(self::NOT_VALID, [
            'value' => $value,
            'pattern' => $this->pattern,
        ]);
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): ConstraintInterface
    {
        return new static(
            $extra['pattern']
        );
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
