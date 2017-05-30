<?php


namespace AdminBundle\Controller;


use DefaultBundle\DefaultBundle;
use DefaultBundle\Entity\Product;


use DefaultBundle\Entity\ProductPhoto;
use DefaultBundle\Form\ProductPhotoType;
use DefaultBundle\Form\ProductType;
use Eventviva\ImageResize;
use function PHPSTORM_META\type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\InsufficientAuthenticationException;

class productPhotoController extends Controller

{
/**
* @Template()
 */
  public function listAction ($id)
  {

    $product = $this->getDoctrine()->getManager()->getRepository("DefaultBundle:Product")->find($id);
    return [
      "product" => $product
    ];
    
  }
       
    /**
    * @Template()
     *
     *
     */
public function addAction (Request $request, $id)

{

  $manager = $this->getDoctrine()->getManager();
  $product = $manager->getRepository("DefaultBundle:Product")->find($id);
    if ($product == null)
    {
        return $this->createNotFoundException("Product not  found");
    }

    $photo= new ProductPhoto();
    $form = $this->createForm(ProductPhotoType::class, $photo);
    if ($request->isMethod("POST"))
    {
      $form->handleRequest($request);
      $filesArr=$request->files->get("defaultbundle_productphoto");


      /**
      * @var UploadedFile $photoFile
      */
      $photoFile = $filesArr["potoFile"];
      $CheckServisImg= $this->get("servis_admin.check_img");
      try {
        $CheckServisImg->check($photoFile);
      } catch (\InvalidArgumentException $ex){
        die ("Image type error");
      }

      $par=$this->getParameter("img_resize_resolution");

      $result=$this->get("servis_admin.img_upload")->uploadImg($photoFile, $id, $par[0]);

      $photo->setSmalfileName($result->getSmallFileName());
      $photo->setProducts($product);
      $photo->setFilename($result->getBigFileName());
      $manager->persist($photo);
      $manager->flush();
      $this->addFlash("add_foto","product");
    }

    return[
        "form" => $form->createView(),
        "product"=> $product

    ];

}

/*
$icon= new Product();
if ($icon->getIcon()!== null)
{echo 1 ;}
dump($product);
die();
*/

    /**
     * @Template()
     *
     */





}