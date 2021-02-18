<?php


namespace App\Controller\Professionel;




use App\Entity\Article;
use App\Entity\Color;
use App\Entity\Gender;
use App\Entity\Material;
use App\Entity\Size;
use App\Entity\TypeArticle;
use App\Form\ArticleType;
use App\Repository\ColorRepository;
use App\Repository\GenderRepository;
use App\Repository\SizeRepository;
use App\Repository\TypeArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class ProfessionelArticleController extends AbstractController
{

    /**
     * @Route("admin/article/insert", name="insert_article")
     */
    public function NewUser(Request $request,
                            ColorRepository $repository,
                            SizeRepository $sizeRepository,
                            EntityManagerInterface $entityManager,
                            GenderRepository $genderRepository,
                            TypeArticleRepository $typeArticleRepository){
    //récupération des couleurs pour le choix multiple
        // input fait manuellement pour ce champs
        $colors = $repository->findAll();
        $sizes = $sizeRepository->findAll();
        $gender = $genderRepository->findAll();
        $dataTypeArticle = $typeArticleRepository->findAll();

        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $color = new  Color();
            $size = new Size();
            $material = new Material();


            $dataColors= $request->request->get('color');
            $dataSize = $request->request->get('size');
            $datamaterial = $form->get('material')->getData();


            $color->setNameColor($dataColors);
            $article->addColor($color);

            $size->setName($dataSize);
            $article->addSize($size);

            $material->setName($datamaterial);
            $article->addMateriel($material);
//            dd($article);
            $entityManager->persist($article);
//            $entityManager->flush($article);

        }

        $formView = $form->createView();

      return  $this->render('Pro/InsertArticle.html.twig',[
          'form' => $formView,
          'colors' => $colors,
          'sizes' => $sizes,
          'genders' => $gender,
          'typeArticles' => $dataTypeArticle,
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