<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\workflow\models\SwTransition $model
 */

$this->title = 'Sw Transition ' . $model->start_status_id . ', ' . Yii::t('app', 'Edit');
$this->params['breadcrumbs'][] = ['label' => 'Sw Transitions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->start_status_id, 'url' => ['view', 'start_status_id' => $model->start_status_id, 'start_status_workflow_id' => $model->start_status_workflow_id, 'end_status_id' => $model->end_status_id, 'end_status_workflow_id' => $model->end_status_workflow_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Edit');
?>
<div class="giiant-crud sw-transition-update">

    <div class="crud-navigation">
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . Yii::t('app', 'View'), ['view', 'start_status_id' => $model->start_status_id, 'start_status_workflow_id' => $model->start_status_workflow_id, 'end_status_id' => $model->end_status_id, 'end_status_workflow_id' => $model->end_status_workflow_id], ['class' => 'btn btn-default']) ?>
    </div>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
