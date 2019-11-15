<?php

namespace abstractCRUD\actions;

use Yii;

/**
 * Class ActionIndex
 * @package backend\controllers\actions
 */
class ActionIndex extends ActionCRUD
{

    /**
     * @var string
     */
    public $view = 'index';

    /**
     * @return string
     */
    public function run()
    {
        $modelClass = $this->modelClass;
        $searchModel = $modelClass::getSearchModelClass();
        $dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams());

        return $this->controller->render($this->getView(), [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
