<?php

namespace app\modules\workflow\controllers\base;

use app\modules\workflow\models\SwStatus;
use app\modules\workflow\models\SwStatusSearch;
use app\controllers\AppController AS Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;

/**
 * SwStatusController implements the CRUD actions for SwStatus model.
 */
class SwStatusController extends Controller
{
    /**
     * @var boolean whether to enable CSRF validation for the actions in this controller.
     * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
     */
    public $enableCsrfValidation = false;

	
	/**
	 * Lists all SwStatus models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel  = new SwStatusSearch;
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
	 * Displays a single SwStatus model.
	 * @param string $id
	 * @param string $workflow_id
     *
	 * @return mixed
	 */
	public function actionView($id, $workflow_id)
	{
        \Yii::$app->session['__crudReturnUrl'] = Url::previous();
        Url::remember();
        Tabs::rememberActiveState();

        return $this->render('view', [
			'model' => $this->findModel($id, $workflow_id),
		]);
	}

	/**
	 * Creates a new SwStatus model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new SwStatus;

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
	 * Updates an existing SwStatus model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @param string $workflow_id
	 * @return mixed
	 */
	public function actionUpdate($id, $workflow_id)
	{
		$model = $this->findModel($id, $workflow_id);

		if ($model->load($_POST) && $model->save()) {
            return $this->redirect(Url::previous());
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing SwStatus model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @param string $workflow_id
	 * @return mixed
	 */
	public function actionDelete($id, $workflow_id)
	{
        try {
            $this->findModel($id, $workflow_id)->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
            \Yii::$app->getSession()->setFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

        // TODO: improve detection
        $isPivot = strstr('$id, $workflow_id',',');
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
	 * Finds the SwStatus model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @param string $workflow_id
	 * @return SwStatus the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id, $workflow_id)
	{
		if (($model = SwStatus::findOne(['id' => $id, 'workflow_id' => $workflow_id])) !== null) {
			return $model;
		} else {
			throw new HttpException(404, 'The requested page does not exist.');
		}
	}
}
