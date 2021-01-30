<?php


namespace App\Controller\Professionel;


use App\Entity\Article;

use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ArticleController extends AbstractController
{

    /**
     * @Route("/Article/Insert", name="insert_article")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function NewUser(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder){
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $article = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($article);
            $entityManager->flush();

//            A définir
//            return $this->redirectToRoute();
        }


        $formView = $form->createView();

        return $this->render('Pro/InsertArticle.html.twig', [
            'form' => $formView
        ]);
    }
}