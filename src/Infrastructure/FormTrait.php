<?php

namespace App\Infrastructure;

use App\Entity\PayloadInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use UnexpectedValueException;

trait FormTrait
{
    public function handleForm(mixed $data, string $class, array $submitData, bool $clearMissing = true): PayloadInterface
    {
        if (! $data instanceof PayloadInterface) {
            throw new UnexpectedValueException('Data param must be entity', 400);
        }

        $form = $this->createForm($class, $data);
        $form->submit($submitData, $clearMissing);

        if (!($form->isSubmitted() && $form->isValid())) {
            throw new BadRequestException($form->getErrors(1)->current()->getMessage(), code: 400);
        }

        return $form->getData();
    }
}