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

    public function actionReporteshistorial(){

        $searchModel = new EstudiantesBusqueda();

        $get = Yii::$app->request->queryParams;

        $eventos = new Evento();

        $etapas = $eventos->find()->where(['_id'=>new \MongoId($get['EstudiantesBusqueda']['NOMBRE_EVENTO'])])->one();

        $gridColumns = [
            'DISTRITO',
            'CURSO',
            'AREA',
            'EDAD',
            'DEPENDENCIA',
            'GENERO',
            'PATERNO',
            'MATERNO',
            'NOMBRE',
            'RUDE',
            'NOTA_ETAPA'.$etapas->ETAPAS
        ];

        $query1S = Yii::$app->request->queryParams;

        $query1S['EstudiantesBusqueda']['CURSO'] = '1s';

        $dataProvider1S = $searchModel->search($query1S);

        $query2S = Yii::$app->request->queryParams;

        $query2S['EstudiantesBusqueda']['CURSO'] = '2s';

        $dataProvider2S = $searchModel->search($query2S);

        $query3S = Yii::$app->request->queryParams;

        $query3S['EstudiantesBusqueda']['CURSO'] = '3s';

        $dataProvider3S = $searchModel->search($query3S);

        $query4S = Yii::$app->request->queryParams;

        $query4S['EstudiantesBusqueda']['CURSO'] = '4s';

        $dataProvider4S = $searchModel->search($query4S);

        $query5S = Yii::$app->request->queryParams;

        $query5S['EstudiantesBusqueda']['CURSO'] = '5s';

        $dataProvider5S = $searchModel->search($query5S);


        $query6S = Yii::$app->request->queryParams;

        $query6S['EstudiantesBusqueda']['CURSO'] = '6s';

        $dataProvider6S = $searchModel->search($query6S);

        return $this->render('reportes_historial', [
            'dataProvider1S' => $dataProvider1S,
            'dataProvider2S' => $dataProvider2S,
            'dataProvider3S' => $dataProvider3S,
            'dataProvider4S' => $dataProvider4S,
            'dataProvider5S' => $dataProvider5S,
            'dataProvider6S' => $dataProvider6S,
            'eventos' => $eventos,
            'gridColumns' => $gridColumns,
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

        $categories_maxmin = [];

        $data = [];

        $data_avg = [];

        $data_mod = [];

        $data_max = [];

        $data_min = [];

        $desv_std = [];

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
            ]],
            [
                '$sort' => ['EDAD'=> 1]
            ]
        );

        if(strtoupper($params['CustomForm']['atributo']) == 'EDAD'){
            foreach($result as $v){
                $edad[$v['_id'][strtoupper($params['CustomForm']['atributo'])]] = $v['number'];
            }
            ksort($edad);
            foreach($edad as $k=>$v){
                array_push($categories, $k);
                array_push($data, $v);
            }
        }else{
            foreach($result as $v){
                array_push($categories, $v['_id'][strtoupper($params['CustomForm']['atributo'])]);
                array_push($data, $v['number']);
            }
        }

        //MEDIA
        $result_avg = $collection->aggregate(
            ['$match' =>
                [
                    'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gt'=>0],
                    'GESTION'=>(int)$params['CustomForm']['gestion'],
                    'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                ]
            ],
            ['$group' => [
                '_id' => [strtoupper($params['CustomForm']['atributo'])=>'$'.strtoupper($params['CustomForm']['atributo'])],
                'number' => ['$avg' => '$NOTA_ETAPA'.$params['CustomForm']['etapa']]
            ]]
        );

        if(strtoupper($params['CustomForm']['atributo']) == 'EDAD'){
            foreach($result_avg as $v){
                $edad[$v['_id'][strtoupper($params['CustomForm']['atributo'])]] = $v['number'];
            }
            ksort($edad);
            foreach($edad as $k=>$v){
                array_push($categories_avg, $k);
                array_push($data_avg, $v);
            }
        }else{
            foreach($result_avg as $v){
                array_push($categories_avg, $v['_id'][strtoupper($params['CustomForm']['atributo'])]);
                array_push($data_avg, $v['number']);
            }
        }

        //MODA

        $result_mod = $collection->aggregate(
            ['$match' =>
                [
                    'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gt'=>0],
                    'GESTION'=>(int)$params['CustomForm']['gestion'],
                    'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                ]
            ],
            ['$group' => [
                '_id' => [strtoupper($params['CustomForm']['atributo'])=>'$'.strtoupper($params['CustomForm']['atributo'])],
                'number' => ['$push' => '$NOTA_ETAPA'.$params['CustomForm']['etapa']]
            ]]
        );

        if(strtoupper($params['CustomForm']['atributo']) == 'EDAD'){
            foreach($result_mod as $v){
                $cont = array_count_values($v['number']);
                arsort($cont);
                $mod = array_keys($cont);
                $edad[$v['_id'][strtoupper($params['CustomForm']['atributo'])]] = $mod[0];

            }
            ksort($edad);
            foreach($edad as $k=>$v){
                array_push($categories_mod, $k);
                array_push($data_mod, $v);
            }
        }else{
            foreach($result_mod as $v){
                array_push($categories_mod, $v['_id'][strtoupper($params['CustomForm']['atributo'])]);
                $cont = array_count_values($v['number']);
                arsort($cont);
                $mod = array_keys($cont);
                array_push($data_mod, $mod[0]);
            }
        }

        //MAX & MIN

        $result_max = $collection->aggregate(
            ['$match' =>
                [
                    'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gt'=>0],
                    'GESTION'=>(int)$params['CustomForm']['gestion'],
                    'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                ]
            ],
            ['$group' => [
                '_id' => [strtoupper($params['CustomForm']['atributo'])=>'$'.strtoupper($params['CustomForm']['atributo'])],
                'number' => ['$max' => '$NOTA_ETAPA'.$params['CustomForm']['etapa']]
            ]]
        );

        $result_min = $collection->aggregate(
            ['$match' =>
                [
                    'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gt'=>0],
                    'GESTION'=>(int)$params['CustomForm']['gestion'],
                    'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                ]
            ],
            ['$group' => [
                '_id' => [strtoupper($params['CustomForm']['atributo'])=>'$'.strtoupper($params['CustomForm']['atributo'])],
                'number' => ['$min' => '$NOTA_ETAPA'.$params['CustomForm']['etapa']]
            ]]
        );

        if(strtoupper($params['CustomForm']['atributo']) == 'EDAD'){
            foreach($result_max as $v){
                $edadmax[$v['_id'][strtoupper($params['CustomForm']['atributo'])]] = $v['number'];
            }
            ksort($edadmax);
            foreach($edadmax as $k=>$v){
                array_push($categories_maxmin, $k);
                array_push($data_max, $v);
            }

            foreach($result_min as $v){
                $edadmin[$v['_id'][strtoupper($params['CustomForm']['atributo'])]] = $v['number'];
            }
            ksort($edadmin);
            foreach($edadmin as $k=>$v){
                array_push($data_min, $v);
            }
        }else{
            foreach($result_max as $v){
                array_push($categories_maxmin, $v['_id'][strtoupper($params['CustomForm']['atributo'])]);
                array_push($data_max, $v['number']);
            }

            foreach($result_min as $v){
                array_push($data_min, $v['number']);
            }
        }

        //Desviacion Estandar

        $model = Estudiantes::find()->where(['NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gte'=>51]])->select(['NOTA_ETAPA'.$params['CustomForm']['etapa']])->asArray()->all();



        foreach($model as $v){
            array_push($desv_std, $v['NOTA_ETAPA'.$params['CustomForm']['etapa']]);
        }

        $dev_std = $this->sd($desv_std);

        return $this->render('graficas', [
            'atributo'=>$params['CustomForm']['atributo'],
            'series'=>$series,
            'categories'=>$categories,
            'data'=>$data,
            'categories_avg'=>$categories_avg,
            'data_avg'=>$data_avg,
            'categories_mod'=>$categories_mod,
            'data_mod'=>$data_mod,
            'categories_maxmin'=>$categories_maxmin,
            'data_max'=>$data_max,
            'data_min'=>$data_min,
            'dev_std'=>$dev_std
        ]);
    }

    public function sd_square($x, $mean) {
        return pow($x - $mean,2);
    }

    public function sd($array) {
        return sqrt(array_sum(array_map([$this, 'sd_square'], $array, array_fill(0,count($array), (array_sum($array) / count($array)) ) ) ) / (count($array)-1) );
    }
}
