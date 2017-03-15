<?php

namespace GSB\ObjComBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GSBObjComBundle:Default:index.html.twig', array('name' => $name));
    }

    public function bienvenueAction()
    {
        return $this->render('GSBObjComBundle:Default:bienvenue.html.twig');
    }

    public function bienvenuepersoAction($name, $secondname)
    {
        return $this->render('GSBObjComBundle:Default:bienvenueperso.html.twig', array('name' => $name, 'secondname' => $secondname));
    }

}
