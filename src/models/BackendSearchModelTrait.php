<?php


namespace abstractCRUD\models;

use yii\data\ActiveDataProvider;
use yii\data\BaseDataProvider;
use yii\db\ActiveRecord;
use yii\grid\ActionColumn;

/**
 * Trait BackendSearchModelTrait
 * @package abstractCRUD\models
 */
trait BackendSearchModelTrait
{
    /** @var string|IBackendModel|ActiveRecord */
    private $modelClass;

    /**
     * @return IBackendModel|string
     */
    public function getModelClass()
    {
        return $this->modelClass;
    }

    /**
     * @param string $modelClass
     */
    public function setModelClass(string $modelClass)
    {
        $this->modelClass = $modelClass;
    }

    /**
     * @param array $data
     * @param null $query
     * @return BaseDataProvider
     */
    public function search(array $data = [], $query = null)
    {
        $query = $query ?? $this->modelClass::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($data) && $this->validate())) {
            return $dataProvider;
        }

        foreach ($this->attributes() as $attribute) {
            $query->andFilterWhere([
                $attribute => $this->$attribute,
            ]);
        }

        return $dataProvider;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        $columns = $this->attributes();
        $columns[] = [
            'class' => ActionColumn::class,
        ];
        return $columns;
    }

}