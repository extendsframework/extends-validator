<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Object\PropertiesValidator;
use ExtendsFramework\Validator\Other\Coordinates\LatitudeValidator;
use ExtendsFramework\Validator\Other\Coordinates\LongitudeValidator;
use ExtendsFramework\Validator\Result\ResultInterface;

class CoordinatesValidator extends AbstractValidator
{
    /**
     * Latitude object key.
     *
     * @var string|null
     */
    protected $latitude;

    /**
     * Longitude object key.
     *
     * @var string|null
     */
    protected $longitude;

    /**
     * CoordinatesValidator constructor.
     *
     * @param null|string $latitude
     * @param null|string $longitude
     */
    public function __construct(string $latitude = null, string $longitude = null)
    {
        $this->latitude = $latitude ?? 'latitude';
        $this->longitude = $longitude ?? 'longitude';
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): CoordinatesValidator
    {
        return new static(
            $extra['latitude'] ?? null,
            $extra['longitude'] ?? null
        );
    }

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        $validator = new PropertiesValidator([
            $this->latitude => new LatitudeValidator(),
            $this->longitude => new LongitudeValidator(),
        ]);

        return $validator->validate($value);
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
