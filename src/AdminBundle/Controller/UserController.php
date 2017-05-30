<?php


namespace AdminBundle\Controller;


use AdminBundle\Entity\User;
use AdminBundle\Form\UserType;
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

class UserController extends Controller


{

    /**
     * @Template()
     */
    public function addAction(Request $request)
    {


        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        if ($request->isMethod("POST")) {
            $form->handleRequest($request);
            $plainpassword = $user->getPlainpassword();
            $password = $this->get("security.password_encoder")->encodePassword($user, $plainpassword);
            $user->setPassword($password);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute("admin_prod_list");
        }

        return [

            "form" => $form->createView()

        ];


    }

    /**
     * @Template()
    */

    public function UserListAction()
    {
        $UserList=$this->getDoctrine()->getRepository("AdminBundle:User")->findAll();

        return [
            "UserList"=> $UserList
        ];


    }

}

