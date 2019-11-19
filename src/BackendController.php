<?php

namespace abstractCRUD;

use abstractCRUD\actions\ActionAjaxValidation;
use abstractCRUD\actions\ActionCreate;
use abstractCRUD\actions\ActionDelete;
use abstractCRUD\actions\ActionIndex;
use abstractCRUD\actions\ActionUpdate;
use abstractCRUD\actions\ActionView;
use abstractCRUD\formBuilder\FormBuilder;
use warkeeper\yii2_contracts\IAdminUser;
use warkeeper\yii2_contracts\IBackendModel;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Class BackendController
 *
 * @property bool $canCreate
 * @property bool $canUpdate
 * @property bool $canDelete
 *
 * @package backend\components
 */
abstract class BackendController extends Controller
{
    /**
     * @var bool
     */
    public $canCreate = true;

    /**
     * @var bool
     */
    public $canUpdate = true;

    /**
     * @var bool
     */
    public $canDelete = true;

    /**
     * @var string
     */
    public $defaultAction = 'index';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [static::getAdminUserClass()::getAdminRole()],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return string|IBackendModel|ActiveRecord
     */
    abstract public function getModelClass(): string;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => ActionIndex::class,
                'modelClass' => $this->getModelClass(),
            ],
            'update' => [
                'class' => ActionUpdate::class,
                'modelClass' => $this->getModelClass(),
            ],
            'create' => [
                'class' => ActionCreate::class,
                'modelClass' => $this->getModelClass(),
            ],
            'ajax-validation' => [
                'class' => ActionAjaxValidation::class,
                'modelClass' => $this->getModelClass()
            ],
            'view' => [
                'class' => ActionView::class,
                'modelClass' => $this->getModelClass()
            ],
            'delete' => [
                'class' => ActionDelete::class,
                'modelClass' => $this->getModelClass(),
            ],
        ];
    }

    /**
     * @return string|IAdminUser
     */
    abstract protected function getAdminUserClass(): string;

    /**
     * @return string|FormBuilder
     */
    public function getFormBuilderClass()
    {
        return FormBuilder::class;
    }
}
