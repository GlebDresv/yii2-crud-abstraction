<?php

namespace abstractCRUD\actions;

use abstractCRUD\models\IBackendModel;
use Closure;
use Yii;
use yii\base\Action;
use yii\base\Model;
use yii\base\UnknownClassException;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Class ActionCRUD
 * @package backend\controllers\actions
 */
abstract class ActionCRUD extends Action
{
    /**
     * @var string
     */
    public $layout = '/main';
    public $viewPath = '@abstractCrud/templates/';

    /**
     * Default view
     *
     * @var string
     */
    public $view = '/templates/index';

    /**
     * @var string|IBackendModel|Model
     */
    public $modelClass;

    /**
     * Redirect action
     *
     * @var string|array|Closure
     */
    public $redirect = ['index'];

    /**
     * @var string
     */
    public $scenario = 'default';

    /**
     * Validate form with AJAX
     *
     * @var bool
     */
    public $enableAjaxValidation = true;

    /**
     * @throws UnknownClassException
     */
    public function init()
    {
        parent::init();
        if (!class_exists($this->modelClass)) {
            throw new UnknownClassException(__CLASS__ . '::$modelClass must be set.');
        }
    }

    /**
     * @param $id
     * @return IBackendModel|ActiveRecord
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        $modelClass = $this->modelClass;
        /** @var ActiveRecord|IBackendModel $model */
        $model = $modelClass::find()->andWhere(['id' => $id])->one();
        if (!$model) {
            throw new NotFoundHttpException('Model not found. Requested class - ' . $modelClass . ', id - ' . $id);
        }
        $model->setScenario($this->scenario);

        return $model;
    }

    /**
     * Manage redirection after form save
     *
     * @return mixed
     */
    public function getRedirect()
    {
        $redirect = $this->redirect;
        $r = null;
        if (Yii::$app->request->get('redirect')) {
            $r = Yii::$app->request->get('redirect');
        } elseif (is_array($redirect)) {
            $r = $redirect;
        } elseif ($redirect instanceof Closure) {
            $r = $redirect();
        }

        return $r;
    }

    /**
     * @param ActiveRecord $model
     * @return bool
     */
    public function saveModel($model): bool
    {
        $success = false;
        if (
        Yii::$app->request->isPost
        ) {
            $model->setScenario($this->scenario);
            $model->load(Yii::$app->request->post());
            $success = $model->save();
        }
        return $success;
    }

    public function getView()
    {
        return $this->viewPath . $this->view;
    }
}
