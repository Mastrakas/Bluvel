<?php


namespace App\Controller\User;


use App\Entity\User;
use App\Entity\UserPro;
use App\Form\UserProType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserProController extends AbstractController
{

    /**
     * @Route("/signup/pro", name="signup_pro")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function NewUser(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder){
        $user = new User();

        $form = $this->createForm(UserProType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
         $siret = $form->get('siret')->getData();
            $user->setFirstname('entreprise');


            $userPro = new  UserPro();

            $userPro->getId();
            $user->setUserPro($userPro);

            $userPro->setSiret($siret);

            $user->getUserPro($userPro);


            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                ));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);


            $entityManager->flush();

//            A définir
//            return $this->redirectToRoute();
        }


        $formView = $form->createView();

        return $this->render('User/ProSignUp.html.twig', [
            'form' => $formView
        ]);
    }
}