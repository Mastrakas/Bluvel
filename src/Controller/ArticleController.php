<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\TypeArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/TypeArticle", name="list_article")
     */
    public function ListArticle($TypeArticle, ArticleRepository $articleRepository, TypeArticleRepository $typeArticleRepository)
    {
        $ListArticle = $articleRepository->findBy($TypeArticle);

        return $this->render('article.html.twig',
        [
           'ListArticle'=>$ListArticle
        ]);
    }
}