<?php

use yii\helpers\Html;
use warkeeper\yii2_contracts\IBackendModel;

/**
 * @var $this yii\web\View
 * @var $model IBackendModel
 * @var $enableAjaxValidation bool
 */

$this->title = Yii::t('backend', 'Update {modelClass}: ', ['modelClass' => $model->getAllModelsTitle()]);
$this->title .= ' ' . ($model->getModelTitle());

$this->params['breadcrumbs'][] = ['label' => $model->getAllModelsTitle(), 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->getModelTitle(),
    'url' => ['view', 'id' => $model->id]
];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');

$controller = $this->context;
?>

<div class="block block-themed">
    <div class="block-header bg-primary-dark">
        <h1 class="block-title pull-left"><i class="fa fa-pencil"></i> <?= Html::encode($this->title) ?></h1>
    </div>
    <div class="block-content">
        <?= $this->render('_form', [
            'model' => $model,
            'enableAjaxValidation' => $enableAjaxValidation
        ]) ?>
    </div>
</div>
