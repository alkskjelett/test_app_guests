<?php

namespace App\Validation\ConstraintValidator;

use App\Service\GuestService;
use App\Validation\Constraint\UniqueFieldConstraint;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use UnexpectedValueException;

class UniqueFieldConstraintValidator extends ConstraintValidator
{
    public function __construct(
        private GuestService $guestService,
    ) {
    }

    public function validate(mixed $value, Constraint $constraint)
    {
        if (! $constraint instanceof UniqueFieldConstraint) {
            throw new UnexpectedValueException(sprintf('Expected type %s, got %s', UniqueFieldConstraint::class, $constraint::class));
        }

        foreach ($constraint->getFields() as $field) {
            $method = 'get'.ucfirst($field);
            if (method_exists($value, $method)) {
               $guests = $this->guestService->findOneBy([$field => $value->{'get'.ucfirst($field)}()]);
               if ($guests !== null) {
                   $this->context->buildViolation(sprintf(
                           'Guest with %s = %s already exists',
                           $field,
                           $value->{'get'.ucfirst($field)}())
                       )->addViolation()
                   ;
               }
            }
        }
    }
}