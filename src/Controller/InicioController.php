<?php

namespace App\Controller;

use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InicioController extends AbstractController
{
    #[Route('/', name: 'app_inicio')]
    public function index(): Response
    {
        return $this->render('inicio/index.html.twig');
    }

     #[Route('/login', name: 'api_login', methods: ['GET'])]
     public function indexLogin(UsuarioRepository $usuarioRepository): Response
      {
        $user = $this->getUser();
        $userid = $user->getUserIdentifier();
        $usuario = $usuarioRepository->findOneBy(['email' => $userid]);
        if (!$user) {
            return $this->json([
                'status' => 'error', 
                'message' => 'Usuario no autenticado',
                'user' => [
                    'id' => null,
                    'email' => null,
                ]
            ]);
        }
        
        return $this->json([
            'status' => 'success',
            'user' => [
                'id' => $usuario->getId(),
                'email' => $usuario->getEmail()
            ]
        ]);
      }
}
