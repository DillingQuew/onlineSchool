<?php

/** @var yii\web\View $this */


use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

    <div class="body-content">

<?php //foreach ($lessons as $lesson):?>
<?php if(Yii::$app->user->isGuest): ?>
        <div class="alert alert-danger" role="alert">
            Чтобы начать проходить уроки, зарегистрируйтесь или войдите!
        </div>
<?php else: ?>
        <div class="site-index">
            <?php if ($data['congr']):?>

                <div class="jumbotron text-center bg-transparent alert-success">
                    <h1 class="display-4">Поздравляем!</h1>

                    <p class="lead">Вы успешно прошли курс на платформе <?= Yii::$app->name?></p>

                    <!--        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
                </div>

            <?php endif ?>
            <h3 class="mb-5">Уроков выполнено: <?= $data['count']->lessonsDone?> из <?= $data['countAll']?></h3>
<?php if(isset($data['lessons'])): ?>
        <?php for ($i = 0; $i<count($data['lessons']); $i++) {?>
        <div class="row">
            <div class="d-flex justify-content-sm-between">
                <div class="d-inline-flex gap-4">
                    <h2 class=""><?=$data['lessons'][$i]['name']?></h2>
                    <p class=""><a class="btn btn-outline-secondary" href="<?= Url::toRoute(['lessons/lesson', 'id' =>$data['lessons'][$i]['lesson_id']])?>">Начать урок &raquo;</a></p>

                    <?php if($data['lessons'][$i]['status'] == 0) { ?>
<!--                    <p>--><?php //=$lessons[$i]['status']?><!--</p>-->
                    <div class="alert alert-danger" role="alert">
                        ✖
                    </div>
                    <?php } else {?>
                        <div class="success alert-success" role="alert">
                            ✔
                        </div>
                    <?php } ?>
                </div>

            </div>

<!--            --><?php //endforeach;?>

        </div>
        <?php } ?>
<!--        <p>Уроков выполнено: --><?php //= $data['count'][0]['count(*)']?><!--</p>-->

<?php endif; ?>
<?php endif; ?>
    </div>
</div>
