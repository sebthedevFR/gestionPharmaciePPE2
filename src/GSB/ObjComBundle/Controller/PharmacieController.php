<?php

namespace GSB\ObjComBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use GSB\ObjComBundle\Entity\Pharmacie;

class PharmacieController extends Controller
{

    public function indexAction()
    {
        // récupération de la liste des pharmacies
        // --------------
        $repository = $this->getDoctrine()->getManager()->getRepository('GSBObjComBundle:Pharmacie');
        $listPharmacie=$repository->findAll();
        $nbrPharm = count($listPharmacie);

        // récupération de la liste des produits
        // --------------
        $repository = $this->getDoctrine()->getManager()->getRepository('GSBObjComBundle:Produit');
        $listProduit=$repository->findAll();
        $nbrProd = count($listProduit);


        return $this->render('GSBObjComBundle:Pharmacie:index.html.twig', array('nbrPharm'=>$nbrPharm, 'nbrProd'=>$nbrProd));

    }
    public function afficherListeAction()
    {
        // récupération de la liste des pharmacies
        // --------------
        $repository = $this->getDoctrine()->getManager()->getRepository('GSBObjComBundle:Pharmacie');


        $listPharmacie=$repository->findAll();

        // On demande à la vue d'afficher la liste des pharmacies.

        return $this->render('GSBObjComBundle:Pharmacie:consulterListe.html.twig', array('lesPharmacies'=>$listPharmacie));
    }
    public function ajouterAction(Request $request)
    {
        //la demande est de type post = (=soumission du formulaire de création d'une pharmacie)?
        //ou de type get = demande d'affichage du formulaire de création d'une pharmacie)???
        //-----------------------------------------------
        if ($request->isMethod('POST'))
        {
            //la demande est de type POST
            //Récupération des informations saisies dans le formulaire
            //Et creation de la pharmacie dans la base de données
            // On crée un objet instance de pharmacie
            $unePharm = new Pharmacie();
            $nom = $this->get('request')->request->get('nom');
            $unePharm->setNom($nom);
            $ville = $this->get('request')->request->get('ville');
            $unePharm->setVille($ville);


            // si la cache à cocher client est cochée l'attrivut client de l'objet
            // ^$unePharm contiendra true, sinon l'attribut contiendra false
            $checkbox = $this->get('request')->request->get('client');
            if ($checkbox = 1)
            {
                $unePharm->setClient(1);
            }
            else
            {
                $unePharm->setClient(0);
            }


            // On récupére le service EntityManager géré par le service Doctrine
            $em = $this->getDoctrine()->getManager();

            // On pérsiste l'entité
            $em->persist($unePharm);

            // On flush tout ce qui a été persisté avant
            $em->flush();

            // affichage d'une message flash pour indiquer que la pharmacie à bien était ajoutée
            $this->addFlash('success','l\'article a bien été ajouté');
            
            //On rvers la page de visualisation de la page crée
            // lid de la pharmacie est en dure à 6
            // !!! code à venir !!
            // récup de l'id de la pharm
            $url = $this->get('router')->generate('gsb_obj_com_pharm_aff_unepharmacie',array('id'=>$unePharm->getId()));
            return new RedirectResponse($url);


        }
        else
        {
            //la commande est de type get
            //on retourne la vue ajouter qui contiendras le formulaire

            return $this->render('GSBObjComBundle:Pharmacie:ajouter.html.twig');

        }
    }
    public function afficherPharmacieAction($id)
    {

        //recupération des caractéristiques de la pharmacies dont le numéro est le contenu dans $id
        //$unePharmacie = $this->obtenirUnePharmacie($id);
        $em=$this->getDoctrine()->getManager();
        $pharmacieRepository = $em->getRepository('GSBObjComBundle:Pharmacie');
        $unePharmacie = $pharmacieRepository->find($id);

        // on demande à la vue d'afficher la pharm
        return $this->render('GSBObjComBundle:Pharmacie:consulter.html.twig', array('laPharmacie'=>$unePharmacie));
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
            // On crée un objet instance de pharmacie
            //$unePharm = new Pharmacie();
            $nom = $this->get('request')->request->get('nom');
            //$unePharm->setNom($nom);
            $ville = $this->get('request')->request->get('ville');
            //$unePharm->setVille($ville);


            // si la cache à cocher client est cochée l'attrivut client de l'objet
            // ^$unePharm contiendra true, sinon l'attribut contiendra false
            //$checkbox = $this->get('request')->request->get('client');

            // On récupére le service EntityManager géré par le service Doctrine
            $em = $this->getDoctrine()->getManager();
            $pharm = $em->getRepository('GSBObjComBundle:Pharmacie')->find($id);

            if (!$pharm)
            {
                throw $this->createNotFoundException('Pas de pharmacie trouvé.'.$id);
            }
            $pharm->setNom($nom);
            $pharm->setVille($ville);

            if (isset($_POST['client']))
            {
                $pharm->setClient(1);
            }
            else
            {
                $pharm->setClient(0);
            }

            // On pérsiste l'entité
            $em->persist($pharm);

            // On flush tout ce qui a été persisté avant
            $em->flush();
            // affichage d'une message flash pour indiquer que la pharmacie à bien était ajoutée
            $this->addFlash('success','l\'article a bien été modifié');

            //On rvers la page de visualisation de la page modifié
            // lid de la pharmacie est en dure à 6
            // !!! code à venir !!
            $url = $this->get('router')->generate('gsb_obj_com_pharm_aff_unepharmacie',array('id'=>$id));
            return new RedirectResponse($url);
        }
        else
        {
            // la commande est de type get
            // Accée à la base de donnée pour modifier la pharm selectionné
            $repo = $this->getDoctrine()->getRepository('GSBObjComBundle:Pharmacie');
            $laPharm = $repo->find($id);
            // pour l'instant on recuprer la pharmacie depuis notre tableau mamene
            //$laPharmacie=$this->obtenirUnePharmacie($id);



            // on retourne la vue
            return $this->render('GSBObjComBundle:Pharmacie:modifier.html.twig', array('laPharm' => $laPharm));

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
            $pharmacieRepo = $em->getRepository('GSBObjComBundle:Pharmacie')->find($id);

            $em->remove($pharmacieRepo);
            $em->flush();

            // affichage d'une message flash pour indiquer que la pharmacie à bien était ajoutée
            $this->addFlash('success','l\'article a bien été supprimé');

            //On rvers la page de visualisation de la page modifié
            // lid de la pharmacie est en dure à 6
            // !!! code à venir !!
            $url = $this->get('router')->generate('gsb_obj_com_pharm_aff_unepharmacie',array('id'=>$id));
            return $this->redirectToRoute('gsb_obj_com_pharm_aff_liste');

        }
        else
        {

            // la commande est de type get
            // Accée à la base de donnée pour modifier la pharm selectionné

            // pour l'instant on recuprer la pharmacie depuis notre tableau mamene
            $laPharmacie=$this->getDoctrine()->getRepository('GSBObjComBundle:Pharmacie')->find($id);
            // on retourne la vue
            return $this->render('GSBObjComBundle:Pharmacie:supprimer.html.twig', array('laPharm' => $laPharmacie));
        }
    }
    public function obtenirListePharmacie()
    {
        $lesPharmacies = array(
            array('id'=>1, 'nom'=>'Pharmacie du rond-point des champs', 'ville'=>'paris'),
            array('id'=>2, 'nom'=>'Pharmacie de la Seine', 'ville'=>'paris'),
            array('id'=>3, 'nom'=>'Pharmacie des lilas', 'ville'=>'lyon'),
            array('id'=>4, 'nom'=>'Pharmacie de Montmartre', 'ville'=>'paris'),
            array('id'=>5, 'nom'=>'Pharmacie des bouchons', 'ville'=>'lyon'),
            );
        return $lesPharmacies;
    }
    public function obtenirUnePharmacie($num)
    {
        $lesPharm = $this->obtenirListePharmacie();
        $ind = 0;
        $trouve = false;
        while ($trouve==false && $ind<count($lesPharm))
        {
            $unePharm = $lesPharm[$ind];
            if ($unePharm['id']==$num)
            {
                $trouve=true;
            }
            else
            {
                $ind++;
            }

        }
        if ($trouve==false)
        {
            return $lesPharm[0];
        }
        else
            return $lesPharm[$ind];
    }
    public function menuDernPharmAction($nb)
    {
        //on affiche les nb premières pharmacies crées
        //-------------------------------------
        $lesPharmSelectionnees = array();
        $indSel=0;
        // on récupére les pharmacies crées en dur
        $lesPharm = $this->obtenirListePharmacie();

        // on parcourt les pharmacies pour ne garder que les nb dernières
        // ($ind=count($lesPharm)-1;$ind>=count($lesPharm)-$nb; $ind -= 1)
        //{
         //   $lesPharmSelectionnees[$indSel] = $lesPharm[$ind];
         //   $indSel++;
        //}
        $repository = $this->getDoctrine()->getManager()->getRepository('GSBObjComBundle:Pharmacie');

        $lesPharm=$repository->dernieresPharmaciesCrees($nb);

        // On deande à la vue d'afficher la liste des pharmacies sélectionnées
        return $this->render('GSBObjComBundle:Pharmacie:menuDernPharmacie.html.twig', array('lesPharmacies' => $lesPharm));
    }



}
