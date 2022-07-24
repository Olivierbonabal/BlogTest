<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\Type\CommentType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/article/{slug}', name: 'article_show')]
    public function show(?Article $article): Response
    {
        if(!$article) {
            return $this->redirectToRoute('app_home');
        }
        //liée à l'entity, dès kele commentaire est créer l'article est associé
        $comment = new Comment($article);

        $commentForm = $this->createForm(CommentType::class, $comment);

        return $this->renderForm('article/show.html.twig', [
            'article' => $article,
            'commentForm' => $commentForm,
        ]);
    }
}
