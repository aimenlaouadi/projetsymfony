<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Profile;
use App\Event\ContactRegisteredEvent;
use App\Form\ContactType;
use App\Form\SearchType;
use App\Mail\MailContact;
use App\Model\SearchData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class, $searchData);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            
            dd($searchData);
        }


        $profiles = $entityManager->getRepository(Profile::class)->findAll();
        return $this->render('index/index.html.twig', [
            'form' => $form,
            'profiles' => $profiles
            
        ]);
    }

    




    #[Route('/profil/{id<\d+>}', name: 'profil_item')]
    public function item(Profile $profile, Request $request, EntityManagerInterface $em, MailContact $contactService, EventDispatcherInterface $dispatcher): Response
    {

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Si tout va bien, alors on peut persister l'entité et valider les modifications en BDD
            $em->persist($contact);
            $em->flush();

            $event = new ContactRegisteredEvent($contact);
            $dispatcher->dispatch($event, ContactRegisteredEvent::NAME);
            //$contactService->sendConfirmation($contact);
           

            $this->addFlash('success', "Merci, votre demande a bien été enregistré");
            return $this->redirectToRoute('app_index');
         }


        return $this->render('contact/profil.html.twig', [
            'profile' => $profile, 
            'form' => $form,
        ]);
    }

    #[Route('/profil/confirm', name: 'app_contact_confirm')]
    public function confirm(): Response
    {
        return $this->render('contact/confirm.html.twig');
    }


    
}
  