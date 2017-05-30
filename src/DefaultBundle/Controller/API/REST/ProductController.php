<?php


namespace DefaultBundle\Controller\API\REST;


use DefaultBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends  Controller

{

    
    public  function  detailAction ($id)
    {
        /**
        * @var Product $product
         */
       $product = $this->getDoctrine()->getRepository("DefaultBundle:Product")->find($id);
        
        $ProdArray=[
            'title'=>$product->getTitle(),
            'price'=>$product->getPrice(),
            'data'=>$product->getCreated()->format('d.m.Y'),
            'stock'=>$product->getBalanceStock()
                                   
        ];
        
        $json= new JsonResponse($ProdArray);
        return $json;
        
        
             
        
        
        
        
    }
    
}