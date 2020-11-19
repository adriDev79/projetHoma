<?php

namespace App\Controller;

use App\Entity\DepenseAnnexe;
use App\Entity\DepenseFixe;
use App\Entity\Revenu;
use App\Entity\TotauxGestionCompte;
use App\Entity\TypeDepense;
use App\Repository\DepenseAnnexeRepository;
use App\Repository\DepenseFixeRepository;
use App\Repository\RevenuRepository;
use App\Repository\TypeDepenseRepository;
use Doctrine\ORM\EntityManagerInterface;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionCompteController extends AbstractController
{
    /**
     * @Route("/gestionCompte", name="gestion_compte")
     */
    public function index()
    {
        try {
            $typeRepo = $this->getDoctrine()->getRepository(TypeDepense::class);
            $types = $typeRepo->findAll();
            return $this->render('gestion_compte/gestionCompte.html.twig', [
                'types' => $types
            ]);
        } catch (Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->render('gestion_compte/gestionCompte.html.twig', [
                'message' => $message,
                'code' => $code
            ]);
        }
    }

    // Gestion des revenus
    /**
     * @Route("/ajouterRevenu", name="ajouter-revenu", methods={"POST"})
     */
    public function ajouterRevenu(EntityManagerInterface $em, Request $request) : Response {
        try {
            $user = $this->getUser();
            $libelle = $request->request->get("libelle");
            $montant = $request->request->get("montant");
            $revenu = new Revenu();

            if ($libelle !== null && $montant !== null)
            {
                $revenu->setDateRevenu(new \DateTime());
                $revenu->setMontantRevenu($montant);
                $revenu->setLibelleRevenu($libelle);
                $revenu->setIdUser($user->getId());
                $revenu->setUser($user);
                $em->persist($revenu);
                $em->flush();
            }
            return $this->json(['code' => 200, 'message' => 'revenu ajouté'], 200,[], []);
        } catch (Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400);
        }
    }

    /**
     * @Route("/afficherRevenu", name="afficher-revenu", methods={"GET"})
     */
    public function afficherRevenu(RevenuRepository $revenuRepo) : Response {
        try {
            $user = $this->getUser();
            $revenus = $revenuRepo->findBy(['user' => $user]);

            return $this->json($revenus, 200, [], ['groups' => 'revenu:load']);
        }catch (Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400, [],[]);
        }
    }

    /**
     * @Route("/modifierRevenu", name="modifier-revenu", methods={"POST"})
     */
    public function modifierRevenu(EntityManagerInterface $em, Request $request, RevenuRepository $revenuRepo) : Response {
        try {
            $idRevenu = $request->request->get("id");
            $libelleRevenu = $request->request->get("libelle");
            $montantRevenu = $request->request->get("montant");

            $revenu = $revenuRepo->find($idRevenu);
            $revenu->setLibelleRevenu($libelleRevenu);
            $revenu->setMontantRevenu($montantRevenu);
            $revenu->setDateModif(new \DateTime());

            $em->persist($revenu);
            $em->flush();

            return $this->json(['code' => 200, 'message' => 'revenu modifié !'], 200);
        } catch (Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400);
        }
    }

    /**
     * @Route("/supprimerRevenu", name="supprimer-revenu", methods={"DELETE"})
     */
    public function supprimerRevenu(EntityManagerInterface $em, Request $request, RevenuRepository $revenuRepo) : Response {
        try {
            $idRevenu = $request->request->get("id");
            $revenu = $revenuRepo->find($idRevenu);
            $em->remove($revenu);
            $em->flush();

            return $this->json(['code' => 200, 'message' => 'revenu supprimer'], 200);
        } catch(\Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400);
        }
    }

    // Gestion des dépenses fixes
    /**
     * @Route("/ajouterDepenseFixe", name="ajouter-depense-fixe", methods={"POST"})
     */
    public function ajouterDepenseFixe(EntityManagerInterface $em, Request $request, TypeDepenseRepository $typeRepo) : Response {
        try {
            $user = $this->getUser();

            $libelle = $request->request->get("libelle");
            $montant = $request->request->get("montant");
            $idTypeDepense = $request->request->get("id");

            $depenseFixe = new DepenseFixe();

            if ($libelle !== null && $montant !== null && $idTypeDepense !== null)
            {
                $type = $typeRepo->find($idTypeDepense);

                $depenseFixe->setDateCompte(new \DateTime());
                $depenseFixe->setMontantDepenseFixe($montant);
                $depenseFixe->setLibelleDepenseFixe($libelle);
                $depenseFixe->setUser($user);
                $depenseFixe->setTypeDepense($type);
                $em->persist($depenseFixe);
                $em->flush();
            }
            return $this->json(['code' => 200, 'message' => 'dépense fixe ajouté',], 200);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400);
        }
    }

    /**
     * @Route("/afficherDepenseFixe", name="afficher-depense-fixe", methods={"GET"})
     */
    public function afficherDepenseFixe(DepenseFixeRepository $depFixRepo, TypeDepenseRepository $typeRepo) : Response {
        try {
            $user = $this->getUser();
            $depensesFixes = $depFixRepo->findBy(['user' => $user]);
            $typeDepenses = $typeRepo->findAll();

            return $this->json([$depensesFixes, $typeDepenses], 200, [], ['groups' => 'depenseFixe:load']);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400);
        }
    }

    /**
     * @Route("/supprimerDepenseFixe", name="supprimer-depense-fixe", methods={"DELETE"})
     */
    public function supprimerDepenseFixe(EntityManagerInterface $em, Request $request, DepenseFixeRepository $depFixRepo) : Response {
        try {
            $idDepenseFixe = $request->request->get("id");
            $depenseFixe = $depFixRepo->find($idDepenseFixe);
            $em->remove($depenseFixe);
            $em->flush();

            return $this->json(['code' => 200, 'message' => 'Dépense fixe supprimé !'], 200);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400);
        }
    }

    /**
     * @Route("/modifierDepenseFixe", name="modifier-depense-Fixe", methods={"POST"})
     */
    public function modifierDepenseFixe(EntityManagerInterface $em, Request $request, DepenseFixeRepository $depFixRepo, TypeDepenseRepository $typeRepo) : Response {
        try {
            $idDepense = $request->request->get("id");
            $idType = $request->request->get("idType");
            $libelleDepense = $request->request->get("libelle");
            $montantDepense = $request->request->get("montant");

            $depense = $depFixRepo->find($idDepense);
            $typeDepenses = $typeRepo->find($idType);

            $depense->setLibelleDepenseFixe($libelleDepense);
            $depense->setMontantDepenseFixe($montantDepense);
            $depense->setTypeDepense($typeDepenses);
            $depense->setDateModif(new \DateTime());

            $em->persist($depense);
            $em->flush();

            return $this->json(['code' => 200, 'message' => 'revenu modifié !'], 200);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400);
        }
    }

    // Gestion des dépenses annexes
    /**
     * @Route("/ajouterDepenseAnnexe", name="ajouter-depense-annexe", methods={"POST"})
     */
    public function ajouterDepenseAnnexe(EntityManagerInterface $em, Request $request, TypeDepenseRepository $typeRepo) : Response {
        try {
            $user = $this->getUser();

            $libelle = $request->request->get("libelle");
            $montant = $request->request->get("montant");
            $idTypeDepense = $request->request->get("id");

            $depenseAnnexe = new DepenseAnnexe();

            if ($libelle !== null && $montant !== null && $idTypeDepense !== null)
            {
                $type = $typeRepo->find($idTypeDepense);

                $depenseAnnexe->setDateCompte(new \DateTime());
                $depenseAnnexe->setMontantDepenseAnnexe($montant);
                $depenseAnnexe->setLibelleDepenseAnnexe($libelle);
                $depenseAnnexe->setUser($user);
                $depenseAnnexe->setTypeDepense($type);
                $em->persist($depenseAnnexe);
                $em->flush();
            }
            return $this->json(['code' => 200, 'message' => 'dépense annexe ajouté'], 200);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400);
        }
    }

    /**
     * @Route("/afficherDepenseAnnexe", name="afficher-depense-annexe", methods={"GET"})
     */
    public function afficherDepenseAnnexe(DepenseAnnexeRepository $depAnnexeRepo, TypeDepenseRepository $typeRepo) : Response {
        try {
            $user = $this->getUser();
            $depensesAnnexes = $depAnnexeRepo->findBy(['user' => $user]);
            $typeDepenses = $typeRepo->findAll();

            return $this->json([$depensesAnnexes, $typeDepenses], 200, [], ['groups' => 'depenseAnnexe:load']);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400);
        }
    }

    /**
     * @Route("/supprimerDepenseAnnexe", name="supprimer-depense-annexe", methods={"DELETE"})
     */
    public function supprimerDepenseAnnexe(EntityManagerInterface $em, Request $request, DepenseAnnexeRepository $depAnnexeRepo) : Response {
        try {
            $idDepenseAnnexe = $request->request->get("id");
            $depenseAnnexe = $depAnnexeRepo->find($idDepenseAnnexe);
            $em->remove($depenseAnnexe);
            $em->flush();

            return $this->json(['code' => 200, 'message' => 'Dépense annexe supprimé !']);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400);
        }
    }

    /**
     * @Route("/modifierDepenseAnnexe", name="modifier-depense-Annexe", methods={"POST"})
     */
    public function modifierDepenseAnnexe(EntityManagerInterface $em, Request $request, DepenseAnnexeRepository $depAnnexeRepo, TypeDepenseRepository $typeRepo) : Response {
        try {
            $idDepense = $request->request->get("id");
            $idType = $request->request->get("idType");
            $libelleDepense = $request->request->get("libelle");
            $montantDepense = $request->request->get("montant");

            $depense = $depAnnexeRepo->find($idDepense);
            $typeDepenses = $typeRepo->find($idType);

            $depense->setLibelleDepenseAnnexe($libelleDepense);
            $depense->setMontantDepenseAnnexe($montantDepense);
            $depense->setTypeDepense($typeDepenses);
            $depense->setDateModif(new \DateTime());

            $em->persist($depense);
            $em->flush();

            return $this->json(['code' => 200, 'message' => 'dépense annexe modifié !']);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400);
        }
    }

    /**
     * @Route("/afficherTotaux", name="afficher-totaux", methods={"GET"})
     */
    public function afficherTotaux(DepenseAnnexeRepository $depAnnexeRepo, DepenseFixeRepository $depFixRepo, RevenuRepository $revenuRepo) : Response {
        try {
            $user = $this->getUser();
            $ttgc = new TotauxGestionCompte();
            $totalRevenu = 0;
            $totalDpenseAnnexe = 0;
            $totalDpenseFixe = 0;

            $revenus = $revenuRepo->findBy(['user' => $user]);
            $depensesA = $depAnnexeRepo->findBy(['user' => $user]);
            $depensesF = $depFixRepo->findBy(['user' => $user]);

            //calcul total revenu
            foreach ($revenus as $revenu) {
                $val = $revenu->getMontantRevenu();
                $totalRevenu += $val;
            }

            //calcul total dépense annexe
            foreach ($depensesA as $depA){
                $val = $depA->getMontantDepenseAnnexe();
                $totalDpenseAnnexe += $val;
            }

            //calcul total dépense fixe
            foreach ($depensesF as $depF){
                $val = $depF->getMontantDepenseFixe();
                $totalDpenseFixe += $val;
            }

            $totalDpense = $totalDpenseFixe + $totalDpenseAnnexe;
            $solde = $totalRevenu - $totalDpense;

            $ttgc->setTotalRevenu($totalRevenu);
            $ttgc->setTotalDepenseAnnexe($totalDpenseAnnexe);
            $ttgc->setTotalDepenseFixe($totalDpenseFixe);
            $ttgc->setTotalDepense($totalDpense);
            $ttgc->setSolde($solde);

            return $this->json($ttgc, 200, []);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            $code = $exception->getCode();
            return $this->json(['code' => $code, 'message' => $message], 400);
        }
    }

}
