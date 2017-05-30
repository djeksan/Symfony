<?php

namespace DefaultBundle\Controller;

use DefaultBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Template
    */
    public function indexAction()
    {
     return [

       "newsList"=>'...',
       "productList"=>'...'
     ];

    }

    public function createCotegoryAction()
    {

        $category = new Category();
        $category->setTitle("asda");
        $category->setDescription("xcvtyhio");
        $category->setImage("с:\\SDF.JPG");

        $manager = $this->getDoctrine()->getManager();
        $manager ->persist($category);
        $manager->flush();
        $response = new Response();
        $response->setContent($category->getId());
        return $response;
    }



    /**
     * @Template
    */
    public function showNewsListAction()
    {
        $newsList=[
            ["title"=> "Description of the network",
            "description"=>" first ? last6 ? me,der"
            ],
            ["title"=> "Description of the apple",
                "description"=>" dir , id code  image"
            ]
                  ];
        return [
            'newsList'=> $newsList
               ];
    }

   /**
    * @Template
   */
    public  function showProductAction($page =1)
  {

      $query= $this->getDoctrine()->getManager()
          ->createQuery("select p, c from DefaultBundle:Product p join p.category c")
          ->getResult();
      $pog = $this->get("knp_paginator");
      $productLis= $pog->paginate($query,$page,7);

    //  dump($query);
     // echo"</<br>>";
    // echo count($query);
  // die();

      return [
          "productLis" => $productLis
      ];

  }


}
