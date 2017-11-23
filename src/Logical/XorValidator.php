<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Logical;

use ExtendsFramework\Validator\Result\ResultInterface;

class XorValidator extends AbstractLogicalValidator
{
    /**
     * When none of the Validators are valid.
     *
     * @const string
     */
    public const NONE_VALID = 'noneValid';

    /**
     * When multiple of the Validators are valid.
     *
     * @const string
     */
    public const MULTIPLE_VALID = 'multipleValid';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        $valid = 0;
        foreach ($this->validators as $validator) {
            $result = $validator->validate($value, $context);
            if ($result->isValid() === true) {
                $valid++;
            }
        }

        if ($valid === 1) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult($valid === 0 ? self::NONE_VALID : self::MULTIPLE_VALID, [
            'count' => count($this->validators),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NONE_VALID => 'None of the {{count}} Validator(s) are valid.',
            self::MULTIPLE_VALID => 'Multiple of the {{count}} Validator(s) are valid.',
        ];
    }
}
