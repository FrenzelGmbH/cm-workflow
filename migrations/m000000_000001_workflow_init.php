<?php

use yii\db\Schema;
use yii\db\Migration;

class m000000_000001_workflow_init extends Migration
{
    public function up()
    {
        switch (Yii::$app->db->driverName) {
            case 'mysql':
              $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
              break;
            case 'pgsql':
              $tableOptions = null;
              break;
            case 'mssql':
              $tableOptions = null;
              break;            
            default:
              throw new RuntimeException('Your database is not supported!');
        }

        $this->createTable('{{%sw_status}}',array(
            'id'                    => Schema::TYPE_STRING . '(20) NOT NULL',            
            'label'                 => Schema::TYPE_STRING . '(45) NOT NULL',

            // blamable
            'created_by'            => Schema::TYPE_INTEGER . ' NULL',
            'updated_by'            => Schema::TYPE_INTEGER . ' NULL',

            // timestamps
            'created_at'            => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'            => Schema::TYPE_INTEGER . ' NOT NULL',
            'deleted_at'            => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            
            //foreign keys
            'workflow_id'           => Schema::TYPE_STRING . '(20) NOT NULL',
        ),$tableOptions);

        $this->addPrimaryKey('PK_SW_Status','{{%sw_status}}',['id','workflow_id']);

        $this->createTable('{{%sw_workflow}}',array(
            'id'                    => Schema::TYPE_STRING . '(20) NOT NULL',            
            
            // blamable
            'created_by'            => Schema::TYPE_INTEGER . ' NULL',
            'updated_by'            => Schema::TYPE_INTEGER . ' NULL',

            // timestamps
            'created_at'            => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'            => Schema::TYPE_INTEGER . ' NOT NULL',
            'deleted_at'            => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            
            //foreign keys
            'initial_status_id'     => Schema::TYPE_STRING . '(20) NULL',
        ),$tableOptions);

        $this->addPrimaryKey('PK_SW_Workflow','{{%sw_workflow}}','id');
        $this->addForeignKey('FK_SW_Workflow_SW_Status','{{%sw_workflow}}','initial_status_id','{{%sw_status}}','id');

        $this->createTable('{{%sw_transition}}',array(
            'start_status_id'           => Schema::TYPE_STRING . '(20) NOT NULL',
            'start_status_workflow_id'  => Schema::TYPE_STRING . '(20) NOT NULL',
            'end_status_id'             => Schema::TYPE_STRING . '(20) NOT NULL',
            'end_status_workflow_id'    => Schema::TYPE_STRING . '(20) NOT NULL',
            
            // blamable
            'created_by'            => Schema::TYPE_INTEGER . ' NULL',
            'updated_by'            => Schema::TYPE_INTEGER . ' NULL',

            // timestamps
            'created_at'            => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'            => Schema::TYPE_INTEGER . ' NOT NULL',
            'deleted_at'            => Schema::TYPE_INTEGER . ' DEFAULT NULL',
            
        ),$tableOptions);

        $this->addPrimaryKey('PK_SW_Status','{{%sw_transition}}',['start_status_id','start_status_workflow_id','end_status_id','end_status_workflow_id']);

        $this->addForeignKey('FK_SW_Transition_SW_Status_Start','{{%sw_transition}}','start_status_id','{{%sw_status}}','id');
        $this->addForeignKey('FK_SW_Transition_SW_Status_End','{{%sw_transition}}','end_status_id','{{%sw_status}}','id');
    }

    public function down()
    {
        echo "m000000_000001_workflow_init cannot be reverted.\n";

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
