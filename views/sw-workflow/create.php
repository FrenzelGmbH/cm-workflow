<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\modules\workflow\models\SwWorkflow $model
*/

$this->title = Yii::t('app', 'Create');
$this->params['breadcrumbs'][] = ['label' => 'Sw Workflows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giiant-crud sw-workflow-create">

    <div class="clearfix crud-navigation">
        <div class="pull-left">
            <?= Html::a(Yii::t('app', 'Cancel'), \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?= $this->render('_form', [
    'model' => $model,
    ]); ?>

</div>
