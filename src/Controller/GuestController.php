<?php

namespace App\Controller;

use App\Entity\Guest;
use App\Form\GuestForm;
use App\Infrastructure\FormTrait;
use App\Infrastructure\JsonResponse;
use App\Service\GuestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GuestController extends AbstractController
{
    use FormTrait;

    public function __construct(
        private readonly GuestService $guestService,
    ) {
    }

    #[Route(path: '/api/v1/guests/list', methods: ['GET'])]
    public function actionList(Request $request): Response
    {
        return new JsonResponse($this->guestService->findAll());
    }

    #[Route(path: '/api/v1/guests/create', methods: ['POST'])]
    public function actionCreate(Request $request): Response
    {
        $guest = $this->handleForm(new Guest(), GuestForm::class, json_decode($request->getContent(), true));
        $guest = $this->guestService->save($guest);

        return new JsonResponse($guest, 201);
    }

    #[Route(path: '/api/v1/guests/{id}', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function actionGet(int $id): Response
    {
        $guest = $this->guestService->getGuest($id);

        return new JsonResponse($guest);
    }

    #[Route(path: '/api/v1/guests/update/{id}', requirements: ['id' => '\d+'], methods: ['PATCH'])]
    public function actionUpdate(int $id, Request $request): Response
    {
        $guest = $this->guestService->getGuest($id);
        $updatedGuest = $this->handleForm($guest, GuestForm::class, json_decode($request->getContent(), flags: JSON_OBJECT_AS_ARRAY));
        $this->guestService->save($updatedGuest);

        return new JsonResponse($updatedGuest ,201);
    }

    #[Route(path: '/api/v1/guests/delete/{id}', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function actionDelete(int $id): Response
    {
        $this->guestService->delete($id);

        return new JsonResponse(status: 204);
    }
}