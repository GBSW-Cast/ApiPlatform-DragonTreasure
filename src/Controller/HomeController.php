<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class HomeController extends AbstractController
{
  /**
   * @throws ExceptionInterface
   */
  #[Route('/', name: 'app_home')]
    public function index(NormalizerInterface $normalizer,#[CurrentUser] User $user = null): Response
    {
      return $this->render('home/index.html.twig', [
        'userData' => $normalizer->normalize($user, 'jsonld', [
          'groups' => ['user:read'],
        ]),
      ]);
    }
}
