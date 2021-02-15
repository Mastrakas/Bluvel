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
     * @Route("admin/article/insert", name="insert_article")
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

        return $this->render('', [
            'formView' => $formView
        ]);
    }

    /**
     * @Route ("/admin/article/update/{id}", name="update_article")
     */

    public function updateArticle ($id, EntityManagerInterface $entityManager, ArticleRepository $articleRepository, Request $request) {

        $article = $articleRepository->find($id);

        if (is_null($article)){
            return $this->redirectToRoute('');
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success','article modifié');

            //A définir
            //return $this->redirectToRoute();
        }

        $formView = $form->createView();

        return $this->render('',
            [
                'formView' => $formView
            ]);
    }

    /**
     * @Route ("/admin/article/delete/{id}", name="delete_article")
     */
    public function deleteArticle ($id, ArticleRepository $articleRepository, EntityManagerInterface $entitymanager) {
        $article = $articleRepository->find($id);

        if (!is_null($article)) {
            $entitymanager->remove($article);
            $entitymanager->flush();

            $this->addFlash(
                'success',
                "l'article a bien été supprimé"
            );
        }

        return $this->redirectToRoute('');
    }
}