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

        if (Yii::$app->request->isPost) {
            
            
            $file->imageFile = UploadedFile::getInstance($model, 'imageFile');
            
            $model->image_noticia = $file->upload();
        }
        // echo "<pre>";
        // var_dump(Yii::$app->request->post());
        // echo "</pre>";
        // echo "<pre>";
        // var_dump($model);
        // echo "</pre>";
        // die;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->notificaApp("testando noticia do suco");
            return $this->redirect(['view', 'id' => $model->id_noticias]);
        }

        return $this->render('create', [
            'model' => $model,
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
    
    public function actionPorCategoria($id)
    {
        $model = Noticia::find()->where(['id_categoria'=>$id])->all();
        echo "<pre>";
        var_dump($model);
        echo "</pre>";
        die;
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

    protected function notificaApp($body)
    {
        // Acessar API com HTTP Authenticate
        // $method = 'POST';
        $url_api = 'https://fcm.googleapis.com/fcm/send';
        $key = 'AAAAdo7fu6Y:APA91bFCoCti2s6_WP6sCtd02O7fwWKX9Xqo87m3eMeQXI8v-Az-_h2LfkBVnhCb258Y5V_j6FWjlTP0zu9j3emUmVlxuSx4UZ7ERFz7EtmXAK3pN1COFM0eFAcNUSR_SDVNmLyG0RhF';
        $json = '{
            "to": "",
            "notification" : {
                "title": "Título da notificação",
                "body": "Teste",
            }
        }';
        // Inicia 'o CURL, definindo o site alvo:
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url_api,
            CURLOPT_POST => True,
            // Equivalente ao -H:
            CURLOPT_HTTPHEADER => [
                "Authorization: key=$key",
                "Content-Type: application/json;charset=UTF-8",
            ],
            CURLOPT_POSTFIELDS => $json,
            // Permite obter resposta:
            CURLOPT_RETURNTRANSFER => true,
        ]);

        // Executa:
        $resultado = curl_exec($ch);
        var_dump($resultado);
        die();

        // Encerra CURL:
        curl_close($ch);
        return True;

        // $params=['name'=>'John', 'surname'=>'Doe', 'age'=>36];
        // $defaults = array(
        //     CURLOPT_URL => 'http://myremoteservice/',
        //     CURLOPT_POST => true,
        //     CURLOPT_POSTFIELDS => $params,
        // );
        // $ch = curl_init();
        // curl_setopt_array($ch, ($options + $defaults));
    }

}