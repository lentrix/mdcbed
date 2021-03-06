<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\AccessRule;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access'=>[
                'class' => AccessControl::className(),
                'ruleConfig'=>[
                    'class' => AccessRule::className()
                ],
                'only' => ['index', 'create', 'update', 'view', 'upload'],
                'rules' =>[
                    [
                        'actions' => ['view','update', 'upload'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'create', 'delete'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMIN]
                    ],
                ],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $identity = Yii::$app->user->identity;

        if($id != $identity->id && $identity->role !== User::ROLE_ADMIN) {
            throw new \yii\web\ForbiddenHttpException('You are not allowed to view this record.');
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setPassword($model->password);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $identity = Yii::$app->user->identity;

        if($identity->role !== User::ROLE_ADMIN && $model->id !== Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('You are not allowed to edit this record.');
        }

        $password = $model->password;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->password !== $password) {
                $model->setPassword($model->password);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpload()
    {
        if(isset($_POST['cropped'])) {
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['cropped']));
            file_put_contents('uploads/avatars/users/' . $_POST['id'] . '.png', $data);
            Yii::$app->session->setFlash('info','User avatar has been changed.');
        }else {
            Yii::$app->session->setFlash('error', 'There was an error in uploding the file.');
        }

        return $this->redirect(['/users/view','id'=>$_POST['id']]);
    }
    
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
