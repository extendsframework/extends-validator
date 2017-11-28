<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\ValidatorInterface;

abstract class AbstractComparisonValidator extends AbstractValidator
{
    /**
     * Value to compare to.
     *
     * @var mixed
     */
    protected $subject;

    /**
     * AbstractComparisonValidator constructor.
     *
     * @param mixed $subject
     */
    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): ValidatorInterface
    {
        return new static(
            $extra['subject']
        );
    }
}
