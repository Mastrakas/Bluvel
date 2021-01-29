<?php


namespace App\Controller\User;


use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;

class UserController extends AbstractController
{

    /**
     * @Route("/form/signup", name="signup_page")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function NewUser(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder){
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

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

        return $this->render('User/SignUpForm.html.twig', [
            'form' => $formView
        ]);
    }
}