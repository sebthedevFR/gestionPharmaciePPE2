<?php

namespace GSB\ObjComBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GSB\ObjComBundle\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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


        // on demande à la vue d'afficher le produit
        return $this->render('GSBObjComBundle:Produit:consulter.html.twig', array('leProduit'=>$unProduit));
    }
    public function ajouterProduitAction(Request $request)
    {
        //la demande est de type post = (=soumission du formulaire de création d'une pharmacie)?
        //ou de type get = demande d'affichage du formulaire de création d'une pharmacie)???
        //-----------------------------------------------
        if ($request->isMethod('POST'))
        {
            //la demande est de type POST
            //Récupération des informations saisies dans le formulaire
            //Et creation de la pharmacie dans la base de données
            // On crée un objet instance de produit
            $unProd = new Produit();
            $libelle = $this->get('request')->request->get('libelle');
            $unProd->setLibelle($libelle);
            $prix = $this->get('request')->request->get('prix');
            $unProd->setPrix($prix);

            // si la cache à cocher client est cochée l'attrivut client de l'objet
            // ^$unePharm contiendra true, sinon l'attribut contiendra false

            if (isset($_POST['dispo']))
            {
                $unProd->setDispo(1);
            }
            else
            {
                $unProd->setDispo(0);
            }


            // On récupére le service EntityManager géré par le service Doctrine
            $em = $this->getDoctrine()->getManager();

            // On pérsiste l'entité
            $em->persist($unProd);

            // On flush tout ce qui a été persisté avant
            $em->flush();

            // affichage d'une message flash pour indiquer que la pharmacie à bien était ajoutée
            $this->addFlash('success','l\'article a bien été ajouté');

            //On rvers la page de visualisation de la page crée
            // lid de la pharmacie est en dure à 6
            // !!! code à venir !!
            // récup de l'id de la pharm
            //$url = $this->redirectToRoute('gsb_obj_com_prod_aff_liste');
            return $this->redirectToRoute('gsb_obj_com_prod_aff_liste');
        }
        else
        {
            //la commande est de type get
            //on retourne la vue ajouter qui contiendras le formulaire

            return $this->render('GSBObjComBundle:Produit:ajouter.html.twig');

        }
    }


    public function modifierAction($id, Request $request)
    {
        //la demande est de type post = (=soumission du formulaire de création d'une pharmacie)?
        //ou de type get = demande d'affichage du formulaire de création d'une pharmacie)???
        //-----------------------------------------------
        if($request->isMethod('POST'))
        {
            //la demande est de type POST
            //Récupération des informations saisies dans le formulaire
            //Et creation de la pharmacie dans la base de données
            //!!! code a venir !!!
            $libelle = $this->get('request')->request->get('libelle');
            $prix = $this->get('request')->request->get('prix');



            // si la cache à cocher client est cochée l'attrivut client de l'objet
            // ^$unePharm contiendra true, sinon l'attribut contiendra false
            //$checkbox = $this->get('request')->request->get('client');

            // On récupére le service EntityManager géré par le service Doctrine
            $em = $this->getDoctrine()->getManager();
            $prod = $em->getRepository('GSBObjComBundle:Produit')->find($id);


            $prod->setLibelle($libelle);
            $prod->setPrix($prix);

            if (isset($_POST['dispo']))
            {
                $prod->setDispo(1);
            }
            else
            {
                $prod->setDispo(0);
            }

            // On pérsiste l'entité
            $em->persist($prod);

            // On flush tout ce qui a été persisté avant
            $em->flush();
            // affichage d'une message flash pour indiquer que la pharmacie à bien était ajoutée
            $this->addFlash('success','l\'article a bien été modifié');

            //On rvers la page de visualisation de la page modifié
            // lid de la pharmacie est en dure à 6
            // !!! code à venir !!
            return $this->redirectToRoute('gsb_obj_com_prod_aff_liste');
        }
        else
        {
            // la commande est de type get
            // Accée à la base de donnée pour modifier la pharm selectionné
            $repo = $this->getDoctrine()->getRepository('GSBObjComBundle:Produit');
            $LeProd = $repo->find($id);
            // pour l'instant on recuprer la pharmacie depuis notre tableau mamene
            //$laPharmacie=$this->obtenirUnePharmacie($id);



            // on retourne la vue
            return $this->render('GSBObjComBundle:Produit:modifier.html.twig', array('leProd' => $LeProd));

        }

    }
    public function supprimerAction($id, Request $request)
    {

        //la demande est de type post = (=soumission du formulaire de création d'une pharmacie)?
        //ou de type get = demande d'affichage du formulaire de création d'une pharmacie)???
        //-----------------------------------------------
        if($request->isMethod('POST'))
        {
            //la demande est de type POST
            //Récupération des informations saisies dans le formulaire
            //Et creation de la pharmacie dans la base de données
            //!!! code a venir !!!
            $em = $this->getDoctrine()->getManager();
            $produitRepo = $em->getRepository('GSBObjComBundle:Produit')->find($id);
            $em->remove($produitRepo);
            $em->flush();

            // affichage d'une message flash pour indiquer que la pharmacie à bien était ajoutée
            $this->addFlash('success','l\'article a bien été supprimé');

            //On rvers la page de visualisation de la page modifié
            // lid de la pharmacie est en dure à 6
            return $this->redirectToRoute('gsb_obj_com_prod_aff_liste');
        }
        else
        {

            // la commande est de type get
            // Accée à la base de donnée pour modifier la pharm selectionné

            // pour l'instant on recuprer la pharmacie depuis notre tableau mamene
            $leProduit=$this->getDoctrine()->getRepository('GSBObjComBundle:Produit')->find($id);
            // on retourne la vue
            return $this->render('GSBObjComBundle:Produit:supprimer.html.twig', array('leProd' => $leProduit));
        }
    }
}
