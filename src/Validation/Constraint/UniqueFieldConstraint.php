<?php

namespace App\Validation\Constraint;

use App\Validation\ConstraintValidator\UniqueFieldConstraintValidator;
use Symfony\Component\Validator\Constraint;

class UniqueFieldConstraint extends Constraint
{
    public function __construct(
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null,
        private array $fields = [],
    )
    {
        parent::__construct($options, $groups, $payload);
    }

    public function validatedBy(): string
    {
        return UniqueFieldConstraintValidator::class;
    }

    public function getTargets(): string|array
    {
        return self::CLASS_CONSTRAINT;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}