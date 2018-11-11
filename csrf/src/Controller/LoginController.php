<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends AbstractController
{
    public function index(Request $request): Response
    {
        return $this->render('login.html.twig', [
            'content' => 'it works'
        ]);
    }
}
