<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use abstractCRUD\models\IBackendModel;

/**
 * @var $this yii\web\View
 * @var $model IBackendModel|\yii\base\Model
 * @var $enableAjaxValidation bool
 */

$action = isset($action) ? $action : '';
$validationUrl = ['ajax-validation'];

if (!$model->isNewRecord()) {
    $validationUrl['id'] = $model->id;
}

?>

<div class="main-form">
    <?php
    /** @var $formBuilder \abstractCRUD\formBuilder\FormBuilder */
    $formBuilder = $this->context->getFormBuilderClass();
    $form = $formBuilder::begin([
        'action' => $action,
        'enableClientValidation' => true,
        'enableAjaxValidation' => $enableAjaxValidation ?? false,
        'validationUrl' => $validationUrl,
        'options' => ['id' => 'main-form', 'class' => 'block']
    ]) ?>

    <?php

    $formConfig = $model->getFormConfig();
    if (count($formConfig) > 1) {
        $items = [];
        foreach ($model->getFormConfig() as $tabName => $tabConfig) {
            $items[] = ['label' => $tabName, 'content' => $form->prepareRows($model, $tabConfig)];
        }
        echo Tabs::widget(['items' => $items, 'navType' => 'nav-tabs nav-tabs-alt']);
    } else {
        echo $form->prepareRows($model, end($formConfig));
    }

    ?>


    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group">
                <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-lg btn-primary']); ?>
            </div>
        </div>
    </div>

    <?php $formBuilder::end() ?>
</div>
