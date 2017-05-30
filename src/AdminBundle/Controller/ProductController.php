<?php

namespace AdminBundle\Controller;

//use DefaultBundle\Entity\Category;

use DefaultBundle\Entity\Product;

use DefaultBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
#use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\ConstraintViolationList;

class ProductController extends Controller
{
    public function deletAction($id)
    {

        $product = $this->getDoctrine()->getRepository("DefaultBundle:Product")->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($product);
        $manager->flush();
        return $this->redirectToRoute("admin_prod_list");


    }

    /**
     * @Template()
     */
    public function listProdAction($page =1)
    {
        //$productList = $this->getDoctrine()->getRepository("DefaultBundle:Product")->findAll();



        $query= $this->getDoctrine()->getManager()
            ->createQuery("select p, c from DefaultBundle:Product p join p.category c")
            ->getResult();
        $pog = $this->get("knp_paginator");
        $productLis= $pog->paginate($query,$page,5);


        return [
            "productLis" => $productLis
        ];



     //   $productList = $this->getDoctrine()->getManager()->createQuery("select p, c from DefaultBundle:producr p join p.category c")
      //      ->getResult();
      //  return [
        //    "productLis" => $productList
      //  ];

    }

      /**
       * @Template()
     */
    public function editAction(Request $request, $id)
    {

        $product= $this->getDoctrine()->getRepository("DefaultBundle:Product")->find($id);
        $form= $this->createForm(ProductType::class, $product);
        if ($request->isMethod("POST"))
        {
            $form->handleRequest($request);
            if ($form->isSubmitted())
            {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($product);
                $manager->flush();
                return $this->redirectToRoute("admin_prod_list");
            }
        }

        return [
            "form"=>$form->createView(),
            "category" => $product
        ];

    }

    /**
     *@Template()
    */

    public function AddAction(Request $request)
    {

        $product = new Product();
        $form= $this->createForm(ProductType::class, $product);
        if ($request->isMethod("POST"))
        {
            $form->handleRequest($request);
            if ($form->isSubmitted() )
            {

                /**
                 * @var ConstraintViolationList $errors
                 */
                $erors = $this->get('validator')->validate($product);
               

                if (count($erors)>0)
                    {
                        foreach ($erors as $err)
                        {
                            $this->addFlash("error", $err->getMessage());
                        }
                        return $this->redirectToRoute("admin_prod_add");
                    }

                $filesArr=$request->files->get("defaultbundle_product");

                /**
                 * @var UploadedFile $photoFile
                 */
                $photoFile = $filesArr["icon"];
                $dir= $this->get('kernel')->getRootDir().'/../web/icon';

                $Icon_name=(rand(0,9999).'.'.$photoFile->guessClientExtension());

                $photoFile->move($dir,$Icon_name);
                $product->setIcon($Icon_name);

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($product);
                $manager->flush();



                $message = new \Swift_Message();
                $message->setTo("kodaks21@gmail.com");
                $message->setFrom("shop@gmail.com");
                $message->setBody("produt was add");
                $this->get('mailer')->send($message);


                return $this->redirectToRoute("admin_prod_list");
            }
        }

        return [
            "form"=>$form->createView()
        ];

    }

    
    
    

}
