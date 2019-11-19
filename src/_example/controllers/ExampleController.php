<?php
/**
 * Created by PhpStorm.
 * User: Hlib Dresviannikov
 * Date: 19.11.2019
 * Time: 5:56
 */

namespace abstractCRUD\example\controllers;

use abstractCRUD\BackendController;
use abstractCRUD\example\models\AdminUser;
use abstractCRUD\example\models\ExampleModel;

class ExampleController extends BackendController
{
    public function getModelClass(): string
    {
        return ExampleModel::class;
    }

    protected function getAdminUserClass(): string
    {
        return AdminUser::class;
    }

}