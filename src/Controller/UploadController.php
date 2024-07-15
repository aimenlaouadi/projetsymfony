<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\UploadType;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadController extends AbstractController
{
    #[Route('/upload/{id}', name: 'app_upload')]
    public function edit(Request $request, Profile $profile, EntityManagerInterface $em,SluggerInterface $slugger): Response
 

    {
        $form = $this->createForm(UploadType::class, $profile);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Ici, on va ajouter plus tard la logique pour gérer l'upload du fichier
            $profilePic = $form->get('profile_pic_filename')->getData();

            

            if ($profilePic) {

                $originalFilename = pathinfo($profilePic->getClientOriginalName(), PATHINFO_FILENAME);


                $safeFilename = $slugger->slug($originalFilename);
                $filename = $safeFilename . '-' . uniqid() . '.' . $profilePic->guessExtension();


                try {
                    $profilePic->move(
                        'uploads/profile',
                        $filename
                    );
    
                    if ($profile->getProfilePicFilename() !== null) {
                        unlink("uploads/profile/" . $profile->getProfilePicFilename());
                    }    
                $profile->setProfilePicFilename($filename);  
    
                }catch(FileException $e) {
                    $form->addError(new FormError("Erreur lors de l'upload"));
                }
            }


            $em->flush();
            $this->addFlash('success', 'Votre mise à jour à bien était prise en compte, merci!');
            return $this->redirectToRoute('app_upload', ['id' => $profile->getId()]);


        }
    
        return $this->render('upload/index.html.twig', [
            'form' => $form,
            'profile' => $profile    
        ]);
    }






}


