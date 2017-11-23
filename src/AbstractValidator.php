<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\ServiceLocator\Resolver\StaticFactory\StaticFactoryInterface;
use ExtendsFramework\Validator\Exception\TemplateNotFound;
use ExtendsFramework\Validator\Result\Invalid\InvalidResult;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Result\Valid\ValidResult;

abstract class AbstractValidator implements ValidatorInterface, StaticFactoryInterface
{
    /**
     * Create valid result.
     *
     * @return ResultInterface
     */
    protected function getValidResult(): ResultInterface
    {
        return new ValidResult();
    }

    /**
     * Create invalid result.
     *
     * When template can not be found, an exception will be thrown.
     *
     * @param string $code
     * @param array  $parameters
     * @return ResultInterface
     * @throws TemplateNotFound
     */
    protected function getInvalidResult(string $code, array $parameters = null): ResultInterface
    {
        $templates = $this->getTemplates();
        if (array_key_exists($code, $templates) === false) {
            throw new TemplateNotFound($code);
        }

        return new InvalidResult($code, $templates[$code], $parameters ?? []);
    }

    /**
     * Get an associative array with templates to use for invalid result.
     *
     * @return array
     */
    abstract protected function getTemplates(): array;
}
