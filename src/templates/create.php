<?php

use yii\helpers\Html;
use warkeeper\yii2_contracts\IBackendModel;

/**
 * @var $this yii\web\View
 * @var $model IBackendModel|\yii\db\ActiveRecord
 * @var $enableAjaxValidation bool
 */

$this->title = Yii::t('backend', "Create {modelClass}", [
    'modelClass' => $model->getModelTitle(),
]);
$this->params['breadcrumbs'][] = ['label' => $model->getAllModelsTitle(), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block block-themed">
    <div class="block-content block-header bg-primary-dark" style="width:100%; float: left;">
        <h1 class="block-title pull-left"><i class="fa fa-cogs"></i> <?= Html::encode($this->title) ?></h1>
    </div>
    <hr>
    <div class="block-content">
        <?= $this->render('_form', [
            'model' => $model,
            'enableAjaxValidation' => $enableAjaxValidation
        ]) ?>
    </div>
</div>
