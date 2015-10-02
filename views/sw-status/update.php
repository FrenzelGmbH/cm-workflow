<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\workflow\models\SwStatus $model
 */

$this->title = 'Sw Status ' . $model->id . ', ' . Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = ['label' => 'Sw Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id, 'workflow_id' => $model->workflow_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Edit');
?>
<div class="giiant-crud sw-status-update">

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . Yii::t('app', 'View'), ['view', 'id' => $model->id, 'workflow_id' => $model->workflow_id], ['class' => 'btn btn-default']) ?>
    </div>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
