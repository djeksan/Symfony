<?php

namespace AdminBundle\Controller;

//use DefaultBundle\Entity\Category;
use DefaultBundle\Entity\Category;
use DefaultBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
#use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{

    


    public function deletAction($id)
    {

        $category = $this->getDoctrine()->getRepository("DefaultBundle:Category")->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($category);
        $manager->flush();
        return $this->redirectToRoute("admin_cat_list");




    }

    /**
     * @Template()
     */
    public function listCatAction()
    {
        $categoryList = $this->getDoctrine()->getRepository("DefaultBundle:Category")->findAll();
        return [
            "categoryLis" => $categoryList
        ];

    }

      /**
       * @Template()
     */
    public function editAction(Request $request, $id)
    {

        $category= $this->getDoctrine()->getRepository("DefaultBundle:Category")->find($id);
        $form= $this->createForm(CategoryType::class, $category);
        if ($request->isMethod("POST"))
        {
            $form->handleRequest($request);
            if ($form->isSubmitted())
            {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($category);
                $manager->flush();
                return $this->redirectToRoute("admin_cat_list");
            }
        }

        return [
            "form"=>$form->createView(),
            "category" => $category
        ];

    }

    /**
     *@Template()
    */

    public function AddAction(Request $request)
    {

        $category = new Category();
        $form= $this->createForm(CategoryType::class, $category);
        if ($request->isMethod("POST"))
        {
            $form->handleRequest($request);
            if ($form->isSubmitted())
            {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($category);
                $manager->flush();

                $message = new \Swift_Message();
                $message->setTo("kodaks21@gmail.com");
                $message->setFrom("shop@gmail.com");
                $message->setBody("category was add");


                $this->get('mailer')->send($message);

                return $this->redirectToRoute("admin_cat_list");
            }
        }

        return [
            "form"=>$form->createView()
        ];

    }





}
