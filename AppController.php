<?php

namespace App\Controller;
use App\Entity\Contacte;
use App\Entity\Categories;

use App\Repository\ContacteRepository;

use App\Repository\CategoriesRepository;
use App\Repository\SousCategoriesRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AppController extends AbstractController
{
    /**
     * @Route("/app", name="app")
     */
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

     /**
     * @Route("/vehicules", name="app_vehicules")
     * 
     */
 public function vehicules(CategoriesRepository $categoriesRepository):Response
   {
$categoriesRepository=$this->getDoctrine()->getRepository(Categories::class);

$category = $categoriesRepository->findOneBy(['metier'=> 'vehicules']);

 return $this->render("app/vehicules.html.twig", [
   "sousCategories" => $category->getSousCategorie(),
   "categories"=>$category,
]); 

   }

    /**
     * @Route("/medicale", name="app_medicale")
     * 
     */
 public function medicale(CategoriesRepository $categoriesRepository):Response
 {
$categoriesRepository=$this->getDoctrine()->getRepository(Categories::class);

$category = $categoriesRepository->findOneBy(['metier'=> 'medicale']);

return $this->render("app/medicale.html.twig", [
 "sousCategories" => $category->getSousCategorie(),
 "categories"=>$category,
]); 

 }
   
    /**
     * @Route("/environnement", name="app_environnement")
     * 
     */
 public function environnement(CategoriesRepository $categoriesRepository):Response
 {
$categoriesRepository=$this->getDoctrine()->getRepository(Categories::class);

$category = $categoriesRepository->findOneBy(['metier'=> 'environnement']);


return $this->render("app/environnement.html.twig", [
 "sousCategories" => $category->getSousCategorie(),
 "categories"=>$category,
]); 

 }

  /**
     * @Route("/btp", name="app_btp")
     * 
     */
 public function btp(CategoriesRepository $categoriesRepository):Response
 {
$categoriesRepository=$this->getDoctrine()->getRepository(Categories::class);
$category = $categoriesRepository->findOneBy(['metier'=> 'btp']);

return $this->render("app/btp.html.twig", [
 "sousCategories" => $category->getSousCategorie(),
 "categories"=>$category,
]); 

 }
       /**
     * @Route("/electrique", name="app_electrique")
     * 
     */
 public function electrique(CategoriesRepository $categoriesRepository):Response
 {
$categoriesRepository=$this->getDoctrine()->getRepository(Categories::class);

$category = $categoriesRepository->findOneBy(['metier'=> 'electrique']);

return $this->render("app/electrique.html.twig", [
 "sousCategories" => $category->getSousCategorie(),
 "categories"=>$category,
]); 

 }

       /**
     * @Route("/industrie", name="app_industrie")
     * 
     */
 public function industrie(CategoriesRepository $categoriesRepository):Response
 {
$categoriesRepository=$this->getDoctrine()->getRepository(Categories::class);

$category = $categoriesRepository->findOneBy(['metier'=> 'industrie']);

return $this->render("app/industrie.html.twig", [
 "sousCategories" => $category->getSousCategorie(),
 "categories"=>$category,
]); 

 }
          /**
     * @Route("/solutionIt", name="app_solutionIt")
     * 
     */
 public function solutionIt(CategoriesRepository $categoriesRepository):Response
 {
$categoriesRepository=$this->getDoctrine()->getRepository(Categories::class);

$category = $categoriesRepository->findOneBy(['metier'=> 'solutionIt']);

return $this->render("app/solutionIt.html.twig", [
 "sousCategories" => $category->getSousCategorie(),
 "categories"=>$category,
]); 

 }

   /**
     * @Route("/securite", name="app_securite")
     * 
     */
 public function securite(CategoriesRepository $categoriesRepository):Response
 {
$categoriesRepository=$this->getDoctrine()->getRepository(Categories::class);

$category = $categoriesRepository->findOneBy(['metier'=> 'securite']);

return $this->render("app/securite.html.twig", [
 "sousCategories" => $category->getSousCategorie(),
 "categories"=>$category,
]); 

 }
   /**
     * @Route("/securisation", name="app_securisation")
     * 
     */
 public function securisation(CategoriesRepository $categoriesRepository):Response
 {
$categoriesRepository=$this->getDoctrine()->getRepository(Categories::class);

$category = $categoriesRepository->findOneBy(['metier'=> 'securisation']);

return $this->render("app/securisation.html.twig", [
 "sousCategories" => $category->getSousCategorie(),
 "categories"=>$category,
]); 

 }
     /**
     * @Route("/audiovisuel", name="app_audiovisuel")
     * 
     */
    public function audiovisuel(CategoriesRepository $categoriesRepository):Response
    {
 $categoriesRepository=$this->getDoctrine()->getRepository(Categories::class);
 
 $category = $categoriesRepository->findOneBy(['metier'=> 'audiovisuel']);
 
  return $this->render("app/audiovisuel.html.twig", [
    "sousCategories" => $category->getSousCategorie(),
    "categories"=>$category,
 ]); 
 
    }
   /**
     * @Route("/exotique", name="app_exotique")
     * 
     */
 public function exotique(CategoriesRepository $categoriesRepository):Response
 {
$categoriesRepository=$this->getDoctrine()->getRepository(Categories::class);

$category = $categoriesRepository->findOneBy(['metier'=> 'exotique']);

return $this->render("app/exotique.html.twig", [
 "sousCategories" => $category->getSousCategorie(),
 "categories"=>$category,
]); 

 }
   /**
     * @Route("/informatique", name="app_informatique")
     * 
     */
    public function informatique(CategoriesRepository $categoriesRepository):Response
    {
 $categoriesRepository=$this->getDoctrine()->getRepository(Categories::class);
 
 $category = $categoriesRepository->findOneBy(['metier'=> 'informatique']);
 
  return $this->render("app/informatique.html.twig", [
    "sousCategories" => $category->getSousCategorie(),
    "categories"=>$category,
 ]); 
 
    }
   
}
