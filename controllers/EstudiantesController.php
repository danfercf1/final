<?php

namespace app\controllers;

use app\models\Distrito;
use app\models\Tutor;
use app\models\Ue;
use app\models\Evento;
use app\models\EventoSearch;
use app\models\Usuarios;
use app\models\Estudiantes;
use app\models\EstudiantesBusqueda;
use app\models\UploadForm;
use app\models\CustomForm;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Json;
use kartik\grid\GridView;
/**
 * EstudiantesController implements the CRUD actions for Estudiantes model.
 */
class EstudiantesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'cargarexcel', 'updateajax'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'create', 'view', 'update', 'delete', 'cargarexcel', 'cargarnotas', 'vernotas', 'cargarfinal', 'updateajax'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Estudiantes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventoSearch();

        $eventos = new Evento();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'eventos' => $eventos,
        ]);
    }

    public function armarURL($url)
    {
        $url_final = '';

        if(!empty($url['EstudiantesBusqueda'])){
            foreach($url['EstudiantesBusqueda'] as $k=>$v){
                $url_final .= 'EstudiantesBusqueda['.$k.']='.$v.'&';
            }
            return $url_final;
        }else{
            return false;
        }
    }

    public function actionDatos()
    {
        $datos = Yii::$app->request->queryParams;

        Yii::$app->session->open();

        $url = $this->armarURL($datos);

        Yii::$app->session->set('urlDatos', $url);

        $searchModel = new EstudiantesBusqueda();

        $evento = (isset($datos['EstudiantesBusqueda']['NOMBRE_EVENTO']) ? $datos['EstudiantesBusqueda']['NOMBRE_EVENTO'] : '');

        try {
            $evento_model = Evento::find()->where(['_id'=>new \MongoId($evento)])->one();
        } catch (\MongoException $ex) {
            $this->redirect('/estudiantes/index');
        }

        $etapas = $evento_model->ETAPAS;

        $distritos = new Distrito();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $etapa_seleccionada = 'NRO_ETAPA'.(isset($datos['EstudiantesBusqueda']['NRO_ETAPA']) ? $datos['EstudiantesBusqueda']['NRO_ETAPA'] : '1');

        $etapa_selecc_nro = isset($datos['EstudiantesBusqueda']['NRO_ETAPA']) ? $datos['EstudiantesBusqueda']['NRO_ETAPA'] : '1';


        $gridColumns = [
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute'=>'DISTRITO',
                'width'=>'200px',
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
            'PATERNO',
            'MATERNO',
            'NOMBRE',
            //'RUDE',
            [
                'attribute'=>'EDAD',
                'filter' => Html::activeDropDownList($searchModel, 'EDAD', $searchModel->obtenerEdad(),['class'=>'form-control','prompt' => 'Selecionar edad'])
            ],
            [
                'label'=>'Fecha Nac.',
                'value'=>function($model){
                    return $model->getFechaNaC();
                }
            ],
        ];

        for($i=1; $i <= (int) $etapa_selecc_nro; $i++){

            if((int) $etapa_selecc_nro != $i){
                $readonly = true;
            }else{
                $readonly = function($model, $key, $index, $widget) {
                    return (!$model->status); // do not allow editing of inactive records
                };
            }
            array_push($gridColumns, [
                'class' => 'kartik\grid\EditableColumn',
                'attribute'=>'NOTA_ETAPA'.$i,
                'readonly'=>$readonly,
                'editableOptions' => [
                    'header' => 'Nota Etapa '.$i,
                    'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                    'options' => [
                        'pluginOptions' => ['min'=>0, 'max'=>100]
                    ]
                ],
                'hAlign'=>'right',
                'vAlign'=>'middle',
                'width'=>'100px',
                'format'=>['integer', 1],
                'pageSummary' => true,
                'pageSummaryFunc'=>GridView::F_AVG,
                'refreshGrid'=> true
            ]);
        }

        array_push($gridColumns, [
            'class'=>'kartik\grid\CheckboxColumn',
            'name'=>$etapa_seleccionada,
            'header'=>'Clasificados',
            'headerOptions'=>['class'=>'kartik-sheet-style'],
            'checkboxOptions' => function($model, $key, $index, $column) use ($etapa_selecc_nro){
                $etapa_selecc = 'SELECC_ETAPA'.$etapa_selecc_nro;
                $nota_selecc = 'NOTA_ETAPA'.$etapa_selecc_nro;
                $check_etapas =  (($model->$etapa_selecc == 1)) ? true : false;

                return ['class'=>'check_ganador',
                    'disabled'=>($model->$nota_selecc > 0) ? false : true,
                    'checked'=>$check_etapas,
                    'data_selecc'=>$etapa_selecc_nro,
                    'value'=>$key
                ];
            }
        ]);

        array_push($gridColumns, [
            'class' => '\kartik\grid\ActionColumn',
            'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
        ]);

        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $bookId = Yii::$app->request->post('editableKey');

            $model = $this->findModel(unserialize($bookId));


            // store a default json response as desired by editable
            $out = Json::encode(['output'=>'', 'message'=>'']);

            // fetch the first entry in posted data (there should
            // only be one entry anyway in this array for an
            // editable submission)
            // - $posted is the posted data for Book without any indexes
            // - $post is the converted array for single model validation
            $post = [];
            $posted = current($_POST['Estudiantes']);
            $post['Estudiantes'] = $posted;

            // load model like any single model validation
            if ($post) {

                // custom output to return to be displayed as the editable grid cell
                // data. Normally this is empty - whereby whatever value is edited by
                // in the input by user is updated automatically.
                $output = '';

                // specific use case where you need to validate a specific
                // editable column posted when you have more than one
                // EditableColumn in the grid view. We evaluate here a
                // check to see if buy_amount was posted for the Book model
                if (isset($posted['NOTA_ETAPA1'])) {
                    $output =  Yii::$app->formatter->asInteger($model->NOTA_ETAPA1);
                    $model->NOTA_ETAPA1 = (int) $posted['NOTA_ETAPA1'];
                }

                if (isset($posted['NOTA_ETAPA2'])) {
                    $output =  Yii::$app->formatter->asInteger($model->NOTA_ETAPA2);
                    $model->NOTA_ETAPA2 = (int) $posted['NOTA_ETAPA2'];
                }
                if (isset($posted['NOTA_ETAPA3'])) {
                    $output =  Yii::$app->formatter->asInteger($model->NOTA_ETAPA3);
                    $model->NOTA_ETAPA3 = (int) $posted['NOTA_ETAPA3'];
                }

                if (isset($posted['NOTA_ETAPA4'])) {
                    $output =  Yii::$app->formatter->asInteger($model->NOTA_ETAPA4);
                    $model->NOTA_ETAPA4 = (int) $posted['NOTA_ETAPA4'];
                }

                if (isset($posted['NOTA_ETAPA5'])) {
                    $output =  Yii::$app->formatter->asInteger($model->NOTA_ETAPA5);
                    $model->NOTA_ETAPA5 = (int) $posted['NOTA_ETAPA5'];
                }

                $model->save();


                // similarly you can check if the name attribute was posted as well
                // if (isset($posted['name'])) {
                //   $output =  ''; // process as you need
                // }
                $out = Json::encode(['output'=>$output, 'message'=>'']);
            }
            // return ajax json encoded response and exit
            echo $out;
            return;
        }

        return $this->render('datos',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'gridColumns'=>$gridColumns
        ]);
    }


    /**
     * Displays a single Estudiantes model.
     * @param integer $_id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = Estudiantes::find()->with('tutor')->where(['_id'=>$id])->one();
        Yii::$app->session->open();
        $url = Yii::$app->session->get('urlDatos');
        if ($model !== null) {
            return $this->render('view', [
                'model' => $model,'idEstudiante' => $id, 'url'=>$url
            ]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Estudiantes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Estudiantes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => (string)$model->_id]);
            return $this->redirect(['confirm']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Cargar excel
     */

    public function actionCargarexcel()
    {
        $model_file = new UploadForm();

        $gestiones = $model_file->gestiones();

        $user = Yii::$app->user->id;

        if (Yii::$app->request->post()) {

            $model_file->load(Yii::$app->request->post());

            $model_file->archivo = UploadedFile::getInstance($model_file, 'archivo');

            if ($model_file->validate()) {

                $model_file->archivo->saveAs($model_file->ubicacion.$model_file->archivo->baseName . '.' . $model_file->archivo->extension);

                $gestion = (int) $_POST["UploadForm"]["gestion"];
                $etapas = (int)$_POST["UploadForm"]["etapas"];
                $archivo = $model_file->archivo->baseName;
                $nombre = $_POST["UploadForm"]["nombre"];
                $usuario = $user;

                $json = ["archivo"=>$archivo. '.' . $model_file->archivo->extension, "gestion"=>$gestion, "etapas"=>$etapas, "nombre"=>$nombre, "usuario"=>$usuario];

                $fp = fopen("listas_excel/configuracion.json", "w");

                fwrite($fp, json_encode($json));

                fclose($fp);

                return $this->redirect(['cargarfinal']);
            }

        } else {
            return $this->render('excel', [
                'model' => $model_file, 'gestiones'=>$gestiones
            ]);
        }

        return $this->render('excel', [
            'model' => $model_file, 'gestiones'=>$gestiones
        ]);
    }


    public function actionVernotas($notaMin=51){

        $estudiantes = new Estudiantes();

        $urbano = $estudiantes->getAlumnos(10, 'u', 51);

        $rural = $estudiantes->getAlumnos(10, 'r', 51);

        return $this->render('vernotas', [
            'urbano' => $urbano, 'rural'=>$rural
        ]);
    }

    public function actionCargarfinal(){

        return $this->render('cargar_final', []);
    }

    /**
     * Cargar excel
     */

    public function actionCargarnotas()
    {
        $texto_columna_puntaje = strtolower("puntaje");

        set_time_limit(360);

        $model_file = new UploadForm();

        $gestiones = $model_file->gestiones();

        if (Yii::$app->request->post()) {

            $model_file->file = UploadedFile::getInstance($model_file, 'file');

            $etapa = $_POST["UploadForm"]["etapa"];

            $gestion = $_POST["UploadForm"]["gestion"];


            if ($model_file->file && $model_file->validate()) {

                if(!is_dir($model_file->ubicacion.$gestion)){
                    mkdir($model_file->ubicacion.$gestion);
                    if(!is_dir($model_file->ubicacion.$gestion."/".$etapa)){
                        mkdir($model_file->ubicacion.$gestion);
                    }
                }else{
                    if(!is_dir($model_file->ubicacion.$gestion."/".$etapa)){
                        mkdir($model_file->ubicacion.$gestion."/".$etapa);
                    }
                }

                $model_file->file->saveAs($model_file->ubicacion.$gestion."/".$etapa."/".$model_file->file->baseName . '.' . $model_file->file->extension);

                $cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_to_wincache;
                $cacheSettings = array(
                    'cacheTime' => 600
                );
                \PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

                $objPHPExcel = \PHPExcel_IOFactory::load($model_file->ubicacion.$gestion."/".$etapa."/".$model_file->file->baseName . '.' . $model_file->file->extension);

                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

                $worksheetTitle     = $objWorksheet->getTitle();
                $highestRow         = $objWorksheet->getHighestRow(); // e.g. 10
                $highestColumn      = $objWorksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);

                for($col = 0; $col <= $highestColumnIndex; $col++){
                    $cell = $objWorksheet->getCellByColumnAndRow($col, 2);
                    $val = $cell->getValue();
                    if(strtolower($val) == strtolower("RUDE")){
                        $posiciones["rude"] = $col;
                    }
                    if(strtolower($val) == $texto_columna_puntaje){
                        $posiciones["puntaje"] = $col;
                        continue;
                    }
                }

                for ($row = 3; $row <= $highestRow; ++ $row) {
                    $cell = $objWorksheet->getCellByColumnAndRow((int) $posiciones["rude"], $row);
                    $rude = $cell->getValue();

                    $cell = $objWorksheet->getCellByColumnAndRow(1, $row);
                    $nombre = $cell->getValue();

                    $cell = $objWorksheet->getCellByColumnAndRow(2, $row);
                    $ap_paterno = $cell->getValue();

                    $cell = $objWorksheet->getCellByColumnAndRow(3, $row);
                    $ap_materno = $cell->getValue();

                    if($rude == null || $rude == "x"){
                        $consult =
                        $estudiante = Estudiantes::findOne(["NOMBRE"=> $nombre, "Ap_PATERNO"=> $ap_paterno, "Ap_MATERNO"=>$ap_materno,"GESTION"=>$gestion]);
                    }else{
                        $estudiante = Estudiantes::findOne(["RUDE"=>$rude, "GESTION"=>$gestion]);
                    }

                    if(!is_null($estudiante)){
                        $cell = $objWorksheet->getCellByColumnAndRow($posiciones["puntaje"], $row);
                        $nota = $cell->getValue();
                        Estudiantes::updateAll(["NOTA"=>$nota, "ETAPA"=>$etapa],["RUDE"=>$rude, "GESTION"=>$gestion]);
                    }
                }

            }else{
            }
        } else {
            return $this->render('nota', [
                'model' => $model_file, 'gestiones'=>$gestiones
            ]);
        }

        return $this->render('nota', [
            'model' => $model_file, 'gestiones'=>$gestiones
        ]);
    }

    /**
     * Updates an existing Estudiantes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        Yii::$app->session->open();
        $url = Yii::$app->session->get('urlDatos');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id, 'url'=>$url]);
        } else {
            return $this->render('update', [
                'model' => $model, 'url'=>$url
            ]);
        }
    }

    public function actionUpdateajax()
    {

        $model = $this->findModel($_POST['id']);

        //Yii::$app->response->format = 'json';

        $selecc_etapa = 'SELECC_ETAPA'.$_POST['nro_etapa'];

        $model->$selecc_etapa = (int)$_POST['etapa_selecc'];

        if(Yii::$app->request->isAjax){
            if ($model->save()) {
                return Json::encode(['response'=>'true']);
            } else {
                return Json::encode(['response'=>'false']);
            }
        }
    }

    /**
     * Deletes an existing Estudiantes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Estudiantes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Estudiantes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Estudiantes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGestionhistorial()
    {
        $model_custom = new CustomForm();
        $gestiones = $model_custom->gestiones();
        $searchModel = new EventoSearch();
        //$eventos = Evento::find()->where(['USUARIO'=>new \MongoId(Yii::$app->user->getId())])->one();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('gestionHistorial',[
            'model'=>$model_custom,
            'gestiones'=>$gestiones,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'eventos' => $eventos,
            ]);
            
    }
    
    public function actionHistorial()
    {
        $searchModel = new EventoSearch();

        $eventos = new Evento();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('historial',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'eventos' => $eventos,
        ]);
    }
}
