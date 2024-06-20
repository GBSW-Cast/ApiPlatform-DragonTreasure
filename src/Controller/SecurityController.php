<?php

namespace App\Controller;

use ApiPlatform\Api\IriConverterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(IriConverterInterface $iriConverter, #[CurrentUser] User $user = null): Response
    {
        if(! $user ) {
            return $this->json([
                'error' => 'Invalid login rquest: check that the Content-Type header is "application/json"',
            ], 401);
        }

        return new Response(null, 204, [
            'Location' => $iriConverter->getIriFromResource($user),
        ]);
    }
}
