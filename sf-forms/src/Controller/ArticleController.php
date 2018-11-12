<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="article_list")
     */
    public function index(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/article/new", name="article_new")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $articleForm = $this->createForm(ArticleFormType::class);

        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $entityManager->persist($articleForm->getData());
            $entityManager->flush();

            $this->addFlash('success', 'The new article is created.');

            return $this->redirectToRoute('article_list');
        }

        return $this->render('article/new.html.twig', [
            'articleForm' => $articleForm->createView(),
        ]);
    }


}
