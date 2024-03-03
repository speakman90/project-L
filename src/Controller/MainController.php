<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(
        Request $request,
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
                ->to('you@example.com')
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
}
