<?php

namespace App\Controller;
use App\Entity\Contacte;
use App\Entity\Produits;
use App\Form\ContacteType;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


/**
 * @Route("/produits")
 */
class ProduitsController extends AbstractController
{
    /**
     * @Route("/", name="produits_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(ProduitsRepository $produitsRepository): Response
    {
        return $this->render('produits/index.html.twig', [
            'produits' => $produitsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="produits_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit );
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                   // on stock l image dans la base de donnee
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $produit->setImages($newFilename);
            

        }

            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produits_index');
        }

        return $this->render('produits/new.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produits_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(Produits $produit): Response
    {
        return $this->render('produits/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="produits_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Produits $produit , SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                   // on stock l image dans la base de donnee
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $produit->setImages($newFilename);
            

        }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produits_index');
        }

        return $this->render('produits/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="produits_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Produits $produit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produits_index');
    }



     /**
     * @Route("detail/{id}", name="detail_show", methods={"GET"})
     * @IsGranted("ROLE_EDITEUR")
     */
    public function detail(Produits $produit): Response
    {
      
        return $this->render('app/produitDetail.html.twig', [
            'produit' => $produit,
        ]);
    }
    /**
     * @Route("/contactmessage/{id}", name="produits_contactmessage", methods={"GET","POST"})
     * @IsGranted("ROLE_EDITEUR")
     */
    public function contactmessage( Request $request, Produits $produits ){

        
        $contacte = new Contacte();
        $form = $this->createForm(ContacteType::class, $contacte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $contacte->setProduit($produits);
            $entityManager->persist($contacte);
            $entityManager->flush();
            $this->addFlash('message','votre formulaire a bien étè envoyé ');

            return $this->redirectToRoute('home');
        }

        return $this->render('contacte/new.html.twig', [
            'contacte' => $contacte,
            'form' => $form->createView(),
            'produit'=>$produits
        ]);
    }
}
