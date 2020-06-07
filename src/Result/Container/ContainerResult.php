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
    private $valid = true;

    /**
     * Validation results.
     *
     * @var ResultInterface[]
     */
    private $results = [];

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
        $results = array_filter($this->results, static function (ResultInterface $result) {
            return !$result->isValid();
        });

        if (count(array_filter(array_keys($results), 'is_string')) === 0) {
            $results = array_values($results); // Force JSON array by resetting keys.
        }

        return $results;
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

        if (is_string($name)) {
            $this->results[$name] = $result;
        } else {
            $this->results[] = $result;
        }

        return $this;
    }
}
