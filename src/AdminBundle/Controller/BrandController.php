<?php

namespace AdminBundle\Controller;

use DefaultBundle\Entity\Brand;
use DefaultBundle\Form\BrandType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class BrandController extends Controller
{
   /**
     * @Template()
    **/
    public function listAction($id_category)
    {
        $brand = $this->getDoctrine()->getRepository("DefaultBundle:Brand")->find($id_category);;

        return ["brand"=>$brand];
    }

    /**
    * @Template()
     **/
    public function addAction(Request $request)
        {
            $brand= new Brand();
            $form = $this->createForm(BrandType::class, $brand);

            if ($request->isMethod("POST"))
            {
                    $form->handleRequest($request);
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($brand);
                    $manager->flush();
                    return $this->redirectToRoute("admin_cat_list");
                }

            return [
                "form"=>$form->createView()
            ];

        }

    /**
     * @Template()
     *
     **/
    public function editAction()
    {
        return[];
    }

    /**
     * @Template()
     *
     **/
    public function deletAction()
    {
        return[];

    }



    
    
    
    
    
    
}
