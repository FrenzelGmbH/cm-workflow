<?php

namespace app\modules\workflow\controllers\base;

use app\modules\workflow\models\SwTransition;
use app\modules\workflow\models\SwTransitionSearch;
use app\controllers\AppController AS Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;

/**
 * SwTransitionController implements the CRUD actions for SwTransition model.
 */
class SwTransitionController extends Controller
{
    /**
     * @var boolean whether to enable CSRF validation for the actions in this controller.
     * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
     */
    public $enableCsrfValidation = false;

	
	/**
	 * Lists all SwTransition models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel  = new SwTransitionSearch;
		$dataProvider = $searchModel->search($_GET);

		Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * Displays a single SwTransition model.
	 * @param string $start_status_id
	 * @param string $start_status_workflow_id
	 * @param string $end_status_id
	 * @param string $end_status_workflow_id
     *
	 * @return mixed
	 */
	public function actionView($start_status_id, $start_status_workflow_id, $end_status_id, $end_status_workflow_id)
	{
        \Yii::$app->session['__crudReturnUrl'] = Url::previous();
        Url::remember();
        Tabs::rememberActiveState();

        return $this->render('view', [
			'model' => $this->findModel($start_status_id, $start_status_workflow_id, $end_status_id, $end_status_workflow_id),
		]);
	}

	/**
	 * Creates a new SwTransition model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new SwTransition;

		try {
            if ($model->load($_POST) && $model->save()) {
                return $this->redirect(Url::previous());
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            $model->addError('_exception', $msg);
		}
        return $this->render('create', ['model' => $model]);
	}

	/**
	 * Updates an existing SwTransition model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $start_status_id
	 * @param string $start_status_workflow_id
	 * @param string $end_status_id
	 * @param string $end_status_workflow_id
	 * @return mixed
	 */
	public function actionUpdate($start_status_id, $start_status_workflow_id, $end_status_id, $end_status_workflow_id)
	{
		$model = $this->findModel($start_status_id, $start_status_workflow_id, $end_status_id, $end_status_workflow_id);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing SwTransition model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $start_status_id
	 * @param string $start_status_workflow_id
	 * @param string $end_status_id
	 * @param string $end_status_workflow_id
	 * @return mixed
	 */
	public function actionDelete($start_status_id, $start_status_workflow_id, $end_status_id, $end_status_workflow_id)
	{
        try {
            $this->findModel($start_status_id, $start_status_workflow_id, $end_status_id, $end_status_workflow_id)->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            \Yii::$app->getSession()->setFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

        // TODO: improve detection
        $isPivot = strstr('$start_status_id, $start_status_workflow_id, $end_status_id, $end_status_workflow_id',',');
        if ($isPivot == true) {
            return $this->redirect(Url::previous());
        } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
			Url::remember(null);
			$url = \Yii::$app->session['__crudReturnUrl'];
			\Yii::$app->session['__crudReturnUrl'] = null;

			return $this->redirect($url);
        } else {
            return $this->redirect(['index']);
        }
	}

	/**
	 * Finds the SwTransition model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $start_status_id
	 * @param string $start_status_workflow_id
	 * @param string $end_status_id
	 * @param string $end_status_workflow_id
	 * @return SwTransition the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($start_status_id, $start_status_workflow_id, $end_status_id, $end_status_workflow_id)
	{
		if (($model = SwTransition::findOne(['start_status_id' => $start_status_id, 'start_status_workflow_id' => $start_status_workflow_id, 'end_status_id' => $end_status_id, 'end_status_workflow_id' => $end_status_workflow_id])) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
