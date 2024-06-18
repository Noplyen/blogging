<?php

namespace App\Request;

use App\Entities\Category;
use App\Exceptions\ValidationExceptions;

class CategoryRequest
{
    /**
     * @param $request
     * @return Category
     * @throws ValidationExceptions error validation
     */
    public function getCategoryRequest($request)
    {
        $name      = $request->getVar("name");

        $validate = $this->validateReq($name);

        if(empty($validate)){
            $category = new Category();

            $category->name = $name;

            return $category;

        }else{
            throw new ValidationExceptions(
                'input tidak sesuai ketentuan',$validate);
        }

    }

    private function validateReq($name)
    {
        $validation = \Config\Services::validation();

        $data = [
            'name'=>$name,
        ];

        $validation->setRules(
            [
                'name' => 'required|alpha_dash|min_length[3]|max_length[30]',
            ]);

        $validation->run($data);

        return $validation->getErrors();
    }
}