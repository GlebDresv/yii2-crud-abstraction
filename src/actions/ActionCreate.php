<?php

namespace abstractCRUD\actions;

/**
 * Class ActionCreate
 * @package backend\controllers\actions
 */
class ActionCreate extends ActionCRUD
{
    /**
     * @var string
     */
    public $view = 'create';

    /**
     * @return string|\yii\web\Response
     */
    public function run()
    {
        $modelClass = $this->modelClass;
        $model = new $modelClass();

        if ($this->saveModel($model)) {
            return $this->controller->redirect($this->getRedirect());
        } else {
            $this->controller->layout = $this->layout;
            return $this->controller->render($this->getView(), [
                'model' => $model,
                'enableAjaxValidation' => $this->enableAjaxValidation
            ]);
        }
    }
}
