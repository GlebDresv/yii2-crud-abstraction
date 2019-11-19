<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $model \warkeeper\yii2_contracts\IBackendModel
 */

$controller = $this->context;
$this->title = $model->getModelTitle();
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', $model->getAllModelsTitle()), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title pull-left"><?= Html::encode($this->title) ?></h1>
        <div class="clearfix"></div>
    </div>

    <div class="panel-body">
        <p>
            <?php if ($controller->canUpdate) : ?>
                <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php endif; ?>
            <?php if ($controller->canDelete) : ?>
                <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => $model->getColumns(),
        ]) ?>
    </div>

</div>
