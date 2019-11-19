<?php
/**
 * Created by PhpStorm.
 * User: Hlib Dresviannikov
 * Date: 19.11.2019
 * Time: 5:59
 */

namespace abstractCRUD\example\models;

use yii\db\ActiveRecord;
use warkeeper\yii2_contracts\BackendModelTrait;
use warkeeper\yii2_contracts\BackendSearchModelTrait;
use warkeeper\yii2_contracts\IBackendModel;
use warkeeper\yii2_contracts\IBackendSearchModel;

class ExampleModelSearch extends ExampleModel implements IBackendSearchModel
{
    use BackendSearchModelTrait;
}