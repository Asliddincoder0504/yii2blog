<?php
/** @var yii\web\View $this */
/** @var app\models\Article[] $articles */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Blog';
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">My Blog</h1>
        <p class="lead">So‘nggi postlar</p>

        <p>
            <?= Html::a(
                '➕ Post qo‘shish',
                ['/article/create'],
                ['class' => 'btn btn-success btn-lg']
            ) ?>
        </p>
    </div>

    <div class="body-content">
        <div class="row">

            <?php foreach ($articles as $article): ?>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">

                        <?php if ($article->image): ?>
                            <img
                                src="<?= Yii::getAlias('@web/uploads/' . $article->image) ?>"
                                class="card-img-top"
                                style="height:200px; object-fit:cover;"
                            >
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title">
                                <?= Html::encode($article->title) ?>
                            </h5>

                            <p class="card-text">
                                <?= Html::encode($article->text) ?>
                            </p>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <small>👁 <?= $article->views ?></small>

                            <?= Html::a(
                                'Batafsil →',
                                ['/article/view', 'id' => $article->id],
                                ['class' => 'btn btn-sm btn-outline-primary']
                            ) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

</div>
