<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Result\Container;

use ExtendsFramework\Validator\Result\ResultInterface;

class ContainerResult implements ResultInterface
{
    /**
     * If container is valid.
     *
     * @var bool
     */
    protected $valid = true;

    /**
     * Validation results.
     *
     * @var ResultInterface[]
     */
    protected $results = [];

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->results;
    }

    /**
     * Add result to container.
     *
     * @param ResultInterface $result
     * @param string|null     $name
     * @return ContainerResult
     */
    public function addResult(ResultInterface $result, string $name = null): ContainerResult
    {
        $this->valid = $this->isValid() && $result->isValid();

        if (is_string($name) === true) {
            $this->results[$name] = $result;
        } else {
            $this->results[] = $result;
        }

        return $this;
    }
}
