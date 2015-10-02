<?php

namespace app\modules\workflow\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use \yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "sw_status".
 *
 * @property string $id
 * @property string $label
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property string $workflow_id
 *
 * @property SwTransition[] $swTransitions
 * @property SwTransition[] $swTransitions0
 * @property SwWorkflow[] $swWorkflows
 */
class SwStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sw_status}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'deleted_at' => time()
                ],
                'replaceRegularDelete' => true,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'workflow_id'], 'required'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['id', 'workflow_id'], 'string', 'max' => 20],
            [['label'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'label' => Yii::t('app', 'Label'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'workflow_id' => Yii::t('app', 'Workflow ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSwTransitions()
    {
        return $this->hasMany(SwTransition::className(), ['end_status_id' => 'id'])->inverseOf('endStatus');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSwTransitions0()
    {
        return $this->hasMany(SwTransition::className(), ['start_status_id' => 'id'])->inverseOf('startStatus');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSwWorkflows()
    {
        return $this->hasMany(SwWorkflow::className(), ['initial_status_id' => 'id'])->inverseOf('initialStatus');
    }
}
