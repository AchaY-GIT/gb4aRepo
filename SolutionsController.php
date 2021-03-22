<?php

namespace App\Controller;

use App\Entity\Solutions;
use App\Form\SolutionsType;
use App\Repository\SolutionsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/solutions")
 * @IsGranted("ROLE_ADMIN")
 */
class SolutionsController extends AbstractController
{
    /**
     * @Route("/", name="solutions_index", methods={"GET"})
     */
    public function index(SolutionsRepository $solutionsRepository): Response
    {
        return $this->render('solutions/index.html.twig', [
            'solutions' => $solutionsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="solutions_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $solution = new Solutions();
        $form = $this->createForm(SolutionsType::class, $solution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
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
                $solution->setImages($newFilename);
            

        }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($solution);
            $entityManager->flush();

            return $this->redirectToRoute('solutions_index');
        }

        return $this->render('solutions/new.html.twig', [
            'solution' => $solution,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="solutions_show", methods={"GET"})
     */
    public function show(Solutions $solution): Response
    {
        return $this->render('solutions/show.html.twig', [
            'solution' => $solution,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="solutions_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Solutions $solution, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(SolutionsType::class, $solution);
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
                $solution->setImages($newFilename);
            

        }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('solutions_index');
        }

        return $this->render('solutions/edit.html.twig', [
            'solution' => $solution,
            'form' => $form->createView(),
        ]);
    }
       /**
     * @Route("detailSolution/{id}", name="detailSolution_show", methods={"GET"})
     * @IsGranted("ROLE_EDITEUR")
     */
    public function detail(Solutions $solution): Response
    {
      
        return $this->render('app/solutionDetail.html.twig', [
            'solution' => $solution,
        ]);
    }

    /**
     * @Route("/{id}", name="solutions_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Solutions $solution): Response
    {
        if ($this->isCsrfTokenValid('delete'.$solution->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($solution);
            $entityManager->flush();
        }

        return $this->redirectToRoute('solutions_index');
    }
}
