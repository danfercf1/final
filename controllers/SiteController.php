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
use yii\base\Exception;
use yii\web\Controller;
use yii\web\Session;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\mongodb\Query;
use yii\mongodb\Collection;
use kartik\grid\GridView;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'rankingpersonalizado', 'personalizar', 'datos', 'estadisticad', 'ranking', 'estadisticas', 'reportes'],
                'rules' => [
                    [
                        'actions' => ['logout', 'rankingpersonalizado', 'personalizar', 'datos', 'estadisticad', 'ranking', 'estadisticas', 'reportes'],
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
        $model_custom = new CustomForm(['scenario' => 'estadistica']);

        $eventos = new Evento();

        return $this->render('estadisticas',[
            'model'=>$model_custom,
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

        //Validaciones

        if(!empty($get['EstudiantesBusqueda']['NOMBRE_EVENTO']) && \MongoId::isValid($get['EstudiantesBusqueda']['NOMBRE_EVENTO'])){
            $etapas = $eventos->find()->where(['_id'=>new \MongoId($get['EstudiantesBusqueda']['NOMBRE_EVENTO'])])->one();
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if(empty($etapas)){
            throw new NotFoundHttpException('The requested page does not exist.');
        }

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
            'eventos' => $etapas,
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
        
        array_push($gridColumns, [
                'class' => '\kartik\grid\ActionColumn',
                'updateOptions'=> ['hidden'=>true],
                'deleteOptions' => ['hidden'=>true]
        ]);

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

    public function actionRankingpersonalizado(){

        $searchModel = new EstudiantesBusquedaRanking();

        $distritos = new Distrito();

        $get = Yii::$app->request->queryParams;

        $gridColumns = [];

        $data = [];

        $data_final = [];

        $distrito = [];

        $order = [];

        $model = Estudiantes::find()->where(['NOTA_ETAPA'.$get['EstudiantesBusquedaRanking']['NRO_ETAPA'] => ['$gte'=>51]])->select(['DISTRITO', '_id'=>false])->orderBy(['DISTRITO'=>SORT_ASC, 'NOTA_ETAPA'. $get['EstudiantesBusquedaRanking']['NRO_ETAPA']=>SORT_DESC])->asArray()->all();

        foreach($model as $k=>$v){
            array_push($distrito, $v['DISTRITO']);
        }

        $n_distritos = array_unique($distrito);

        $atributos = $get['EstudiantesBusquedaRanking']['ATRIBUTO'];

        if(isset($get['EstudiantesBusquedaRanking']['ATRIBUTO']) && !empty($get['EstudiantesBusquedaRanking']['ATRIBUTO'])){

            array_push($gridColumns,
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
                ]
            );

            foreach($atributos as $k=>$v){

                switch($v){
                    case 'CURSO': $order['CURSO'] = SORT_ASC;
                        break;
                    case 'EDAD': $order['EDAD'] = SORT_ASC;
                        break;
                    case 'AREA': $order['EDAD'] = SORT_ASC;
                        break;
                    case 'DEPENDENCIA': $order['DEPENDENCIA'] = SORT_ASC;
                        break;
                    case 'GENERO': $order['GENERO'] = SORT_ASC;
                        break;
                }

                array_push($gridColumns,
                    [
                        'attribute'=>$v,
                    ]
                );
            }

            $order['NOTA_ETAPA'. $get['EstudiantesBusquedaRanking']['NRO_ETAPA']] = SORT_DESC;

            array_push($gridColumns, 'PATERNO', 'MATERNO', 'NOMBRE', 'NOTA_ETAPA'. $get['EstudiantesBusquedaRanking']['NRO_ETAPA']);

        }else{
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
                'PATERNO',
                'MATERNO',
                'NOMBRE',
                'NOTA_ETAPA'.$get['EstudiantesBusquedaRanking']['NRO_ETAPA'],
            ];
            $order['NOTA_ETAPA'. $get['EstudiantesBusquedaRanking']['NRO_ETAPA']] = SORT_DESC;
        }

        foreach($n_distritos as $v){
            $model = Estudiantes::find()->where(['DISTRITO'=>$v, 'NOTA_ETAPA'.$get['EstudiantesBusquedaRanking']['NRO_ETAPA'] => ['$gte'=>51]])->limit($get['EstudiantesBusquedaRanking']['cantidad'])->orderBy($order)->asArray()->all();
            array_push($data, $model);
        }

        foreach($data as $v){
            foreach($v as $w){
                array_push($data_final, $w);
            }
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data_final,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);


        return $this->render('rankingpersonalizado',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridColumns'=>$gridColumns,
        ]);
    }

    public function actionPersonalizar()
    {
        $model_custom = new EstudiantesBusquedaRanking(['scenario'=>'search']);

        $eventos = new Evento();

        return $this->render('personalizar',[
            'model'=>$model_custom,
            'eventos' => $eventos,
        ]);
    }
    
    
    public function actionView($id)
    {
        $model = Estudiantes::find()->with('tutor')->where(['_id'=>$id])->one();
        $url = $_SERVER['HTTP_REFERER'];

        $url = explode($_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"], $url);

        if ($model !== null) {
            return $this->render('view', [
                'model' => $model,'idEstudiante' => $id, 'url'=>$url[1]
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
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

        if(!isset($params['CustomForm']['evento']) || empty($params['CustomForm']['evento']) || !$this->isValid($params['CustomForm']['evento'])){
            throw new BadRequestHttpException('Parámetros inválidos debe revisar el formulario');
        }

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
                $dataT[$v['_id'][strtoupper($params['CustomForm']['atributo'])]] = $v['number'];
            }
            ksort($dataT);
            foreach($dataT as $k=>$v){
                array_push($categories, $k);
                array_push($data, $v);
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
                $dataT[$v['_id'][strtoupper($params['CustomForm']['atributo'])]] = $v['number'];
            }
            ksort($dataT);
            foreach($dataT as $k=>$v){
                array_push($categories_avg, $k);
                array_push($data_avg, $v);
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

    public function actionEstadisticad(){

        $model_custom = new CustomForm(['scenario'=>'estadistica']);

        $eventos = new Evento();

        return $this->render('estadisticasd',[
            'model'=>$model_custom,
            'eventos' => $eventos,
        ]);
    }

    public function actionDatos(){

        $params = Yii::$app->request->queryParams;

        $dist_tot = [];

        $dist_ap = [];

        $collection = Yii::$app->mongodb->getCollection('estudiante');

        //APROBADOS

        if(isset($params['CustomForm']['atributo']) && $params['CustomForm']['atributo'] == 'distrito'){

            $distrito_tot = $collection->aggregate(
                ['$match' =>
                    [
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['DISTRITO'=> 1]
                ],
                ['$group' => [
                    '_id' => ['DISTRITO'=>'$DISTRITO'],
                    'number' => ['$sum' => 1]
                ]]
            );

            $distrito_ap = $collection->aggregate(
                ['$match' =>
                    [
                        'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gte'=>51],
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['DISTRITO'=> 1]
                ],
                ['$group' => [
                    '_id' => ['DISTRITO'=>'$DISTRITO'],
                    'number' => ['$sum' => 1]
                ]]
            );

            foreach($distrito_tot as $v){
                array_push($dist_tot, ['DISTRITO'=>$v['_id']['DISTRITO'], 'CANTIDAD'=>$v['number']]);
            }

            foreach($distrito_ap as $v){
                array_push($dist_ap, ['DISTRITO'=>$v['_id']['DISTRITO'], 'CANTIDAD'=>$v['number']]);
            }

            array_multisort($dist_tot);

            array_multisort($dist_ap);

            $dataProvider = new ArrayDataProvider([
                'allModels' => $dist_tot,
                'pagination' => false,
            ]);

            $dataProviderAP = new ArrayDataProvider([
                'allModels' => $dist_ap,
                'pagination' => false,
            ]);

            $gridColumns = [
                [
                    'class' => '\kartik\grid\SerialColumn'
                ],
                'DISTRITO',
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'CANTIDAD',
                    'pageSummary' => true
                ]
            ];

            return $this->render('datos', ['dataProvider'=>$dataProvider,'dataProviderAP'=>$dataProviderAP, 'gridColumns'=>$gridColumns]);

        }elseif(isset($params['CustomForm']['atributo']) && $params['CustomForm']['atributo'] == 'curso'){

            $distrito_tot = $collection->aggregate(

                ['$match' =>
                    [
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['CURSO'=> 1]
                ],
                ['$group' => [
                    '_id' => ['CURSO'=>'$CURSO'],
                    'number' => ['$sum' => 1]
                ]]
            );

            $distrito_ap = $collection->aggregate(
                ['$match' =>
                    [
                        'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gte'=>51],
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['CURSO'=> 1]
                ],
                ['$group' => [
                    '_id' => ['CURSO'=>'$CURSO'],
                    'number' => ['$sum' => 1]
                ]]
            );

            foreach($distrito_tot as $v){
                array_push($dist_tot, ['CURSO'=>$v['_id']['CURSO'], 'CANTIDAD'=>$v['number']]);
            }

            foreach($distrito_ap as $v){
                array_push($dist_ap, ['CURSO'=>$v['_id']['CURSO'], 'CANTIDAD'=>$v['number']]);
            }

            array_multisort($dist_tot);

            array_multisort($dist_ap);

            $dataProvider = new ArrayDataProvider([
                'allModels' => $dist_tot,
                'pagination' => false,
            ]);

            $dataProviderCU = new ArrayDataProvider([
                'allModels' => $dist_ap,
                'pagination' => false,
            ]);

            $gridColumns = [
                [
                    'class' => '\kartik\grid\SerialColumn'
                ],
                'CURSO',
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'CANTIDAD',
                    'pageSummary' => true
                ]
            ];

            return $this->render('datos_curso', ['dataProvider'=>$dataProvider, 'dataProviderCU'=>$dataProviderCU, 'gridColumns'=>$gridColumns]);

        }elseif(isset($params['CustomForm']['atributo']) && $params['CustomForm']['atributo'] == 'edad'){

            $distrito_tot = $collection->aggregate(

                ['$match' =>
                    [
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['EDAD'=> 1]
                ],
                ['$group' => [
                    '_id' => ['EDAD'=>'$EDAD'],
                    'number' => ['$sum' => 1]
                ]]
            );

            $distrito_ap = $collection->aggregate(
                ['$match' =>
                    [
                        'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gte'=>51],
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['EDAD'=> 1]
                ],
                ['$group' => [
                    '_id' => ['EDAD'=>'$EDAD'],
                    'number' => ['$sum' => 1]
                ]]
            );

            foreach($distrito_tot as $v){
                array_push($dist_tot, ['EDAD'=>$v['_id']['EDAD'], 'CANTIDAD'=>$v['number']]);
            }

            foreach($distrito_ap as $v){
                array_push($dist_ap, ['EDAD'=>$v['_id']['EDAD'], 'CANTIDAD'=>$v['number']]);
            }

            array_multisort($dist_tot);

            array_multisort($dist_ap);

            $dataProvider = new ArrayDataProvider([
                'allModels' => $dist_tot,
                'pagination' => false,
            ]);

            $dataProviderCU = new ArrayDataProvider([
                'allModels' => $dist_ap,
                'pagination' => false,
            ]);

            $gridColumns = [
                [
                    'class' => '\kartik\grid\SerialColumn'
                ],
                'EDAD',
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'CANTIDAD',
                    'pageSummary' => true
                ]
            ];

            return $this->render('datos_edad', ['dataProvider'=>$dataProvider, 'dataProviderCU'=>$dataProviderCU, 'gridColumns'=>$gridColumns]);

        }elseif(isset($params['CustomForm']['atributo']) && $params['CustomForm']['atributo'] == 'area'){

            $distrito_tot = $collection->aggregate(

                ['$match' =>
                    [
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['AREA'=> 1]
                ],
                ['$group' => [
                    '_id' => ['AREA'=>'$AREA'],
                    'number' => ['$sum' => 1]
                ]]
            );

            $distrito_ap = $collection->aggregate(
                ['$match' =>
                    [
                        'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gte'=>51],
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['AREA'=> 1]
                ],
                ['$group' => [
                    '_id' => ['AREA'=>'$AREA'],
                    'number' => ['$sum' => 1]
                ]]
            );

            foreach($distrito_tot as $v){
                array_push($dist_tot, ['AREA'=>$v['_id']['AREA'], 'CANTIDAD'=>$v['number']]);
            }

            foreach($distrito_ap as $v){
                array_push($dist_ap, ['AREA'=>$v['_id']['AREA'], 'CANTIDAD'=>$v['number']]);
            }

            array_multisort($dist_tot);

            array_multisort($dist_ap);

            $dataProvider = new ArrayDataProvider([
                'allModels' => $dist_tot,
                'pagination' => false,
            ]);

            $dataProviderCU = new ArrayDataProvider([
                'allModels' => $dist_ap,
                'pagination' => false,
            ]);

            $gridColumns = [
                [
                    'class' => '\kartik\grid\SerialColumn'
                ],
                'AREA',
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'CANTIDAD',
                    'pageSummary' => true
                ]
            ];

            return $this->render('datos_area', ['dataProvider'=>$dataProvider, 'dataProviderCU'=>$dataProviderCU, 'gridColumns'=>$gridColumns]);

        }elseif(isset($params['CustomForm']['atributo']) && $params['CustomForm']['atributo'] == 'dependencia'){

            $distrito_tot = $collection->aggregate(

                ['$match' =>
                    [
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['DEPENDENCIA'=> 1]
                ],
                ['$group' => [
                    '_id' => ['DEPENDENCIA'=>'$DEPENDENCIA'],
                    'number' => ['$sum' => 1]
                ]]
            );

            $distrito_ap = $collection->aggregate(
                ['$match' =>
                    [
                        'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gte'=>51],
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['DEPENDENCIA'=> 1]
                ],
                ['$group' => [
                    '_id' => ['DEPENDENCIA'=>'$DEPENDENCIA'],
                    'number' => ['$sum' => 1]
                ]]
            );

            foreach($distrito_tot as $v){
                array_push($dist_tot, ['DEPENDENCIA'=>$v['_id']['DEPENDENCIA'], 'CANTIDAD'=>$v['number']]);
            }

            foreach($distrito_ap as $v){
                array_push($dist_ap, ['DEPENDENCIA'=>$v['_id']['DEPENDENCIA'], 'CANTIDAD'=>$v['number']]);
            }

            array_multisort($dist_tot);

            array_multisort($dist_ap);

            $dataProvider = new ArrayDataProvider([
                'allModels' => $dist_tot,
                'pagination' => false,
            ]);

            $dataProviderCU = new ArrayDataProvider([
                'allModels' => $dist_ap,
                'pagination' => false,
            ]);

            $gridColumns = [
                [
                    'class' => '\kartik\grid\SerialColumn'
                ],
                'DEPENDENCIA',
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'CANTIDAD',
                    'pageSummary' => true
                ]
            ];

            return $this->render('datos_dependencia', ['dataProvider'=>$dataProvider, 'dataProviderCU'=>$dataProviderCU, 'gridColumns'=>$gridColumns]);

        }elseif(isset($params['CustomForm']['atributo']) && $params['CustomForm']['atributo'] == 'genero'){

            $distrito_tot = $collection->aggregate(

                ['$match' =>
                    [
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['GENERO'=> 1]
                ],
                ['$group' => [
                    '_id' => ['GENERO'=>'$GENERO'],
                    'number' => ['$sum' => 1]
                ]]
            );

            $distrito_ap = $collection->aggregate(
                ['$match' =>
                    [
                        'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gte'=>51],
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['GENERO'=> 1]
                ],
                ['$group' => [
                    '_id' => ['GENERO'=>'$GENERO'],
                    'number' => ['$sum' => 1]
                ]]
            );

            foreach($distrito_tot as $v){
                array_push($dist_tot, ['GENERO'=>$v['_id']['GENERO'], 'CANTIDAD'=>$v['number']]);
            }

            foreach($distrito_ap as $v){
                array_push($dist_ap, ['GENERO'=>$v['_id']['GENERO'], 'CANTIDAD'=>$v['number']]);
            }

            array_multisort($dist_tot);

            array_multisort($dist_ap);

            $dataProvider = new ArrayDataProvider([
                'allModels' => $dist_tot,
                'pagination' => false,
            ]);

            $dataProviderCU = new ArrayDataProvider([
                'allModels' => $dist_ap,
                'pagination' => false,
            ]);

            $gridColumns = [
                [
                    'class' => '\kartik\grid\SerialColumn'
                ],
                'GENERO',
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'CANTIDAD',
                    'pageSummary' => true
                ]
            ];

            return $this->render('datos_genero', ['dataProvider'=>$dataProvider, 'dataProviderCU'=>$dataProviderCU, 'gridColumns'=>$gridColumns]);
        }elseif(isset($params['CustomForm']['atributo']) && $params['CustomForm']['atributo'] == 'cursoxdistrito'){

            $new_dist_tot = [];

            $new_dist_ap = [];

            $distrito_tot = $collection->aggregate(

                ['$match' =>
                    [
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['CURSO'=> 1]
                ],
                ['$group' => [
                    '_id' => ['DISTRITO'=>'$DISTRITO', 'CURSO'=>'$CURSO'],
                    'number' => ['$sum' => 1]
                ]]
            );

            $distrito_ap = $collection->aggregate(
                ['$match' =>
                    [
                        'NOTA_ETAPA'.$params['CustomForm']['etapa'] => ['$gte'=>51],
                        'GESTION'=>(int)$params['CustomForm']['gestion'],
                        'NOMBRE_EVENTO'=>new \MongoId($params['CustomForm']['evento'])
                    ]
                ],
                [
                    '$sort' => ['CURSO'=> 1]
                ],
                ['$group' => [
                    '_id' => ['DISTRITO'=>'$DISTRITO', 'CURSO'=>'$CURSO'],
                    'number' => ['$sum' => 1]
                ]]
            );

            foreach($distrito_tot as $v){

                switch ($v['_id']['CURSO']){
                    case '1s' : $dist_tot[$v['_id']['DISTRITO']]['1s'] = $v['number'];
                        break;
                    case '2s' : $dist_tot[$v['_id']['DISTRITO']]['2s'] = $v['number'];
                        break;
                    case '3s' : $dist_tot[$v['_id']['DISTRITO']]['3s'] = $v['number'];
                        break;
                    case '4s' : $dist_tot[$v['_id']['DISTRITO']]['4s'] = $v['number'];
                        break;
                    case '5s' : $dist_tot[$v['_id']['DISTRITO']]['5s'] = $v['number'];
                        break;
                    case '6s' : $dist_tot[$v['_id']['DISTRITO']]['6s'] = $v['number'];
                        break;
                }
            }


            foreach ($dist_tot as $k=>$v){
                array_push($new_dist_tot,
                    ['DISTRITO'=>$k, '1s' => (isset($v['1s'])) ? $v['1s']: 0, '2s' => (isset($v['2s'])) ? $v['2s']: 0, '3s' => (isset($v['3s'])) ? $v['3s']: 0, '4s' => (isset($v['4s'])) ? $v['4s']: 0, '5s' => (isset($v['5s'])) ? $v['5s']: 0, '6s' => (isset($v['6s'])) ? $v['6s']: 0]);
            }

            foreach($distrito_ap as $v){
                switch ($v['_id']['CURSO']){
                    case '1s' : $dist_ap[$v['_id']['DISTRITO']]['1s'] = $v['number'];
                        break;
                    case '2s' : $dist_ap[$v['_id']['DISTRITO']]['2s'] = $v['number'];
                        break;
                    case '3s' : $dist_ap[$v['_id']['DISTRITO']]['3s'] = $v['number'];
                        break;
                    case '4s' : $dist_ap[$v['_id']['DISTRITO']]['4s'] = $v['number'];
                        break;
                    case '5s' : $dist_ap[$v['_id']['DISTRITO']]['5s'] = $v['number'];
                        break;
                    case '6s' : $dist_ap[$v['_id']['DISTRITO']]['6s'] = $v['number'];
                        break;
                }
            }

            foreach ($dist_ap as $k=>$v){
                array_push($new_dist_ap,
                    ['DISTRITO'=>$k, '1s' => (isset($v['1s'])) ? $v['1s']: 0, '2s' => (isset($v['2s'])) ? $v['2s']: 0, '3s' => (isset($v['3s'])) ? $v['3s']: 0, '4s' => (isset($v['4s'])) ? $v['4s']: 0, '5s' => (isset($v['5s'])) ? $v['5s']: 0, '6s' => (isset($v['6s'])) ? $v['6s']: 0]);
            }

            array_multisort($new_dist_tot);

            array_multisort($new_dist_ap);

            $dataProvider = new ArrayDataProvider([
                'allModels' => $new_dist_tot,
                'pagination' => false,
            ]);

            $dataProviderCU = new ArrayDataProvider([
                'allModels' => $new_dist_ap,
                'pagination' => false,
            ]);

            $gridColumns = [
                [
                    'class' => '\kartik\grid\SerialColumn'
                ],
                'DISTRITO',
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => '1s',
                    'pageSummary' => true
                ],[
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => '2s',
                    'pageSummary' => true
                ],[
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => '3s',
                    'pageSummary' => true
                ],[
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => '4s',
                    'pageSummary' => true
                ],[
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => '5s',
                    'pageSummary' => true
                ],[
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => '6s',
                    'pageSummary' => true
                ],
            ];

            return $this->render('datos_cursoxdistrito', ['dataProvider'=>$dataProvider, 'dataProviderCU'=>$dataProviderCU, 'gridColumns'=>$gridColumns]);
        }
    }

    public function sd_square($x, $mean) {
        return pow($x - $mean,2);
    }

    public function sd($array) {
        if(count($array)-1 <= 0){
            $div = 1;
        }else{
            $div = count($array)-1;
        }
        return sqrt(array_sum(array_map([$this, 'sd_square'], $array, array_fill(0,count($array), (array_sum($array) / count($array)) ) ) ) / ($div) );
    }

    public function isValid($id)
    {
        $regex = '/^[0-9a-z]{24}$/';

        if (class_exists("MongoId"))
        {
            $tmp = new \MongoId($id);
            if ($tmp->{'$id'} == $id)
            {
                return true;
            }
            return false;
        }

        if (preg_match($regex, $id))
        {
            return true;
        }
        return false;
    }
}
