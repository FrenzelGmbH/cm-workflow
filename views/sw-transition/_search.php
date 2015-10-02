<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\workflow\models\SwTransitionSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sw-transition-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'start_status_id') ?>

		<?= $form->field($model, 'start_status_workflow_id') ?>

		<?= $form->field($model, 'end_status_id') ?>

		<?= $form->field($model, 'end_status_workflow_id') ?>

		<?= $form->field($model, 'created_by') ?>

		<?php // echo $form->field($model, 'updated_by') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<?php // echo $form->field($model, 'deleted_at') ?>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
