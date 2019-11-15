<?php

namespace abstractCRUD\actions;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\Response;
use yii\web\BadRequestHttpException;

/**
 * Class ActionAjaxValidation
 * @package backend\controllers\actions
 */
class ActionAjaxValidation extends ActionCRUD
{
    /**
     * @param null $id
     * @return array
     * @throws BadRequestHttpException
     * @throws \yii\web\NotFoundHttpException
     */
    public function run($id = null)
    {
        $request = Yii::$app->getRequest();
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;
        /** @var Model $model */
        $model = $id === null ? new $modelClass() : $this->findModel($id);
        if ($request->getIsAjax() && $model->load($request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->validate();
            $result = $model->getErrors();
            return $result;
        }

        throw new BadRequestHttpException();
    }
}
