<?php

namespace App\Services;

use App\Entities\Category;
use App\Exceptions\AlreadyExistExceptions;
use App\Exceptions\DataNotFoundExceptions;
use App\Exceptions\FailedDeleteDataExceptions;
use App\Exceptions\FailedInsertingDataExceptions;
use App\Exceptions\FailedUpdateDataExceptions;
use App\Helpers\LoggerContext;
use App\Helpers\UuidGenerator;
use App\Libraries\AppLogger;
use App\Models\CategoryModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use Monolog\Logger;

class CategoryServices
{
    private CategoryModel $categoryModel;
    private Logger $myLogger;
    private Category $category;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->myLogger      = AppLogger::LoggerCreations(CategoryServices::class);
        $this->category      = new Category();
    }

    public function getAllCategory()
    {
        $result = $this->categoryModel->isCategoryTableEmpty();

        if($result){
            throw new DataNotFoundExceptions('data record category empty');
        }

        return $this->categoryModel->asArray()->findAll();
    }

    public function countCategory()
    {
        return $this->categoryModel->countAllResults();
    }

    /**
     * get all category with article, where used left join
     * which is get all data category {no matter have relation or no at article}
     * @throws DataNotFoundExceptions record data empty
     */
    public function getCategoryUsedByArticle(): array
    {
        // checking the table, when not empty execute code
        if(!$this->isCategoryTableEmpty())
        {
            $result = $this->categoryModel
                ->select('article.id as article_id')
                ->select('category.id as category_id, category.name as category_name')
                ->join('article','category.id = article.category_id','left')
                ->findAll();

            return $result;

        }else{
            throw new DataNotFoundExceptions('data record category not found');
        }

    }

    /**
     * @return bool true when empty data on table
     */
    private function isCategoryTableEmpty(): bool
    {
        if(empty($this->categoryModel->findAll())){
            return true;
        }
        return false;
    }

    /**
     * @param Category $categoryReq
     * @return array|object|null
     * @throws AlreadyExistExceptions name of category already exist
     *
     */
    public function createCategory(Category $categoryReq)
    {
        // is name exist?
        $result = $this->categoryModel
            ->where('name',$categoryReq->name)
            ->first();

        try{
            // if name not exist
            if($result==null){

                // inserting data
                $categoryReq->id = UuidGenerator::generateUUID();
                $categoryReq->name = strtolower($categoryReq->name);

                $this->categoryModel->save($categoryReq);

                $this->myLogger->info('success saved category',['category-name'=>$categoryReq->name]);

                return $result;

            }else{
                throw new AlreadyExistExceptions("name category already exist");
            }

        }catch (\ReflectionException $e){
             throw new FailedInsertingDataExceptions('failed to save data category',$e);
        }

    }

    /**
     * @param $idCategory
     * @return void
     * @throws DataNotFoundExceptions category id not found
     */
    public function deleteCategory($idCategory): void
    {
        try{
            // is data exist, if not get error exception
            $this->getById($idCategory);

            $this->categoryModel->delete($idCategory);

        }catch (DatabaseException $exception){

            throw new FailedDeleteDataExceptions('failed delete category',$exception);

        }
    }

    /**
     * @param $id
     * @return array
     * @throws DataNotFoundExceptions when data not found
     */
    public function getById($id): array
    {
        $result = $this->categoryModel->find($id);

        if($result==null){
            throw new DataNotFoundExceptions("data category not found with id %s",$id);
        }

        return $result;
    }

    /**
     * @param string $idCategory
     * @param Category $category
     * @throws DataNotFoundExceptions category data not found
     */
    public function updateCategory(string $idCategory, Category $category)
    {
        try{
            // is data exist, if not get error exception
            $this->getById($idCategory);

            $this->categoryModel->update($idCategory,$category);

        }catch (\ReflectionException $exception) {

            throw new FailedUpdateDataExceptions('failed to update category data', $exception);

        }
    }

    /**
     * @throws DataNotFoundExceptions empty record data category
     */
    public function getAllKategori(): array
    {
        $result = $this->isCategoryTableEmpty();

        if($result){
            throw new DataNotFoundExceptions('empty data category');
        }

        return $this->categoryModel->findAll();
    }

}