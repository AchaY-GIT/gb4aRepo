<?php

namespace App\Controller;

use App\Entity\Contacte;
use App\Entity\User;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



    /**
     * @Route("/admin", name="admin_")
     */
    
class AdminController extends AbstractController
{
     /**
      * daschbord
      * @Route("/gestion", name="admin")
      */
    public function index(): Response
    {

        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    //  /**
    //   * lister les utilisateurs du site
    //   * @Route("/utilisateurs", name="utilisateurs")
    //   */
    // public function userList(UserRepository $user){
    //     return $this->render("admin/user.html.twig",[
    //         'user'=>$user->findAll()
    //     ]);


    // }

    // /**
    //   * modifier la lister les utilisateurs du site
    //   * @Route("/{id}/utilisateurs/modifier/", name="modifier_utilisateurs")
    //   */
    //   public function editUser(User $user, Request $request){
    //     $form= $this->createForm(EditUserType::class,$user);
    //     $form->handleRequest($request);

    //     if($form->isSubmitted()&& $form->isValid()){
    //         $entityManager= $this->getDoctrine()->getManager();
    //         $entityManager->persist($user);
    //         $entityManager->flush();

         
    //         $this->addFlash('message', 'utilisateur modifié avec succès');
    //         return $this->redirectToRoute('admin_utilisateurs');
    //     } 
    //     return $this->render("admin/editUtilisateurs.html.twig",[
    //         'userForm' =>$form->createView()
    //     ]);
    // }


    
    // /**
    //  * @Route("/delate/{id}", name="user_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, User $user): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($user);
    //         $entityManager->flush();
    //     }
    //     $this->addFlash('message', 'utilisateur supprimé avec succès');
    //     return $this->redirectToRoute('admin_utilisateurs');
      
    // }
    

    //   /**
    //   * @Route("/mail", name="mail", methods={"GET","POST"})
    //   */
    /* public function new(Request $request, Contacte $contacte, MailerInterface $mailer): Response
     {
         $contacte = new Contacte();
         $form = $this->createForm(ContacteType::class, $contacte);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $email = $form->get('email')->getData();
         $mail = (new TemplatedEmail())
             ->from('gbafrica@gmail.com')
             ->to($email)
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
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($contacte);
             $entityManager->flush();
             $this->addFlash('message','votre formulaire a bien étè envoyé ');

             return $this->redirectToRoute('contacte/show.html.twig');
         }


         return $this->render('contacte/nouveau.html.twig', [
             'contacte' => $contacte,
             'form' => $form->createView(),
         ]);

     }*/
    
}
