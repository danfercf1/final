<?php

namespace app\controllers;

use app\models\Evento;
use app\models\EventoSearch;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CustomForm;
use app\models\Estudiantes;
use app\models\EstudiantesBusqueda;
use app\models\EstudiantesBusquedaRanking;
use app\models\Ue;
use app\models\UeBusqueda;
use app\models\Distrito;
use Yii;
use yii\web\Controller;
use yii\web\Session;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\mongodb\Query;
use yii\mongodb\Collection;
use kartik\grid\GridView;

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
        $model_custom = new CustomForm();
        $gestiones = $model_custom->gestiones();
        $searchModel = new EventoSearch();
        $eventos = Evento::find()->where(['USUARIO'=>new \MongoId(Yii::$app->user->getId())])->one();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('estadisticas',[
            'model'=>$model_custom,
            'gestiones'=>$gestiones,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'eventos' => $eventos,
            ]);
    }
    
    public function actionReportes()
    {
        $searchModel = new EventoSearch();

        $eventos = new Evento();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('reportes',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'eventos' => $eventos,
        ]);
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
        $gestiones = $model_custom->gestiones();
        $searchModel = new EventoSearch();
        $eventos = Evento::find()->where(['USUARIO'=>new \MongoId(Yii::$app->user->getId())])->one();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('personalizar',[
            'model'=>$model_custom,
            'gestiones'=>$gestiones,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'eventos' => $eventos,
            ]);
    }
    
    public function actionMejor_nota()
    {
        return $this->render('mejor_nota');
    }

    public function actionGraficas(){

        $params = Yii::$app->request->queryParams;

        $series = [];

        $categories = [];

        $categories_avg = [];

        $categories_mod = [];

        $data = [];

        $data_avg = [];

        $data_mod = [];

        $collection = Yii::$app->mongodb->getCollection('estudiante');

        //APROBADOS
        $result = $collection->aggregate(
            ['$match' =>
                        [
                        'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gte'=>51],
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                        ]
            ],
            ['$group' => [
                '_id' => [strtoupper($params['CustomForm']['atributo'])=>'$'.strtoupper($params['CustomForm']['atributo'])],
                'number' => ['$sum' => 1]
            ]]
        );

        foreach($result as $v){
            array_push($categories, $v['_id'][strtoupper($params['CustomForm']['atributo'])]);
            array_push($data, $v['number']);
        }

        //MEDIA
        $result_avg = $collection->aggregate(
            ['$match' =>
                [
                    'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gte'=>1],
                    'GESTION'=>(int)$params['CustomForm']['gestion'],
                    'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                ]
            ],
            ['$group' => [
                '_id' => [strtoupper($params['CustomForm']['atributo'])=>'$'.strtoupper($params['CustomForm']['atributo'])],
                'number' => ['$avg' => '$NOTA_ETAPA1']
            ]]
        );

        foreach($result_avg as $v){
            array_push($categories_avg, $v['_id'][strtoupper($params['CustomForm']['atributo'])]);
            array_push($data_avg, $v['number']);
        }

        //MODA

        $result_mod = $collection->aggregate(
            ['$match' =>
                [
                    'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gte'=>1],
                    'GESTION'=>(int)$params['CustomForm']['gestion'],
                    'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                ]
            ],
            ['$group' => [
                '_id' => [strtoupper($params['CustomForm']['atributo'])=>'$'.strtoupper($params['CustomForm']['atributo'])],
                'number' => ['$push' => '$NOTA_ETAPA'.$params['CustomForm']['etapa']]
            ]]
        );

        foreach($result_mod as $v){
            array_push($categories_mod, $v['_id'][strtoupper($params['CustomForm']['atributo'])]);
            $cont = array_count_values($v['number']);
            arsort($cont);
            $mod = array_keys($cont);
            array_push($data_mod, $mod[0]);
        }

        return $this->render('graficas', [
            'atributo'=>$params['CustomForm']['atributo'],
            'series'=>$series,
            'categories'=>$categories,
            'data'=>$data,
            'categories_avg'=>$categories_avg,
            'data_avg'=>$data_avg,
            'categories_mod'=>$categories_mod,
            'data_mod'=>$data_mod
        ]);
    }
}
