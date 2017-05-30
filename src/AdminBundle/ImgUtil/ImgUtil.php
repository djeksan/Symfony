<?php


namespace AdminBundle\ImgUtil;


use AdminBundle\DTO\UploadImgResult;
use Eventviva\ImageResize;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImgUtil
{
 /**
  * @var CheckImg
  */
    private $chekImg;

    /**
     * @var ImgNameGenerator
    */
    private $imgNameGenerator; 

    private $uploadImgRootDir;
    
    public function __construct(CheckImg $checkImg, ImgNameGenerator $imgNameGenerator)
    {
        $this->chekImg = $checkImg;
        $this->imgNameGenerator = $imgNameGenerator;
            
    }

    public function setUploadImgRootDir($uploadImgRootDir)
    {
        $this->uploadImgRootDir = $uploadImgRootDir;
    }

    
    /**
    * @return UploadImgResult
     *
     */
    
    public  function uploadImg(UploadedFile $uploadedFile, $productId, $resolution)
    {

        $ImgNameGen= $this->imgNameGenerator;
        $photoName = $productId. $ImgNameGen->GeneratorName().".".$uploadedFile->getClientOriginalExtension();
        $photopach =$this->uploadImgRootDir;
        $uploadedFile->move($photopach,$photoName);
        $smalphotoname="smal_".$photoName;
        $im = new ImageResize($photopach.$photoName);
        $im->resizeToBestFit($resolution[0],$resolution[1]);
        $im->save($photopach.$smalphotoname);

        $result = new UploadImgResult($smalphotoname,$photoName);

        return $result;
    }
    
    
}




















