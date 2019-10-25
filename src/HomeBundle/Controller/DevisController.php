<?php
namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;

use \HomeBundle\Entity\Devis;
use \HomeBundle\Form\DevisType;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DevisController extends Controller
{
   public static $PER_PAGE=10;

public function addnewdevisAction(Request $request)
{
$devis = new Devis();
// On crée le FormBuilder grâce à la méthode du contrôleur
$formBuilder = $this->createFormBuilder($devis);
$formBuilder = $this->createForm(DevisType::class, $devis);
$formBuilder->handleRequest($request); 
      
if ($request->isMethod('POST') && $formBuilder->isValid()) {
              $user = $this->get('security.token_storage')->getToken()->getUser();
              $devis->setUser($user);

              // Persist our item element in our own database 
              $em = $this->getDoctrine()->getManager();
              $em->persist($devis);
              $em->flush();
              //Forward text in view
              $request->getSession()->getFlashBag()->add('notice', 'Projet enregistré!');
              return $this->redirectToRoute('add_devis', array('message'=>'Devis crée avec succès!'));
          }else{

            return $this->render('HomeBundle:Formulaires:formDevis.html.twig', array('form' => $formBuilder->createView(), 'message'=>'', 'operation'=>'add'));
}
}


public function listofdevisAction(Request $request) { 
   $page = $request->get('page', 1);
   $key = $request->get('key', null);
   $em=$this->getDoctrine()->getManager();
   $repositoryDevis=$em->getRepository("HomeBundle:Devis");
   $devis = $repositoryDevis->findAllDevisPaginate($key, $page, self::$PER_PAGE);
   
   $pageNumber = $repositoryDevis->countAlldevis($key) / self::$PER_PAGE;
   //print_r($customer);
   //$pageNumber=5;
   $pageNumber = $pageNumber > intval($pageNumber) ? intval($pageNumber) + 1 : $pageNumber;
   $pagination = [
       'page' => $page,
       'count' => round($pageNumber),
       'key' => $key
   ];

   $user = $this->get('security.token_storage')->getToken()->getUser();
   //echo $user->getId();
   return $this->render('HomeBundle:Etats:devisList.html.twig',array(
     "data"=>$devis,
     "pagination" => $pagination,
     "user"=>$user
 ));
}


}