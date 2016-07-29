<?php
/**
 * Created by PhpStorm.
 * User: Thierno Thiam
 * Date: 27/07/2016
 * Time: 14:59
 */
namespace OC\PlatformBundle\Controller;
use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Application;
use OC\PlatformBundle\Entity\Category;
use OC\PlatformBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller{
    
    public function indexAction($page){
    // cette fonction correspond à la page d'acceuil de notre application     
      if($page <1){
          throw  new NotFoundHttpException('page '.$page.' est innexistante');
      }else {
          $em  = $this->getDoctrine()->getManager();
          $advertRepo = $em->getRepository("OCPlatformBundle:Advert");
          $advert = $advertRepo->find(1);
        return $this->render('OCPlatformBundle:Advert:index.html.twig',array(
            'advert'=>$advert
        ));
      }
    }
    
    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        // creation de l'image
        $image = new Image();
        $image->setAlt("Hellooo toto");
        $image->setUrl("image.png");
        // creation de la categorie
        $categorie = new Category();
        $categorie->setName("walllaaa demba serrr");
        $advert = new Advert();
        $advert->setAuthor("Thierno ");
        $advert->setContent("bal bala balaa blaa ");
        $advert->setDate(new \DateTime());
        $advert->setTitle("Demba sarr");
        $advert->setImage($image);
        $advert->addCategory($categorie);
        // creation d'application pour l'annonce
        $application = new Application();
        $application->setDate(new \DateTime());
        $application->setContent("Bla blaa je fou rien hannaa nexx lol");
        $application->setAuthor("Demba Sarr");
        $application->setAdvert($advert);

        $application1 = new Application();
        $application1->setDate(new \DateTime());
        $application1->setContent("Bla blaa je fou rien hannaa nexx lol");
        $application1->setAuthor("Demba Sarr");
        $application1->setAdvert($advert);

        $em->persist($advert);
        $em->persist($application);
        $em->persist($application1);
        $em->flush();

        return $this->render("OCPlatformBundle:Advert:view.html.twig",array(
           'advert'=>$advert
        ));
    }
    
    public function editAction($id){
        
    }
    
    public function  viewAction($id){

        return $this->render('OCPlatformBundle:Advert:view.html.twig',array(
           'id'=>$id
        ));
    }
    
    public function removeAction($id){
        
    }
    
    
}