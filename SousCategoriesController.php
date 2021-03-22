<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Produits;
use App\Entity\Categories;
use App\Entity\SousCategories;
use App\Form\SousCategoriesType;
use App\Repository\SousCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


/**
 * @Route("/sous/categories")
 * @IsGranted("ROLE_ADMIN")
 */
class SousCategoriesController extends AbstractController
{
    /**
     * @Route("/", name="sous_categories_index", methods={"GET"})
     */
    public function index(SousCategoriesRepository $sousCategoriesRepository): Response
    {
        return $this->render('sous_categories/index.html.twig', [
            'sous_categories' => $sousCategoriesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sous_categories_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $sousCategory = new SousCategories();
        $form = $this->createForm(SousCategoriesType::class, $sousCategory);
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
                $sousCategory->setImages($newFilename);
            

        }
    $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousCategory);
            $entityManager->flush();

            return $this->redirectToRoute('sous_categories_index');
        }

        return $this->render('sous_categories/new.html.twig', [
            'sous_category' => $sousCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_categories_show", methods={"GET"})
     */
    public function show(SousCategories $sousCategory): Response
    {
        return $this->render('sous_categories/show.html.twig', [
            'sous_category' => $sousCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sous_categories_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SousCategories $sousCategory  , SluggerInterface $slugger): Response
    {
        $form = $this->createForm(SousCategoriesType::class, $sousCategory);
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
                $sousCategory->setImages($newFilename);
            

        }
        $this->getDoctrine()->getManager()->flush();
        

            return $this->redirectToRoute('sous_categories_index');
        }

        return $this->render('sous_categories/edit.html.twig', [
            'sous_category' => $sousCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_categories_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SousCategories $sousCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sousCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sous_categories_index');
    }
     /**
  * @Route("/supprime/image/{id}", name="sous_produits_image", methods={"DELETE"})
  */
 public function deleteScImage( Request $request,SousCategories $sousCategory){
    $data = json_decode($request->getContent(), true);

    // On vérifie si le token est valide
    if($this->isCsrfTokenValid('delete'.$sousCategory->getImages(), $request->request->get('_token'))){
        // On récupère le nom de l'image
        $nom = $sousCategory->getImages();
        // On supprime le fichier
        unlink($this->getParameter('image_directory').'/'.$nom);

        // On supprime l'entrée de la base
        $em = $this->getDoctrine()->getManager();
        $em->remove($nom);
        $em->flush();

        // On répond en json
        return new JsonResponse(['success' => 1]);
    }
     else{
        return new JsonResponse(['error' => 'Token Invalide'], 400);
     }

}
}
