<?php

namespace app\controllers;

use Yii;
use app\models\Teacher;
use app\models\TeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\AccessRule;
use yii\helpers\Url;

use yii\web\UploadedFile;

use app\models\User;
use app\models\Department;

/**
 * TeachersController implements the CRUD actions for Teacher model.
 */
class TeachersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index','create', 'update', 'view', 'upload','advisory','classes'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'upload','advisory','classes'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create', 'update'],
                        'allow' => true,
                        'roles' => [User::ROLE_ADMIN, User::ROLE_HEAD]
                    ]
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
     * Lists all Teacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpload(){
        if(isset($_POST['cropped'])) {
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['cropped']));
            file_put_contents('uploads/avatars/teachers/' . $_POST['id'] . '.png', $data);
            Yii::$app->session->setFlash('info','Teacher avatar has been changed.');
        }else {
            Yii::$app->session->setFlash('error', 'There was an error in uploding the file.');
        }

        return $this->redirect(['/teachers/view','id'=>$_POST['id']]);
    }

    /**
     * Displays a single Teacher model.
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
     * Creates a new Teacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teacher();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'users' => User::find()->orderBy('username')->all(),
            'departments' => Department::find()->orderBy('longName')->all(),
        ]);
    }

    /**
     * Updates an existing Teacher model.
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
            'users' => User::find()->orderBy('username')->all(),
            'departments' => Department::find()->orderBy('longName')->all(),
        ]);
    }

    public function actionToggleActive($id)
    {
        $model = $this->findModel($id);
        $model->active = !$model->active;
        $model->save();

        Yii::$app->session->setFlash('info',"The teacher $model->fullName has been " . ($model->active?'Activated':'Deactivated'));

        return $this->redirect(['view','id'=>$id]);
    }

    public function actionAdvisory()
    {
        $advisory = Yii::$app->user->identity->teacher->advisory;
        return $this->render('advisory',compact('advisory'));
    }

    public function actionClasses()
    {

    }

    /**
     * Finds the Teacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teacher::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
