<?php

namespace app\controllers;

use Yii;
use app\models\Estudiantes;
use app\models\EstudiantesBusqueda;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
        $ubicacion = "listas_excel/";
        $model = array();
        if (Yii::$app->request->post()) {

            $objPHPExcel = \PHPExcel_IOFactory::load($ubicacion."test_proyecto.xlsx");

            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $worksheetTitle     = $worksheet->getTitle();
                $highestRow         = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);

                for ($row = 2; $row <= $highestRow; ++ $row) {

                    $model = new Estudiantes();
                    //DISTRITO EDUCATIVO
                    $cell = $worksheet->getCellByColumnAndRow(1, $row);
                    $val = $cell->getValue();
                    $model->DISTRITO_EDUCATIVO = $val;

                    //MATERIA
                    $cell = $worksheet->getCellByColumnAndRow(2, $row);
                    $val = $cell->getValue();
                    $model->MATERIA = $val;

                    //CURSO
                    $cell = $worksheet->getCellByColumnAndRow(3, $row);
                    $val = $cell->getValue();
                    $model->CURSO = $val;

                    //NOMBRE
                    $cell = $worksheet->getCellByColumnAndRow(4, $row);
                    $val = $cell->getValue();
                    $model->NOMBRE = $val;

                    //AP_PATERNO
                    $cell = $worksheet->getCellByColumnAndRow(5, $row);
                    $val = $cell->getValue();
                    $model->Ap_PATERNO = $val;

                    //AP_MATERNO
                    $cell = $worksheet->getCellByColumnAndRow(6, $row);
                    $val = $cell->getValue();
                    $model->Ap_MATERNO = $val;

                    //RUDE
                    $cell = $worksheet->getCellByColumnAndRow(7, $row);
                    $val = $cell->getValue();
                    $model->RUDE = $val;

                    //GENERO
                    $cell = $worksheet->getCellByColumnAndRow(8, $row);
                    $val = $cell->getValue();
                    $model->GENERO = $val;

                    //CI
                    $cell = $worksheet->getCellByColumnAndRow(9, $row);
                    $val = $cell->getValue();
                    $model->CI = $val;

                    //FECHA_NAC
                    $cell = $worksheet->getCellByColumnAndRow(10, $row);
                    $val = $cell->getValue();
                    $model->FECHA_NAC = new \MongoDate(strtotime($val." 00:00:00"));


                    //CORREO
                    $cell = $worksheet->getCellByColumnAndRow(11, $row);
                    $val = $cell->getValue();
                    $model->CORREO = $val;

                    //FONO
                    $cell = $worksheet->getCellByColumnAndRow(12, $row);
                    $val = $cell->getValue();
                    $model->FONO = $val;

                    /**GUARDADO*/
                    if($model->save()){

                    }
                }
            }


            //return $this->redirect(['view', 'id' => (string)$model->_id]);
        } else {
            return $this->render('excel', [
                'model' => $model,
            ]);
        }

        return $this->render('excel', [
            'model' => $model,
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
