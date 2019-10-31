<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Collection;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Exception\TemplateNotFound;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\ArrayValidator;

class SizeValidator extends AbstractValidator
{
    /**
     * When there are too few items.
     *
     * @var string
     */
    public const TOO_FEW = 'tooFew';

    /**
     * When there are too many items.
     *
     * @var string
     */
    public const TOO_MANY = 'tooMany';

    /**
     * Minimal collection size.
     *
     * @var int|null
     */
    private $min;

    /**
     * Maximum collection size.
     *
     * @var int|null
     */
    private $max;

    /**
     * SizeValidator constructor.
     *
     * @param int|null $min
     * @param int|null $max
     */
    public function __construct(int $min = null, int $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        return new static(
            $extra['min'] ?? null,
            $extra['max'] ?? null
        );
    }

    /**
     * @inheritDoc
     * @throws TemplateNotFound
     */
    public function validate($value, $context = null): ResultInterface
    {
        $validator = new ArrayValidator();
        $result = $validator->validate($value);
        if (!$result->isValid()) {
            return $result;
        }

        $count = count($value);
        if (is_int($this->min) && $count < $this->min) {
            return $this->getInvalidResult(self::TOO_FEW, [
                'min' => $this->min,
                'count' => $count,
            ]);
        }

        if (is_int($this->max) && $count > $this->max) {
            return $this->getInvalidResult(self::TOO_MANY, [
                'max' => $this->max,
                'count' => $count,
            ]);
        }

        return $this->getValidResult();
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::TOO_FEW => 'Collection size must be at least {{min}} items, got {{count}}.',
            self::TOO_MANY => 'Collection size can be up to {{max}} items, got {{count}}.',
        ];
    }
}
