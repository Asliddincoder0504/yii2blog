<?php
/** @var yii\web\View $this */
/** @var app\models\Article[] $articles */

use yii\helpers\Html;

$this->title = 'Blog postlar';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a('➕ Post qo‘shish', ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="row">
    <?php foreach ($articles as $article): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">

                <?php if ($article->image): ?>
                    <img
                        src="<?= Yii::getAlias('@web/uploads/' . $article->image) ?>"
                        style="height:200px; object-fit:cover;"
                        class="card-img-top"
                    >
                <?php endif; ?>

                <div class="card-body">
                    <h5><?= Html::encode($article->title) ?></h5>
                    <p><?= Html::encode($article->text) ?></p>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <small>👁 <?= $article->views ?></small>

                    <?= Html::a(
                        'Batafsil',
                        ['view', 'id' => $article->id],
                        ['class' => 'btn btn-sm btn-primary']
                    ) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
