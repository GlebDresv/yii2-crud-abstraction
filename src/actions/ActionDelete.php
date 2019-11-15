<?php

namespace abstractCRUD\actions;

use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

/**
 * Class ActionDelete
 * @package backend\controllers\actions
 */
class ActionDelete extends ActionCRUD
{
    /**
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function run(int $id)
    {
        $model = $this->findModel($id);
        if ($result = $model->delete()) {
            Yii::$app->getSession()->setFlash('danger', Yii::t('backend', 'Record successfully deleted!'));
        }
        return $this->controller->redirect($this->getRedirect());
    }
}
