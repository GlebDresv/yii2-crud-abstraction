<?php


namespace abstractCRUD\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

trait BackendModelTrait
{
    private static function getClassReadableName()
    {
        return Inflector::camel2words(StringHelper::basename(static::class));
    }

    /**
     * @return string
     */
    public static function getModelTitle()
    {
        return Yii::t('backend/models', static::getClassReadableName());
    }

    /**
     * @return string
     */
    public static function getAllModelsTitle()
    {
        return Yii::t('backend/models', Inflector::pluralize(static::getClassReadableName()));
    }

    /**
     * @return IBackendSearchModel
     * @throws \Exception
     */
    public static function getSearchModelClass()
    {
        $class = static::class;
        $searchClass = preg_replace_callback(
            '~^(.*\\\)(.*)$~',
            function ($matches) {
                return $matches[1] . 'search\\' . $matches[2] . 'Search';
            },
            $class
        );
        if (!class_exists($searchClass)) {
            throw new \Exception('can\'t find search model');
        }
        return new $searchClass(['modelClass' => static::class]);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isNewRecord()
    {
        if ($this instanceof ActiveRecord) {
            return $this->getIsNewRecord();
        }

        throw new \Exception('Unknown BackendModel type');
    }

    public function getFormAssets()
    {
        return [];
    }

    public function getColumns()
    {
        $columns = $this->attributes();
        return $columns;
    }

    public function getFormConfig()
    {
        $config = [];
        $tab = [];
        foreach ($this->attributes() as $attribute) {
            $tab[$attribute] = [];
        }
        $config[$this->getDefaultFormTabName()] = $tab;
        return $config;
    }

    public function getDefaultFormTabName()
    {
        return \Yii::t('backend/models', 'main tab name for model form');
    }
}