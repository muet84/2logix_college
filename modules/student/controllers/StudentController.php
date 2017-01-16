<?php

namespace app\modules\student\controllers;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;

use app\modules\student\models\Student;
use app\modules\student\models\StudentParent;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    public $parentTypes = ['father', 'mother', 'guardian'];
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'batch-print' => ['POST'],
                ],
            ],
                        'access' => [
                'class' => AccessControl::className(),
//                'only' => ['index', 'logout', 'signup'],
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [ 'create', 'view'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => 'testme'//YII_ENV_TEST ? 'testme' : null, //'testme'//
            ],
        ];
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new \app\modules\student\models\StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        $dataProvider = new ActiveDataProvider([
//            'query' => Student::find(),
//        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $printView=false)
    {
        $model = $this->findModel($id);
        
        $model->status = 1;
        $model->save(false);
        if( $printView ){
//            $id = [132,130];
            
                
                return $this->renderPartial('/emailtemplates/receipt', [
                        'parent' => $model->studentParent,
                        'sibling' => $model->sibling,
                        'acadmic' => $model->academic,
                        'sports' => $model->sports,
                        'model' => $model,
                    ]);
            }
            
//        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
                'modelParent' => $this->findParentModel($id)
            ]);
        
//        }
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();
        $model->course_code = "ref_al";
         $model->refrence_number = "ref";
         $parentTypes = $this->parentTypes;
        
        $modelsSibling = [new \app\modules\student\models\Sibling()];
        $modelsSiblingBvc = [new \app\modules\student\models\SiblingBvc()];
        $modelsAcademic = [new \app\modules\student\models\Academic()];
        $modelsSports = [new \app\modules\student\models\Sports()];
        $transaction = \Yii::$app->db->beginTransaction();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                $errors = ActiveForm::validate($model, 'email');
//                
//                $modelParent = new StudentParent();
//
//                $modelParent->load(Yii::$app->request->post('StudentParent'),'guardian');
//                $modelParent->parent_type = 'guardian';
                $pErrors=[];
                $parentErrors=[];
                 foreach ($parentTypes as $key => $parent) {
                $modelParent = new StudentParent();

                $modelParent->load(Yii::$app->request->post('StudentParent'),$parent);
                 $modelParent->parent_type = $parent;
                 $modelParent->student_id = 5555;
                $pErrors[$parent] = ActiveForm::validate($modelParent); 
                    foreach ($pErrors[$parent] as $index=>$pError){
                        $indexV =explode('-', $index);
//                        if($indexV[1] = 'first_name')
                        $errors['studentparent-'.$parent.'-'.$indexV[1]]=$pError;
//                    array_push( $errors, ['studentparent-'.$parent.'-'.$indexV[1]=>$pError]);  
//                        studentparent-father-first_name
                    }
                
                }
//                 print_r($pErrors['father']);
                return $errors;
            }
        if (Yii::$app->request->isPost and !Yii::$app->request->isAjax) {
            $photo_path = UploadedFile::getInstance($model, 'imageFiles');
            
            if(!is_null($photo_path)){
                $timestamp = time();
                $newImage = $timestamp.'_'. $photo_path->baseName . '.' . $photo_path->extension;
                if ($photo_path->saveAs('uploads/' .$newImage)) {
                    Image::thumbnail('@webroot/uploads/'.$newImage, 120, 120)
                        ->save(Yii::getAlias('@webroot/uploads/thumbs/'.$newImage), ['quality' => 80]);
                    // file is uploaded successfully
                    $model->photo_path = $timestamp."_".$photo_path->baseName . '.' . $photo_path->extension;
//                    $model->imageFiles = $photo_path->name;
                }
            }
        }
        if ($valid = $model->load(Yii::$app->request->post()) && $model->save()) {
            
            
            
            foreach ($parentTypes as $key => $parent) {
                $modelParent = new StudentParent();

                $modelParent->load(Yii::$app->request->post('StudentParent'),$parent);
                $modelParent->student_id = $model->id;
                $modelParent->parent_type = $parent;
//                $modelParent->save();
                 if (! ($flag = $modelParent->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
            }
            
            
            $modelsSibling = Model::createMultiple(\app\modules\student\models\Sibling::classname());
            Model::loadMultiple($modelsSibling, Yii::$app->request->post());
            
            $modelsSiblingB = Model::createMultiple(\app\modules\student\models\SiblingBvc::classname());
            Model::loadMultiple($modelsSiblingB, Yii::$app->request->post());
            
            $modelsAcademic = Model::createMultiple(\app\modules\student\models\Academic::classname());
            Model::loadMultiple($modelsAcademic, Yii::$app->request->post());
            
            $modelsSports = Model::createMultiple(\app\modules\student\models\Sports::classname());
            Model::loadMultiple($modelsSports, Yii::$app->request->post());

//             ajax validation
//            if (Yii::$app->request->isAjax) {
//                Yii::$app->response->format = Response::FORMAT_JSON;
//                return ArrayHelper::merge(
//                    ActiveForm::validateMultiple($modelsSibling),
//                    ActiveForm::validateMultiple($modelsSiblingB),
//                    ActiveForm::validateMultiple($modelsAcademic),
//                    ActiveForm::validateMultiple($modelsSports),
//                   return ActiveForm::validate($model);
//                );
//            }
            
            $valid = Model::validateMultiple($modelsSibling)&& $valid;
            $valid = Model::validateMultiple($modelsSiblingB)&& $valid;
            $valid = Model::validateMultiple($modelsAcademic)&& $valid;
            $valid = Model::validateMultiple($modelsSports)&& $valid;
//                        print_r($modelsAcademic[0]->getErrors());

            if ($valid) { 
                
                try {
                        foreach ($modelsSibling as $modelSibling) {
                            if (!isset($modelSibling)) $modelSibling = new stdClass();
                            $modelSibling->student_id = $model->id;
                            if($modelSibling->name!= "" ){
                                if (! ($flag = $modelSibling->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            
                            }
                        }
                        foreach ($modelsSiblingB as $modelSiblingB) {
                            if (!isset($modelSiblingB)) $modelSiblingB = new stdClass();
                            $modelSiblingB->student_id = $model->id;
                            if($modelSiblingB->name!= ""){
                                
                                if (! ($flag = $modelSiblingB->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        foreach ($modelsAcademic as $modelAcademic) {
                            if (!isset($modelAcademic)) $modelAcademic = new stdClass();
                            $modelAcademic->student_id = $model->id;
                            if (! ($flag = $modelAcademic->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        foreach ($modelsSports as $modelSports) {
                            if (!isset($modelSports)) $modelSports = new stdClass();
                            $modelSports->student_id = $model->id;
                            if (! ($flag = $modelSports->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        if ($flag) {
                         
                            $studentDOBdate = trim( date('d-m-y',strtotime($model->date_of_birth)) ,'-');
                            $model->refrence_number = "BVC-ALVL-".date(Y)."-".$studentDOBdate .$model->id;
                            if($model->save(true, ['refrence_number'])){
                                $transaction->commit();;
                            return $this->redirect(['view', 'id' => $model->id]);

                            }
                        }
//                        else{
//                            print_r($model->getErrors());
//                            return $this->setReturn($model);
//                        } 
                                                
//            }
            } catch (Exception $e) {
//                    $transaction->rollBack();
                }
                
            } 
//            print_r($modelsAcademic[2]->getErrors());
           
//            print_r(Yii::$app->request->post('Academic'));
        } else { //print_r($model->getErrors());
            return $this->setReturn($model);
        }
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Student model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionBatchPrint() {
        
    
                $ids= Yii::$app->request->post('ids');
                foreach ($ids as $id ){
                    $model = $this->findModel($id);

                    $template .= $this->renderPartial('/emailtemplates/receipt', [
                        'parent' => $model->studentParent,
                        'sibling' => $model->sibling,
                        'acadmic' => $model->academic,
                        'sports' => $model->sports,
                        'model' => $model,
                    ]);
                
                }
                return $template;   

            
    }
    public function setReturn($model) {
        $modelParent = [];
            foreach ($this->parentTypes as $key => $parent) {
                    $modelParent[$parent] = new StudentParent();
               }
            return $this->render('create', [
                'model' => $model,
                'modelParent' => $modelParent,
                'modelsSiblingBvc' => (empty($modelsSiblingB)) ? [new \app\modules\student\models\SiblingBvc() ] : $modelsSiblingB,
                'modelsSibling' => (empty($modelsSibling)) ? [new \app\modules\student\models\Sibling()] : $modelsSibling,
                'modelsAcademic' => (empty($modelsAcademic)) ? [new \app\modules\student\models\Academic()] : $modelsAcademic,
                'modelsSports' => (empty($modelsSports)) ? [new \app\modules\student\models\Sports()] : $modelsSports
            ]);
    }
    public function actionExcelExport() {
        
        $ids= Yii::$app->request->post('ids');  
        if(is_array($ids) ){
            $query = Student::find()->where(['id' =>$ids ]);
        } else{ 
            $query = Student::find();
            
        }
        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [
                'Student' => [
                    'class' => 'codemix\excelexport\ActiveExcelSheet',
                    'query' => $query,
                    'attributes' => [
               "id", 
	"refrence_number", "first_name", 	"middle_name", 
	"last_name", 
	"gender", 
	"date_of_birth", 
	"nationality", 
	"address", 
	"phone", 
	"mobile", 
	"email", 
	"class_nine_school", 
	"class_nine_city", 
	"class_nine_country", 
	"class_ten_school", 
	"class_ten_city", 
	"class_ten_country", 
	"class_eleven_school", 
	"class_eleven_city", 
	"class_eleven_country", 
	"suspended_from_school", 
	"suspended_details", 
	"languages_spoken", 
	"support_admission_decsion", 
	"emergency_name", 
	"emergency_relation", 
	"emergency_contact", 
	"emergency_address", 
	"emergency_email", 
	"primary_contact", 
	"speaking_event", 
	"drama_theater", 
	"sports_continue", 
	"subject_selected", 
	"course_after_alevel", 
	"why_bvc", 
	"contribute_bvc", 
	"tenyears_fromnow", 
	"strength_weaknesses", 
	"exampe_leadership", 
//	essay_topic, 
	"essay_content", 
	"photo_path", 
        "create_date"                
            ],

            // If not specified, the label from the respective record is used.
            // You can also override single titles, like here for the above `team.name`
//        'titles' => [
////                'D' => 'Team Name',
//        ],
//        'formats' => [
//                // Either column name or 0-based column index can be used
////                'date_of_birth' => '#,##0.00',
//                6 => 'dd/mm/yyyy hh:mm:ss',
//            ],            
        'formatters' => [
                // Dates and datetimes must be converted to Excel format
                6 => function ($value, $row, $data) {
                    return \PHPExcel_Shared_Date::PHPToExcel(strtotime($value));
                },
            ],            

        ]
    ]
        ]);
        $file->send('student'.date('Y-m-d').'.xlsx');
    }

    /**
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findParentModel($id)
    {
        $models =[];
        foreach ($this->parentTypes as  $parent) {
            if (( $models[$parent] = StudentParent::findOne(['student_id'=> $id, 'parent_type'=>$parent]) ) !== null) {
//                $models[$parent] = $tempModel;
            }
            else {
                $models[$parent] = new StudentParent();
            }
        }
        
        if(count($models) < 1) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }else{
            return $models;
        }
    }
}
