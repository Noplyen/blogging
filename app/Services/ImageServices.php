<?php

namespace App\Services;

use App\Entities\Image;
use App\Exceptions\DataNotFoundExceptions;
use App\Exceptions\FailedInsertingDataExceptions;
use App\Helpers\LoggerContext;
use App\Helpers\UuidGenerator;
use App\Libraries\AppLogger;
use App\Models\ImageArticleModel;
use CodeIgniter\HTTP\Files\UploadedFile;
use Monolog\Logger;

class ImageServices
{
    private ImageArticleModel $imageArticleModel;
    private Logger $myLogger;
    private Image $image;
    protected const PATH = FCPATH.'images/upload/';

    public function __construct()
    {
        $this->imageArticleModel = new ImageArticleModel();
        $this->myLogger          = AppLogger::LoggerCreations(ImageServices::class);
        $this->image             = new Image();
    }

    /**
     * saving and storing the image, it will generate a random name for image
     * @param string $imageName
     * @param UploadedFile $imageFile request file image to saved
     * @throws FailedInsertingDataExceptions when failed inserting image into database
     */
    public function saveImage($imageName, UploadedFile $imageFile): Image
    {
        // generate an id and path url where's image saved
        $this->image->id = UuidGenerator::generateUUID();
        $this->image->url = base_url().'images/upload/'.$imageName;

        try{
            // apakah file ada, dan apakah file sudah dipindahkan
            if(!$imageFile->hasMoved() && $imageFile->isValid() ){

                // move image
                $imageFile->move(self::PATH,$imageName);

                // saving image
                $this->imageArticleModel->save($this->image);

                // log
                $this->myLogger->info('image already successfully saved',['image-name'=>$imageName]);

                // checking image was successfully move
                if(file_exists(self::PATH.$imageName)){
                    $this->myLogger->info('image already moved to path',['path'=>self::PATH]);
                }
            }

            return $this->image;

        } catch (\ReflectionException $e) {

            throw new FailedInsertingDataExceptions('failed inserting image data into database',$e);
        }
    }

    /**
     * @return array
     * @throws DataNotFoundExceptions when data record on table empty
     */
    public function getAll(): array
    {
        $result = $this->imageArticleModel->findAll();

        if(empty($result)){
            throw new DataNotFoundExceptions('empty data image record');
        }

        return $result;
    }

    /**
     * @param string $imageId
     * @return void
     * @throws DataNotFoundExceptions when data image by url not found
     */
    public function deleteImage(string $imageId): void
    {
        $result = $this->imageArticleModel
            ->where('id',$imageId)
            ->first();

        if(empty($result)){
            throw new DataNotFoundExceptions('image with id %s not found',$imageId);

        }else{
            $this->imageArticleModel->delete($imageId);
            $this->myLogger->info('success deleted image with id',['id'=>$imageId]);
        }

    }
}