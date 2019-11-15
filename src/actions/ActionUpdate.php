<?php

namespace abstractCRUD\actions;

use yii\web\NotFoundHttpException;

/**
 * Class ActionUpdate
 * @package backend\controllers\actions
 */
class ActionUpdate extends ActionCRUD
{
    /**
     * @var string
     */
    public $view = 'update';

    /**
     * @param int|string $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function run($id)
    {
        $model = $this->findModel($id);

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
