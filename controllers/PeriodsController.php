<?php

namespace app\controllers;

use Yii;
use app\models\Period;
use app\models\PeriodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\AccessRule;

use app\models\User;
/**
 * PeriodsController implements the CRUD actions for Period model.
 */
class PeriodsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index', 'create', 'view', 'update', 'activate'],
                'rules'=> [
                    [
                        'actions'=>['index', 'view'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions'=>['create','update', 'activate'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMIN, User::ROLE_HEAD]
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Period models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PeriodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Period model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Period model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Period();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Period model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionActivate($id)
    {
        $period = $this->findModel($id);
        $this->deactivate($period->type);
        $period->active = 1;
        $period->save();

        Yii::$app->session->setFlash('info','This period has been activated.');

        return $this->redirect(['/periods/view', 'id'=>$id]);
    }

    private function deactivate($type) 
    {
        Yii::$app->db->createCommand("UPDATE period SET active=0 WHERE type=:tp")
            ->bindValue(':tp', $type)
            ->execute();
    }

    public function actionChangePhase($id, $phase)
    {
        $model = $this->findModel($id);
        $model->phase = $phase;
        $model->save();

        return $this->redirect(['/periods/view', 'id'=>$id]);
    }

    /**
     * Finds the Period model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Period the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Period::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
