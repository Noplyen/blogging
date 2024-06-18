<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Exceptions\DataNotFoundExceptions;
use App\Helpers\LoggerContext;
use App\Helpers\UuidGenerator;
use App\Libraries\AppLogger;
use App\Services\ImageServices;
use Monolog\Logger;

class ImageController extends BaseController
{
    private ImageServices $imageServices;
    private Logger $myLogger;

    public function __construct()
    {
        $this->myLogger      = AppLogger::LoggerCreations(ImageController::class);
        $this->imageServices = new ImageServices();
    }

    public function index()
    {
        try {
            $result = $this->imageServices->getAll();

            $data =
                [
                    'image_list'=>$result
                ];

            return view("user/admin/image",$data);

        }   catch (DataNotFoundExceptions $e){
            return view("user/admin/image",['message'=>$e->getMessage()]);
        }
    }

    public function savingImage()
    {
        $imageReq = $this->request->getFile('upload');

        // create new name for image, and add the extension
        $newImageName = UuidGenerator::generateUUID(20).".".$imageReq->getClientExtension();

        try{
            // saving into database
            $result = $this->imageServices->saveImage($newImageName,$imageReq);

            // NOTE this response needed from ckeditor
            return $this->response->setJSON([
                'fileName'=>$newImageName,
                'uploaded'=>1,
                'url'=>$result->url
            ]);

        } catch (DataNotFoundExceptions $e) {

            return redirect()->back()->with('message',$e->getMessage());
        }

    }

    public function deleteImage()
    {
        $imageId = $this->request->getVar('id');

        try{
            $this->imageServices->deleteImage($imageId);

            return  redirect()
                ->to(base_url().'admin/images')
                ->with('message','success delete image');

        }catch (DataNotFoundExceptions $exception){
            $context = LoggerContext::setLoggerContext
                        (
                            $exception->getMessage(),
                            $exception->getTrace()
                        );

            $this->myLogger->info
            ('failed delete image with url',$context);

            return redirect()
                ->to(base_url().'admin/images')
                ->with('message','gagal menyimpan image, terjadi kesalahan');
        }
    }
}