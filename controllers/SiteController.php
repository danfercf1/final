<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Estudiantes;
use app\models\EstudiantesBusqueda;
use app\models\Ue;
use app\models\CustomForm;
use app\models\UeBusqueda;
use yii\data\ActiveDataProvider;
use yii\mongodb\Query;
use yii\mongodb\Collection;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionMongotest()
    {
        $query = new Query;
        // compose the query
        $query->select(['email'])
            ->from('datos_usuarios')
            ->limit(10);
        // execute the query
        $rows = $query->all();

        return $this->render('mongo', [
            'data' => $rows,
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
  
    public function actionClasificados()
    {
        return $this->render('clasificados');
    }
    
    public function actionEstadisticas()
    {
        return $this->render('estadisticas');
    }
    
    public function actionReportes()
    {
        return $this->render('reportes');
    }
    
    public function actionR_general()
    {
        $searchModel = new EstudiantesBusqueda();
        $dataProvider = new ActiveDataProvider([
                'query' => Estudiantes::find(),
            ]);
            
        $dataProvider1S = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['CURSO'=>'1s']),
            ]);
            
        $dataProvider2S = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['CURSO'=>'2s']),
            ]);
            
        $dataProvider3S = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['CURSO'=>'3s']),
            ]);
            
        $dataProvider4S = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['CURSO'=>'4s']),
            ]);
            
        $dataProvider5S = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['CURSO'=>'5s']),
            ]);
            
        $dataProvider6S = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['CURSO'=>'6s']),
            ]);
            
        $dataProviderR = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['AREA'=>'r']),
            ]);
            
        $dataProviderU = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['AREA'=>'u']),
            ]);
        
        $dataProviderC = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['DEPENDENCIA'=>'convenio']),
            ]);
            
        $dataProviderF = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['DEPENDENCIA'=>'fiscal o estatal']),
            ]);
            
        $dataProviderP = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['DEPENDENCIA'=>'privada']),
            ]);
            
        $dataProviderGF = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['GENERO'=>'f']),
            ]);
            
        $dataProviderGM = new ActiveDataProvider([
                'query' => Estudiantes::find()->where(['GENERO'=>'m']),
            ]);
        //$fechaLimite = mktime(0, 0, 0, date("d"),   date("m"),   date("Y")-15); 
        //$fechaLimite = strtotime ("23/03/2003");
        $dataProviderS15 = new ActiveDataProvider([
                'query' => Estudiantes::find()->where('EDAD'<=15),
            ]);
        
        return $this->render('r_general',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderR' => $dataProviderR,
            'dataProviderU' => $dataProviderU,
            'dataProviderC' => $dataProviderC,
            'dataProviderF' => $dataProviderF,
            'dataProviderP' => $dataProviderP,
            'dataProviderGF' => $dataProviderGF,
            'dataProviderGM' => $dataProviderGM,
            'dataProvider1S' => $dataProvider1S,
            'dataProvider2S' => $dataProvider2S,
            'dataProvider3S' => $dataProvider3S,
            'dataProvider4S' => $dataProvider4S,
            'dataProvider5S' => $dataProvider5S,
            'dataProvider6S' => $dataProvider6S,
            'dataProviderS15' => $dataProviderS15,
            //'fechaLimite' => $fechaLimite,
        ]);
    }
    
    /*public function actionAreas($area)
    {
        var_dump( $_GET['area']);
        $estudiantes = new Estudiantes();
        
        $alumnos = $estudiantes->getAlumnos(0, $area,10);
        return $this->render('areas',[
            'model' => $alumnos,
        ]);
    }*/
    
    public function actionPersonalizar()
    {
        $model_custom = new CustomForm();
        return $this->render('personalizar',['model'=>$model_custom]);
    }
    public function actionMejor_nota()
    {
        return $this->render('mejor_nota');
    }
    
    
}
