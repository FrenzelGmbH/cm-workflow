<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var app\modules\workflow\models\SwStatus $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>
                <?= $model->id ?>        </h2>
    </div>

    <div class="panel-body">

        <div class="sw-status-form">

            <?php $form = ActiveForm::begin([
            'id' => 'SwStatus',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
            ]
            );
            ?>

            <div class="">
                <?php $this->beginBlock('main'); ?>

                <p>
                    
			<?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'created_by')->textInput() ?>
			<?= $form->field($model, 'updated_by')->textInput() ?>
			<?= $form->field($model, 'created_at')->textInput() ?>
			<?= $form->field($model, 'updated_at')->textInput() ?>
			<?= $form->field($model, 'deleted_at')->textInput() ?>
			<?= $form->field($model, 'workflow_id')->textInput(['maxlength' => true]) ?>
                </p>
                <?php $this->endBlock(); ?>
                
                <?=
    Tabs::widget(
                 [
                   'encodeLabels' => false,
                     'items' => [ [
    'label'   => 'SwStatus',
    'content' => $this->blocks['main'],
    'active'  => true,
], ]
                 ]
    );
    ?>
                <hr/>
                <?php echo $form->errorSummary($model); ?>
                <?= Html::submitButton(
                '<span class="glyphicon glyphicon-check"></span> ' .
                ($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save')),
                [
                    'id' => 'save-' . $model->formName(),
                    'class' => 'btn btn-success'
                ]
                );
                ?>

                <?php ActiveForm::end(); ?>

            </div>

        </div>

    </div>

</div>
