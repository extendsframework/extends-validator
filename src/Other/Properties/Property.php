<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other\Properties;

use ExtendsFramework\Validator\ValidatorInterface;

class Property
{
    /**
     * Property name.
     *
     * @var string
     */
    protected $name;

    /**
     * Property validator.
     *
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * If property is optional.
     *
     * @var bool
     */
    protected $optional;

    /**
     * Property constructor.
     *
     * @param string             $name
     * @param ValidatorInterface $validator
     * @param bool|null          $optional
     */
    public function __construct(string $name, ValidatorInterface $validator, bool $optional = null)
    {
        $this->name = $name;
        $this->validator = $validator;
        $this->optional = $optional ?? false;
    }

    /**
     * Get property name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get property validator.
     *
     * @return ValidatorInterface
     */
    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    /**
     * If property is optional.
     *
     * @return bool
     */
    public function isOptional(): bool
    {
        return $this->optional;
    }
}
