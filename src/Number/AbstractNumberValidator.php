<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\NumericValidator;
use ExtendsFramework\Validator\ValidatorInterface;

abstract class AbstractNumberValidator extends AbstractValidator
{
    /**
     * Number to compare.
     *
     * @var float
     */
    protected $number;

    /**
     * AbstractNumberValidator constructor.
     *
     * @param float $number
     */
    public function __construct(float $number)
    {
        $this->number = $number;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        $validator = new NumericValidator();
        return $validator->validate($value, $context);
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): ValidatorInterface
    {
        return new static(
            $extra['number']
        );
    }
}
