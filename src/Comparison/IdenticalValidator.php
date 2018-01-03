<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\Validator\Result\ResultInterface;

class IdenticalValidator extends AbstractComparisonValidator
{
    /**
     * When value is not identical to context.
     *
     * @const string
     */
    public const NOT_IDENTICAL = 'notIdentical';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        $subject = $this->getSubject();
        if ($value === $subject) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_IDENTICAL, [
            'value' => $value,
            'subject' => $subject,
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_IDENTICAL => 'Value {{value}} is not identical to subject {{subject}}.',
        ];
    }
}
