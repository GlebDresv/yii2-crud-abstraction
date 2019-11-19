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
use warkeeper\yii2_contracts\IBackendModel;
use warkeeper\yii2_contracts\IFormBuilder;

/**
 * Class ExampleModel
 * @package abstractCRUD\example\models
 *
 * @property $id int
 * @property $name string
 */
class ExampleModel extends ActiveRecord implements IBackendModel
{
    use BackendModelTrait;

    public static function tableName()
    {
        return 'example_table';
    }

    public function rules()
    {
        return [
            ['id', 'required'],
            ['id', 'unique'],
            ['id', 'numeric'],

            ['name', 'string', 'max' => 200],

            ['someVarUNeedInFormButNotInDb', 'required']
        ];
    }


    public function getFormConfig()
    {
        return [
            $this->getDefaultFormTabName() => [
                'id' => [
                    'fieldOptions' => [],
                    'label' => false,
                    'labelOptions' => [],
                    'hint' => 'this is id field',
                    'hintOptions' => [],
                    'type' => IFormBuilder::INPUT_TEXT,
                    'fieldTypeOptions' => [
                        'class' => 'custom-class'
                    ]
                ],
            ],
            $this->getTranslatedTabName('another tab') => [
                'name' => [
                    'type' => IFormBuilder::INPUT_TEXTAREA,
                ],
            ]
        ];
    }
}