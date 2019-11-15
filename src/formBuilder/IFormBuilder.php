<?php

namespace abstractCRUD\formBuilder;

use abstractCRUD\models\IBackendModel;
use yii\base\Model;
use yii\base\ViewContextInterface;
use yii\widgets\ActiveField;
use yii\base\InvalidConfigException;

/**
 * Class FormBuilder
 * @package backend\components
 */
interface IFormBuilder extends ViewContextInterface
{
    /**
     * @param Model|IBackendModel $model
     * @return string|null
     * @throws InvalidConfigException
     */
    public function renderForm(Model $model);


    /**
     * @param Model|IBackendModel $model
     * @param string $attribute
     * @param array $options
     *
     * @return ActiveField
     * @throws InvalidConfigException
     */
    public function renderField(Model $model, $attribute, array $options = []);

    /**
     * @param Model $model
     * @param array $tabConfig
     * @return string
     * @throws InvalidConfigException
     */
    public function prepareRows(Model $model, array $tabConfig): string;
}
