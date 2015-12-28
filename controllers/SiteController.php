<?php

namespace app\controllers;

use app\models\Evento;
use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\mongodb\Query;
use yii\mongodb\Collection;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Estudiantes;
use app\models\EstudiantesBusqueda;
use app\models\EstudiantesBusquedaRanking;
use app\models\Ue;
use app\models\CustomForm;
use app\models\UeBusqueda;
use app\models\Distrito;
use kartik\grid\GridView;
use yii\web\Session;
use app\models\EventoSearch;



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

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $get = Yii::$app->request->queryParams;

        $distritos = new Distrito();

        $gridColumns = [
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute'=>'DISTRITO',
                'width'=>'150px',
                'filterType'=>GridView::FILTER_TYPEAHEAD,
                'filterWidgetOptions'=>[
                    'name' => 'DISTRITO',
                    'options' => ['placeholder' => 'Escoger Distrito...'],
                    'pluginOptions' => ['highlight'=>true],
                    'dataset' => [
                        [
                            'local' => $distritos->obtenerNombres(),
                            'limit' => 10
                        ]
                    ]
                ],
            ],
            [
                'attribute'=>'CURSO',
                'filter' => Html::activeDropDownList($searchModel, 'CURSO', $searchModel->obtenercursos(),['class'=>'form-control','prompt' => 'Selecionar Curso'])
            ],
            [
                'attribute'=>'AREA',
                'filter' => Html::activeDropDownList($searchModel, 'AREA', $searchModel->obtenerArea(),['class'=>'form-control','prompt' => 'Selecionar Area'])
            ],
            [
                'attribute'=>'EDAD',
                'filter' => Html::activeDropDownList($searchModel, 'EDAD', $searchModel->obtenerEdad(),['class'=>'form-control','prompt' => 'Selecionar edad'])
            ],
            [
                'attribute'=>'DEPENDENCIA',
                'filter' => Html::activeDropDownList($searchModel, 'DEPENDENCIA', $searchModel->obtenerDependencia(),['class'=>'form-control','prompt' => 'Selecionar nivel de dependencia'])
            ],
            [
                'attribute'=>'GENERO',
                'filter' => Html::activeDropDownList($searchModel, 'GENERO', $searchModel->obtenerGenero(),['class'=>'form-control','prompt' => 'Selecionar genero'])
            ],
            'PATERNO',
            'MATERNO',
            'NOMBRE',
            //'RUDE',
            'NOTA_ETAPA'.$get['EstudiantesBusqueda']['NRO_ETAPA'],
        ];

        return $this->render('r_general',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
            'gridColumns'=>$gridColumns,
        ]);
    }

    public function actionRanking(){
        $searchModel = new EventoSearch();

        $eventos = new Evento();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('ranking',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'eventos' => $eventos,
        ]);
    }

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
