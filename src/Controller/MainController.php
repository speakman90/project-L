<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use App\Repository\AboutRepository;
use App\Repository\ProjetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PrestationsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(
        Request $request,
        AboutRepository $aboutRepository,
        PrestationsRepository $prestationsRepository,
        ProjetsRepository $projetsRepository,
        EntityManagerInterface $manager,
        MailerInterface $mailer
        ): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $contact = $form->getData();
            $manager->persist($contact);

            $manager->flush();

            $email = (new Email())
                ->from($contact->getEmail())
                ->to('pierredumas90000@gmail.com')
                ->subject($contact->getSujet())
                ->html($contact->getMessage());

            $mailer->send($email);

            $this->addFlash(
                'success',
                'Votre message à bien était envoyé'
            );
        }
        else {
            $this->addFlash(
                'error',
                "Votre message n'à pas pu être envoyé"
            );
        }

        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
            'about' => $aboutRepository->findBy([], ['id' => 'ASC'], 1)[0],
            'prestations' => $prestationsRepository->findBy([], ['id' => 'ASC'], 3),
            'projets' => $projetsRepository->findBy([], ['id' => 'ASC'], 6),
        ]);
    }

    #[Route('/conditions-generales-vente', name: 'app_cgv')]
    public function cgvView(): Response
    {
        return $this->render('main/cgv.html.twig');
    }

    #[Route('/mentions-legales', name: 'app_ml')]
    public function mlView(): Response
    {
        return $this->render('main/ml.html.twig');
    }

    #[Route('/politique-de-confidentialité', name: 'app_pdc')]
    public function pdcView(): Response
    {
        return $this->render('main/pdc.html.twig');
    }
}
