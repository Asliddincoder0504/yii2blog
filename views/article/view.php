<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Article $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="card">
    <div class="card-body">

        <?php if ($model->image): ?>
            <p>
                <img src="<?= Yii::getAlias('@web/uploads/' . $model->image) ?>"
                     style="max-width:100%; border-radius:8px;">
            </p>
        <?php endif; ?>

        <p class="text-muted">
            ✍ <?= Html::encode($model->author) ?>
            | 📅 <?= Yii::$app->formatter->asDate($model->created_at) ?>
            | 👁 <?= $model->views ?> marta
        </p>

        <p>
            <?= nl2br(Html::encode($model->full_text)) ?>
        </p>

    </div>
</div>


</div>
