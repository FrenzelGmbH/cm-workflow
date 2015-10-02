<?php

namespace app\modules\workflow\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use \yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "sw_transition".
 *
 * @property string $start_status_id
 * @property string $start_status_workflow_id
 * @property string $end_status_id
 * @property string $end_status_workflow_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 *
 * @property SwStatus $endStatus
 * @property SwStatus $startStatus
 */
class SwTransition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sw_transition}}';
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
            [['start_status_id', 'start_status_workflow_id', 'end_status_id', 'end_status_workflow_id'], 'required'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['start_status_id', 'start_status_workflow_id', 'end_status_id', 'end_status_workflow_id'], 'string', 'max' => 20],
            [['end_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => SwStatus::className(), 'targetAttribute' => ['end_status_id' => 'id']],
            [['start_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => SwStatus::className(), 'targetAttribute' => ['start_status_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'start_status_id' => Yii::t('app', 'Start Status ID'),
            'start_status_workflow_id' => Yii::t('app', 'Start Status Workflow ID'),
            'end_status_id' => Yii::t('app', 'End Status ID'),
            'end_status_workflow_id' => Yii::t('app', 'End Status Workflow ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEndStatus()
    {
        return $this->hasOne(SwStatus::className(), ['id' => 'end_status_id'])->inverseOf('swTransitions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartStatus()
    {
        return $this->hasOne(SwStatus::className(), ['id' => 'start_status_id'])->inverseOf('swTransitions0');
    }
}
