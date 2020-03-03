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
        // $url_api = 'https://fcm.googleapis.com/fcm/send';
        // $key = 'AAAAdo7fu6Y:APA91bFCoCti2s6_WP6sCtd02O7fwWKX9Xqo87m3eMeQXI8v-Az-_h2LfkBVnhCb258Y5V_j6FWjlTP0zu9j3emUmVlxuSx4UZ7ERFz7EtmXAK3pN1COFM0eFAcNUSR_SDVNmLyG0RhF';
        // $json = '{
            
        //     "to": "/topics/Noticias",
        //     "notification" : {
        //         "title": "Suco baitola:",
        //         "body": "Achou a solução",
        //         "android_channel_id": "default_channel_id",
        //     }
        // }';
        // // Inicia 'o CURL, definindo o site alvo:
        // $ch = curl_init();
        // curl_setopt_array($ch, [
        //     CURLOPT_URL => $url_api,
        //     // CURLOPT_POST => True,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     // Equivalente ao -H:
        //     CURLOPT_HTTPHEADER => [
        //         "Authorization: key=$key",
        //         "Content-Type: application/json;charset=UTF-8",
        //     ],
        //     CURLOPT_POSTFIELDS => $json,
        //     // Permite obter resposta:
        //     CURLOPT_RETURNTRANSFER => true,
        // ]);

        // // Executa:
        // $resultado = curl_exec($ch);
        // var_dump($resultado);
        // die();

        // Encerra CURL:
        // curl_close($ch);
        // return True;
        // var_dump(date("d/m/Y H:i:s", time()));
        // die;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            // CURLOPT_ENCODING => "",
            // CURLOPT_MAXREDIRS => 10,
            // CURLOPT_TIMEOUT => 30,
            // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POST => True,
            CURLOPT_POSTFIELDS => '{
                "to":  "/topics/Noticias",
                "notification" : {
                    "title": "' . date("d/m/Y H:i:s", time()) . ' Suco de Frutas:",
                    "body": "' . $body . '"
                }
            }',
            CURLOPT_HTTPHEADER => array(
                "authorization: key=AAAAdo7fu6Y:APA91bFCoCti2s6_WP6sCtd02O7fwWKX9Xqo87m3eMeQXI8v-Az-_h2LfkBVnhCb258Y5V_j6FWjlTP0zu9j3emUmVlxuSx4UZ7ERFz7EtmXAK3pN1COFM0eFAcNUSR_SDVNmLyG0RhF",
                "content-type: application/json;charset=UTF-8",
            ),
                // "cache-control: no-cache",
                // "postman-token: b5471185-6921-5cea-bfd0-cdf0d252a8df"
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }

        var_dump($response);
        die;
        return $response or $err;
    }

}