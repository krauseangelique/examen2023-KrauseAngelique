<?php

namespace App\Controller;

use App\Entity\Chanson;
use App\Form\ChansonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChansonController extends AbstractController
{
    #[Route('/chanson', name: 'app_chanson')]
    public function index(): Response
    {
        return $this->render('chanson/index.html.twig', [
            'controller_name' => 'ChansonController',
        ]);
    }

    // LISTE des chansons
    #[Route('/', name: 'app_liste_chansons')]
    public function liste(): Response
    {
        // Aller rechercher la liste des chansons en DB findAll()


        return $this->render('chanson/index.html.twig', [
            'controller_name' => 'ChansonController',
        ]);
    }

    // FORMULAIRE
    #[Route('/chanson/formulaire', name: 'app_chanson_formulaire')]
    public function new(Request $request): Response
    {
        $genre = new Genre();
        $genre->setGenre('pop');
        $genre->setDescription('annee 70 le top');

        $chanson = new Chanson();
        $chanson->setTitre('Frida um papa');
        $chanson->setGenre($genre);
        $chanson->setDateSortie(new \DateTime('2011-09-25'));

        $form = $this->createForm(ChansonType::class, $chanson);

        $form = $this->createForm(ChansonType::class, $chanson);

        if ($form->isSubmitted() && $form->isValid()) {
            $chanson = $form->getData();

            return $this->redirectToRoute('app_chanson_formulaire');
        }

        return $this->render('chanson/new.html.twig', [
            'form' => $form,
        ]);
    }
}
