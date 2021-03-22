<?php

namespace App\Controller;

use App\Entity\Contacte;
use App\Form\ContacteType;

use App\Form\ContacteAdminType;
use App\Form\ContacteDevisType;
use Symfony\Component\Mime\Address;
use App\Repository\ContacteRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/contacte")
 */
class ContacteController extends AbstractController
{
    /**
     * @Route("/", name="contacte_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(ContacteRepository $contacteRepository): Response
    {
        
        return $this->render('contacte/index.html.twig', [
            'contactes' => $contacteRepository->findAll(),
        ]);
    }


    // /**
    //  * @var MailerInterface
    //  */
    // private $mailer;

    // public function __construct(MailerInterface $mailer){
    //     $this->mailer=$mailer;
    // }
 


     /**
     * @Route("/new", name="contacte_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contacte = new Contacte();
         
        //   
           $form = $this->createForm(ContacteType::class, $contacte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
           
            
            $contacte->setDate(new \DateTime('now'));
            $entityManager->persist($contacte);
            $entityManager->flush();
            $this->addFlash('message','votre formulaire a bien étè envoyé ');

            return $this->redirectToRoute('home');
        }
        

        return $this->render('contacte/new.html.twig', [
            'contacte' => $contacte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/devis", name="contacte_devis", methods={"GET","POST"})
     * @IsGranted("ROLE_EDITEUR")
     */
    public function devis(Request $request): Response
    {
        $contacte = new Contacte();
        $form = $this->createForm(ContacteDevisType::class, $contacte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $contacte->setDate(new \DateTime('now'));
            $entityManager->persist($contacte);
            $entityManager->flush();
            $this->addFlash('message','votre formulaire a bien étè envoyé ');

            return $this->redirectToRoute('home');
        }
        return $this->render('contacte/devis.html.twig', [
            'contacte' => $contacte,
            'form' => $form->createView(),
        ]);
    }

  /**
     * @Route("/contacteAdmin", name="contacte_admin", methods={"GET","POST"})
     * @IsGranted("ROLE_Admin")
     */
    public function contacteAdmin(Request $request): Response
    {
        $contacte = new Contacte();
        $form = $this->createForm(ContacteAdminType::class, $contacte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $contacte->setDate(new \DateTime('now'));
            $entityManager->persist($contacte);
            $entityManager->flush();
            $this->addFlash('message','votre formulaire a bien étè envoyé ');

            return $this->redirectToRoute('home');
        }

        return $this->render('contacte/admin.html.twig', [
            'contacte' => $contacte,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="contacte_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(Contacte $contacte): Response
    {
        return $this->render('contacte/show.html.twig', [
            'contacte' => $contacte,
        ]);
    }

    
 

    /**
     * @Route("/{id}/edit", name="contacte_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Contacte $contacte, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContacteAdminType::class, $contacte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //envoy de mail dereponce
             $mail = (new TemplatedEmail())
            ->from('gbafrica23@gmail.com')
            ->to($contacte->getEmail())
            ->subject('Thanks for signing up!')

            // path of the Twig template to render
            ->htmlTemplate('emails/contact.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'GB4A',
                'contacte' => $contacte
            ])
        ;

        $mailer->send($mail);
            return $this->redirectToRoute('gestion');
            $this->addFlash('message','votre reponce a bien étè envoyé ');
         

            

        }
        

        return $this->render('contacte/edit.html.twig', [
            'contacte' => $contacte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contacte_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Contacte $contacte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contacte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contacte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contacte_index');
    }
}
