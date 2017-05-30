<?php


namespace AdminBundle\ImgUtil;


use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Exception\InsufficientAuthenticationException;

class CheckImg
{

    private $typeImg;

    public function __construct($imgTypList)
    {


        $this->typeImg = $imgTypList;
    }


    public  function check(UploadedFile $photoFile)
{

    $chekTrue= false;
    $mimetype= $photoFile->getClientMimeType();



    foreach ($this->typeImg as $imgType) {

        if ($mimetype !== $imgType[1]) {

            $chekTrue = true;

        }
    }
    if ($chekTrue !== true) {
        throw new \InvalidArgumentException("Mime type is blocked!");
    }
    $fileEXp =$photoFile->getClientOriginalExtension();
    $chekTrue= false;
    foreach ($this->typeImg as $imgType) {
        if ($fileEXp == $imgType[0] ) {
            $chekTrue = true;

        }
    }
     if ($chekTrue ==false)
     { throw new InsufficientAuthenticationException ("not wrong  Exption");}
    return true;
}

}