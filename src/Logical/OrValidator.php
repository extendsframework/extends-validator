<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Logical;

use ExtendsFramework\Validator\Result\ResultInterface;

class OrValidator extends AbstractLogicalValidator
{
    /**
     * When none of the Validators is valid.
     *
     * @const string
     */
    public const NONE_VALID = 'noneValid';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        $validators = $this->getValidators();
        foreach ($validators as $validator) {
            $result = $validator->validate($value, $context);
            if ($result->isValid()) {
                return $this->getValidResult();
            }
        }

        return $this->getInvalidResult(self::NONE_VALID, [
            'count' => count($validators),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NONE_VALID => 'None of the {{count}} validator(s) are valid.',
        ];
    }
}
