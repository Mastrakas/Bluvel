<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\TypeArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/{name}", name="list_article")
     */
    public function ListArticle($name, ArticleRepository $articleRepository, TypeArticleRepository $typeArticleRepository)
    {
        $ListArticle = $articleRepository->findByTypeArticle($name);
        $categoriesNav = $typeArticleRepository->findAll();

        return $this->render('User/AllArticle.html.twig',
        [
           'ListArticle'=>$ListArticle,
            'categoriesNav'=>$categoriesNav
        ]);
    }
}