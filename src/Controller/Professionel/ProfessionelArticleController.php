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

            $dataName = $request->request->get('name');
            $dataPrice = $request->request->get('price');
            $dataRefs = $request->request->get('reference');
            $datadescription= $request->request->get('description');
            $dataColors = $request->request->get('color');
            $dataSize = $request->request->get('size');
            $datamaterial = $form->get('material')->getData();

//            dump($dataName);dump($dataPrice);
//            dump($dataRefs);dump($datadescription);
//            dump($dataColors);dump($dataSize);
//            dd($datamaterial);
            $entityManager = $this->container->get('doctrine')->getManager();
            foreach ($dataName as $N){
                $article->setName($N);
                $entityManager->persist($article);
            }

            foreach ($datadescription as $D){
                $article->setDescription($D);
                $entityManager->persist($article);
            }

            foreach ($dataRefs as $R){
                $article->setReference($R);
                $entityManager->persist($article);
            }

            foreach ($dataPrice as $P){
                $article->setPrice($P);
                $entityManager->persist($article);
            }

            foreach ($dataColors as $C){
                $color->setNameColor($C);

            }

            $cnt = count($dataSize);
            for ($i = 0; $i < $cnt; ++$i){

                $size->setName($dataSize[$i]);
                $article->addSize($size);

                $entityManager->persist($size);
            }


            $material->setName($datamaterial);
            $article->addMateriel($material);

            $entityManager->persist($article);
            $entityManager->flush();

        }

        $formView = $form->createView();

      return  $this->render('Pro/InsertArticle.html.twig',[
          'form' => $formView,
          'colors' => $colors,
          'sizes' => $sizes,
          'genders' => $gender,
          'typeArticles' => $dataTypeArticle,
//            'data' => $data
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