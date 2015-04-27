<?php

namespace app\controllers;

use app\models\Tutor;
use app\models\Ue;
use Yii;
use app\models\Estudiantes;
use app\models\EstudiantesBusqueda;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UploadForm;
use yii\web\UploadedFile;

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
                'only' => ['index', 'view', 'create', 'update', 'delete', 'cargarexcel'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'view', 'update', 'delete', 'cargarexcel'],
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
        $searchModel = new EstudiantesBusqueda();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estudiantes model.
     * @param integer $_id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
            return $this->redirect(['view', 'id' => (string)$model->_id]);
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
        set_time_limit(240);

        $model_file = new UploadForm();

        if (Yii::$app->request->post()) {

            $model_file->file = UploadedFile::getInstance($model_file, 'file');


            if ($model_file->file && $model_file->validate()) {

                $model_file->file->saveAs($model_file->ubicacion.$model_file->file->baseName . '.' . $model_file->file->extension);

                $cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_to_wincache;
                $cacheSettings = array(
                    'cacheTime' => 600
                );
                \PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

                $objPHPExcel = \PHPExcel_IOFactory::load($model_file->ubicacion.$model_file->file->baseName.'.'.$model_file->file->extension);

                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);

                $worksheetTitle     = $objWorksheet->getTitle();
                $highestRow         = $objWorksheet->getHighestRow(); // e.g. 10
                $highestColumn      = $objWorksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);

                for ($row = 3; $row <= $highestRow; ++ $row) {

                    $model = new Estudiantes();

                    $model_tutor = new Tutor();

                    $model_ue = new Ue();

                    //DISTRITO EDUCATIVO
                    $cell = $objWorksheet->getCellByColumnAndRow(1, $row);
                    $val = $cell->getValue();
                    $model->DISTRITO_EDUCATIVO = $val;

                    //MATERIA
                    $cell = $objWorksheet->getCellByColumnAndRow(2, $row);
                    $val = $cell->getValue();
                    $model->MATERIA = $val;

                    //CURSO
                    $cell = $objWorksheet->getCellByColumnAndRow(3, $row);
                    $val = $cell->getValue();
                    $model->CURSO = $val;

                    //NOMBRE
                    $cell = $objWorksheet->getCellByColumnAndRow(4, $row);
                    $val = $cell->getValue();
                    $model->NOMBRE = $val;

                    //AP_PATERNO
                    $cell = $objWorksheet->getCellByColumnAndRow(5, $row);
                    $val = $cell->getValue();
                    $model->Ap_PATERNO = $val;

                    //AP_MATERNO
                    $cell = $objWorksheet->getCellByColumnAndRow(6, $row);
                    $val = $cell->getValue();
                    $model->Ap_MATERNO = $val;

                    //RUDE
                    $cell = $objWorksheet->getCellByColumnAndRow(7, $row);
                    $val = $cell->getValue();
                    $model->RUDE = $val;

                    //GENERO
                    $cell = $objWorksheet->getCellByColumnAndRow(8, $row);
                    $val = $cell->getValue();
                    $model->GENERO = $val;

                    //CI
                    $cell = $objWorksheet->getCellByColumnAndRow(9, $row);
                    $val = $cell->getValue();
                    $model->CI = $val;

                    //FECHA_NAC
                    $cell = $objWorksheet->getCellByColumnAndRow(10, $row);
                    $val = $cell->getValue();
                    $model->FECHA_NAC = new \MongoDate(strtotime($val." 00:00:00"));


                    //CORREO
                    $cell = $objWorksheet->getCellByColumnAndRow(11, $row);
                    $val = $cell->getValue();
                    $model->CORREO = $val;

                    //FONO
                    $cell = $objWorksheet->getCellByColumnAndRow(12, $row);
                    $val = $cell->getValue();
                    $model->FONO = $val;

                    //GESTION
                    $model->GESTION = "2015";


                    $cell = $objWorksheet->getCellByColumnAndRow(14, $row);
                    $codigosie = $cell->getValue();

                    /*Comprobar y guardar unidad educativa*/

                    $ue = Ue::find()->where(['CODIGOSIE' => $codigosie])->one();

                    if(is_null($ue)){

                        $cell = $objWorksheet->getCellByColumnAndRow(13, $row);
                        $val = $cell->getValue();
                        $model_ue->NOMBRE = $val;

                        $model_ue->CODIGOSIE = $codigosie;

                        $cell = $objWorksheet->getCellByColumnAndRow(15, $row);
                        $val = $cell->getValue();
                        $model_ue->DEPENDENCIA = $val;

                        $cell = $objWorksheet->getCellByColumnAndRow(16, $row);
                        $val = $cell->getValue();
                        $model_ue->AREA = $val;

                        $cell = $objWorksheet->getCellByColumnAndRow(17, $row);
                        $val = $cell->getValue();
                        $model_ue->PROVINCIA = $val;

                        $cell = $objWorksheet->getCellByColumnAndRow(18, $row);
                        $val = $cell->getValue();
                        $model_ue->LOCALIDAD = $val;

                        $model_ue->save();

                        $id_ue = $model_ue->_id->{'$id'};

                    }else{
                        $id_ue = $ue->_id->{'$id'};
                    }

                    /*Unidad educativa*/

                    $model->UE = new \MongoId($id_ue);



                    /*Comprobar y guardar tutor*/
                    $cell = $objWorksheet->getCellByColumnAndRow(19, $row);
                    $nom_tutor = strtolower($cell->getValue());

                    $cell = $objWorksheet->getCellByColumnAndRow(20, $row);
                    $pat_tutor = strtolower($cell->getValue());

                    $cell = $objWorksheet->getCellByColumnAndRow(21, $row);
                    $mat_tutor = strtolower($cell->getValue());

                    $tutor = Tutor::find()->where(['NOMBRE' => $nom_tutor, 'PATERNO'=>$pat_tutor,'MATERNO'=>$mat_tutor])->one();


                    if(is_null($tutor)){

                        $model_tutor->NOMBRE = $nom_tutor;

                        $model_tutor->PATERNO = $pat_tutor;

                        $model_tutor->MATERNO = $mat_tutor;

                        $cell = $objWorksheet->getCellByColumnAndRow(22, $row);
                        $val = $cell->getValue();
                        $model_tutor->GENERO = $val;

                        $cell = $objWorksheet->getCellByColumnAndRow(23, $row);
                        $val = $cell->getValue();
                        $model_tutor->CI = $val;

                        $cell = $objWorksheet->getCellByColumnAndRow(24, $row);
                        $val = $cell->getValue();
                        $model_tutor->CORREO = $val;

                        $cell = $objWorksheet->getCellByColumnAndRow(25, $row);
                        $val = $cell->getValue();
                        $model_tutor->FONO = $val;

                        $model_tutor->save();

                        $id_tutor = $model_tutor->_id->{'$id'};

                    }else{
                        $id_tutor = $tutor->_id->{'$id'};
                    }


                    /*Tutor*/

                    $model->TUTOR = new \MongoId($id_tutor);


                    /**GUARDADO**/
                    if($model->save()){

                    }

                }
            }else{
                //var_dump("aaaa");
            }
            //return $this->redirect(['view', 'id' => (string)$model->_id]);
        } else {
            return $this->render('excel', [
                'model' => $model_file,
            ]);
        }

        return $this->render('excel', [
            'model' => $model_file,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
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
}
