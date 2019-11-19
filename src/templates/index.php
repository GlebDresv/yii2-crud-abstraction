<?php

use yii\helpers\Url;
use \yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \warkeeper\yii2_contracts\IBackendSearchModel */
/* @var $dataProvider yii\data\BaseDataProvider */

$modelClass = $searchModel->getModelClass();

$this->title = $modelClass::getAllModelsTitle();
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
?>

<div class="row">
    <div class="col-sm-3">
        <?php if ($controller->canCreate) : ?>
            <a class="block block-link-hover3 text-center" href="<?= Url::to(['create']) ?>">
                <p>
                    <?= Html::a(Yii::t('backend', 'Create new {modelClass}', [
                        'modelClass' => $modelClass::getModelTitle(),
                    ]), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

            </a>
        <?php endif; ?>
    </div>
</div>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $searchModel->getColumns(),
]); ?>



