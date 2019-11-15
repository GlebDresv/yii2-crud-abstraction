<?php

use \yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \abstractCRUD\models\IBackendSearchModel */
/* @var $dataProvider yii\data\BaseDataProvider */

$modelClass = $searchModel->getModelClass();

$this->title = $modelClass::getAllModelsTitle();
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
?>

<div class="row">
    <div class="col-sm-3">
        <?php if ($controller->canDelete) : ?>

            <p>
                <?= Html::a(Yii::t('backend', 'Clear'), 'delete-all', ['class' => 'btn btn-danger', 'data-method' => 'delete']) ?>
            </p>

        <?php endif; ?>
    </div>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $searchModel->getColumns(),
]); ?>



