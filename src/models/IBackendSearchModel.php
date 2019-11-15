<?php


namespace abstractCRUD\models;

use yii\data\ActiveDataProvider;

interface IBackendSearchModel
{
    /**
     * @return string|IBackendModel
     */
    public function getModelClass();

    /**
     * @param string $modelClass
     * @return void
     */
    public function setModelClass(string $modelClass);

    /**
     * @param array $data
     * @return ActiveDataProvider
     */
    public function search(array $data = []);

    /**
     * attributes to display in GridView
     *
     * @return array
     */
    public function getColumns();
}