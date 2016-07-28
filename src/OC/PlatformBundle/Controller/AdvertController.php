<?php
/**
 * Created by PhpStorm.
 * User: Thierno Thiam
 * Date: 27/07/2016
 * Time: 14:59
 */
namespace OC\PlatformBundle\Controller;
use OC\PlatformBundle\Entity\Advert;
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
        // pour crrer on recupere le entity manager
        $em = $this->getDoctrine()->getManager();
        $advert = new Advert();
        $advert->setAuthor("Thierno ");
        $advert->setContent("bal bala balaa blaa ");
        $advert->setDate(new \DateTime());
        $advert->setTitle("Demba sarr");
        $em->persist($advert);
        $em->flush();
        return $this->render("OCPlatformBundle:Advert:view.html.twig",array(
           'id'=>$advert->getId(),
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