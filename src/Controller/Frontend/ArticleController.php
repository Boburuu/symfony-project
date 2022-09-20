<?php


namespace App\Controller\Frontend;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/details/{slug}', name: 'app.article.show', methods: ['GET', 'POST'])]
    public function showArticle(
        ?Article $article,
        CommentRepository $repoComment,
        Request $request,
        Security $security
    ): Response|RedirectResponse {
        if (!$article instanceof Article) {
            $this->addFlash('error', 'Article non trouve');
            return $this->redirectToRoute('home');
        }

        $comments = $repoComment->findActiveByArticle($article->getId());


        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($security->getUser())
                ->setActive(true)
                ->setArticle($article);
            $repoComment->add($comment, true);

            $this->addFlash('success', 'Commentaire envoyé');

            return $this->redirectToRoute('app.article.show', [
                'slug' => $article->getSlug(),
            ]);
        }

        return $this->renderForm('Frontend/Article/show.html.twig', [
            'article' => $article,
            'form' =>  $form,
            'comments' => $comments,
        ]);
    }
}
