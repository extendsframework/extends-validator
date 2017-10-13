<?php
declare(strict_types=1);

namespace Example;

use ExtendsFramework\Validator\Constraint\Collection\AndConstraint;
use ExtendsFramework\Validator\Constraint\Type\StringConstraint;
use ExtendsFramework\Validator\Constraint\Uuid\UuidConstraint;

require_once __DIR__ . '/../vendor/autoload.php';

$constraint = new AndConstraint();
$constraint
    ->addConstraint(new StringConstraint())
    ->addConstraint(new UuidConstraint());

$valid = $constraint->validate('608fc8cb-fb65-4ab1-a34a-25ba0890839d');
var_dump($valid);

$nonString = $constraint->validate(9);
var_dump($nonString);

$nonUuid = $constraint->validate('foo');
var_dump($nonUuid);
