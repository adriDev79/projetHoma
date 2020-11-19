<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UpdateProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil/{id}", name="profil", requirements={"id": "\d+" })
     */
    public function AfficherProfil($id)
    {
        $userRepo = $this->getDoctrine()->getRepository(User::class);
        $utilisateur =$userRepo->find($id);

        $user = new User();
        $user = $utilisateur;
        return $this->render('profil/profil.html.twig', [
            'controller_name' => 'ProfilController',
            'user' => $user
        ]);
    }

    /**
     * @Route("/modifier_profil/{id}", name="modifier_profil", requirements={"id": "\d+" })
     */
    public function updateProfil($id, EntityManagerInterface $em, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $userRepo = $this->getDoctrine()->getRepository(User::class);
        $utilisateur =$userRepo->find($id);

        $formUpdateProfil = $this->createForm(UpdateProfilType::class, $utilisateur);
        $formUpdateProfil->handleRequest($request);

        if($formUpdateProfil->isSubmitted() && $formUpdateProfil->isValid())
        {
            $hashed = $encoder->encodePassword($utilisateur, $utilisateur->getPassword());
            $utilisateur->setPassword($hashed);

            $em->persist($utilisateur);
            $em->flush();

            return $this->redirectToRoute('main');
        }
        return $this->render('profil/updateProfil.html.twig', [
            'formUpdateProfil' => $formUpdateProfil->createView(),
            'user' => $utilisateur
        ]);
    }
}
