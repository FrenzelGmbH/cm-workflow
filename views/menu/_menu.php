<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php yii\widgets\Block::begin(array('id'=>'sidebar')); ?>

<?php  
    if(!\Yii::$app->user->isGuest){        
        $adminMenu = array();

        $adminMenu[] = array('label'=>'<i class="fa fa-sitemap"></i> (1) '.Yii::t('app','Manage Stati'),'url'=>Url::to(['/mystworkflow/sw-status']));
        $adminMenu[] = array('label'=>'<i class="fa fa-sitemap"></i> (2) '.Yii::t('app','Manage Workflow'),'url'=>Url::to(['/mystworkflow/sw-workflow']));
        $adminMenu[] = array('label'=>'<i class="fa fa-sitemap"></i> (3) '.Yii::t('app','Manage Transitions'),'url'=>Url::to(['/mystworkflow/sw-transition']));
        
        
        echo \kartik\widgets\SideNav::widget([
            'encodeLabels' => false,
            'type' => \kartik\widgets\SideNav::TYPE_INFO,
            'heading' => '<i class="fa fa-reorder"></i> '.Yii::t('app','Menu'),
            'items' => $adminMenu
        ]);
    }
?>

<?php yii\widgets\Block::end(); ?>
