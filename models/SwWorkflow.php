<?php

namespace app\modules\workflow\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use \yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * This is the model class for table "sw_workflow".
 *
 * @property string $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property string $initial_status_id
 *
 * @property SwStatus $initialStatus
 */
class SwWorkflow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sw_workflow}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['id', 'initial_status_id'], 'string', 'max' => 20],
            [['initial_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => SwStatus::className(), 'targetAttribute' => ['initial_status_id' => 'id']],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'initial_status_id' => Yii::t('app', 'Initial Status ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInitialStatus()
    {
        return $this->hasOne(SwStatus::className(), ['id' => 'initial_status_id'])->inverseOf('swWorkflows');
    }
}
