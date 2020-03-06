<?php

namespace app\controllers;

use Yii;
use app\models\Noticia;
use app\models\NoticiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;

use app\models\UploadForm;
use app\models\Categoria;

/**
 * NoticiaController implements the CRUD actions for Noticia model.
 */
class NoticiaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Noticia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoticiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single Noticia model.
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
     * Creates a new Noticia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Noticia();
        $file = new UploadForm();
        $categorias = Categoria::find()->select(['descricao_categoria'])->indexBy('id_categoria')->column();

        if (Yii::$app->request->isPost) {
            
            
            $file->imageFile = UploadedFile::getInstance($model, 'imageFile');
            
            $model->image_noticia = $file->upload();
        }
        // if ($model->load(Yii::$app->request->post())){
        //     echo "<pre>";
        //     var_dump($model);
        //     echo "</pre>";
        //     die;
        // }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // $this->notificaApp($model);
            return $this->redirect(['view', 'id' => $model->id_noticias]);
            
        }

        return $this->render('create', [
            'model' => $model,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Updates an existing Noticia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_noticias]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Noticia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Noticia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Noticia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Noticia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    protected function notificaApp($model)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => True,
            CURLOPT_POSTFIELDS => '{
                "to":  "/topics/Noticias",
                "notification" : {
                    "title": "' . $model->titulo_noticia . '",
                    "body": "' . $model->descricao_noticia . '",
                    "color": "#00008B",
                    "ticker": "' . $model->id_noticias . '",
                    "image": "https://miguelasnew.000webhostapp.com/' . $model->image_noticia . '"
                },
                "data" : {
                    "id" : "' . $model->id_noticias . '",
                }
            }',
            CURLOPT_HTTPHEADER => array(
                "authorization: key=AAAAdo7fu6Y:APA91bFCoCti2s6_WP6sCtd02O7fwWKX9Xqo87m3eMeQXI8v-Az-_h2LfkBVnhCb258Y5V_j6FWjlTP0zu9j3emUmVlxuSx4UZ7ERFz7EtmXAK3pN1COFM0eFAcNUSR_SDVNmLyG0RhF",
                "content-type: application/json;charset=UTF-8",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        
        return !($err) ? $response : "cURL Error #:" . $err;
    }
}
