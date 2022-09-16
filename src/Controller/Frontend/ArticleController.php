<?php


namespace App\Controller\Frontend;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/details/{slug}', name: 'app.article.show', methods: ['GET'])]
    public function showArticle(?Article $article): Response|RedirectResponse
    {
        if(!$article instanceof Article){
            $this->addFlash('error', 'Article non trouve');
            return $this->redirectToRoute('home');
        }
        return $this->render('Frontend/Article/show.html.twig', [
            'article' => $article,
        ]);
    }

}