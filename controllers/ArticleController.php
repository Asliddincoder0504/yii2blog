<?php

namespace app\controllers;
use yii\web\UploadedFile;
use Yii;
use app\models\Article;
use app\models\TalabaArticle;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Article models.
     *
     * @return string
     */
public function actionIndex()
{
    $articles = Article::find()
        ->orderBy(['created_at' => SORT_DESC])
        ->limit(6)
        ->all();

    return $this->render('index', [
        'articles' => $articles,
    ]);
}

    /**
     * Displays a single Article model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
{
    $model = $this->findModel($id);

    // Ko‘rishlar sonini avtomatik oshirish
    $model->views += 1;
    $model->save(false); // validatsiyasiz saqlash

    return $this->render('view', [
        'model' => $model,
    ]);
}


    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
{
    $model = new Article();
    $model->created_at = date('Y-m-d H:i:s');
    $model->views = 0;

    if ($model->load(Yii::$app->request->post())) {

        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        if ($model->imageFile) {
            $fileName = time() . '.' . $model->imageFile->extension;
            $model->imageFile->saveAs(Yii::getAlias('@webroot/uploads/') . $fileName);
            $model->image = $fileName;
        }

        if ($model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}


    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
{
    $model = $this->findModel($id);
    $model->updated_at = date('Y-m-d H:i:s');

    if ($model->load(Yii::$app->request->post())) {

        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        if ($model->imageFile) {
            $fileName = time() . '.' . $model->imageFile->extension;
            $model->imageFile->saveAs(Yii::getAlias('@webroot/uploads/') . $fileName);
            $model->image = $fileName;
        }

        if ($model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}


    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
