<?php

namespace abstractCRUD\actions;

use yii\web\NotFoundHttpException;

/**
 * Class ActionView
 *
 * @package backend\controllers\actions
 */
class ActionView extends ActionCRUD
{
    /**
     * @var string
     */
    public $view = 'view';

    /**
     * @param int|string $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function run($id)
    {
        return $this->controller->render($this->getView(), [
            'model' => $this->findModel($id),
        ]);
    }
}
