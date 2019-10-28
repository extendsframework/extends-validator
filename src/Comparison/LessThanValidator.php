<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\Validator\Exception\TemplateNotFound;
use ExtendsFramework\Validator\Result\ResultInterface;

class LessThanValidator extends AbstractComparisonValidator
{
    /**
     * When value is not less than context.
     *
     * @const string
     */
    public const NOT_LESS_THAN = 'notLessThan';

    /**
     * @inheritDoc
     * @throws TemplateNotFound
     */
    public function validate($value, $context = null): ResultInterface
    {
        $subject = $this->getSubject();
        if ($value < $subject) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_LESS_THAN, [
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
            self::NOT_LESS_THAN => 'Value {{value}} is not less than subject {{subject}}.',
        ];
    }
}
