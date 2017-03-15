<?php

namespace GSB\ObjComBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GSB\ObjComBundle\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;

class ProduitController extends Controller
{
    public function afficherListeAction()
    {
        $repository = $this->getDoctrine()->getRepository('GSBObjComBundle:Produit');
        $listProduit = $repository->findAll();
        // code à venir pour vue
        return $this->render('GSBObjComBundle:Produit:consulterListe.html.twig', array('lesProduits'=>$listProduit));
    }
    public function afficherProduitAction($id)
    {

        //recupération des caractéristiques de la pharmacies dont le numéro est le contenu dans $id
        //$unePharmacie = $this->obtenirUnePharmacie($id);
        $em=$this->getDoctrine()->getManager();
        $produitRepository = $em->getRepository('GSBObjComBundle:Produit');
        $unProduit = $produitRepository->find($id);

        // on demande à la vue d'afficher la pharm
        return $this->render('GSBObjComBundle:Produit:consulter.html.twig', array('leProduit'=>$unProduit));
    }
}
