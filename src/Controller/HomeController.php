<?php


namespace App\Controller;


use App\Repository\TypeArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @Route("/", name="home_page")
     */
    public function HomePage(TypeArticleRepository $typeArticleRepository){

        $categoriesNav = $typeArticleRepository->findAll();

        return $this->render('base.html.twig',
        [
            'categoriesNav'=>$categoriesNav
        ]);
    }
}