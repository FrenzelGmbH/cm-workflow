<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\modules\workflow\models\SwStatusSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sw-status-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'label') ?>

		<?= $form->field($model, 'created_by') ?>

		<?= $form->field($model, 'updated_by') ?>

		<?= $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<?php // echo $form->field($model, 'deleted_at') ?>

		<?php // echo $form->field($model, 'workflow_id') ?>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
