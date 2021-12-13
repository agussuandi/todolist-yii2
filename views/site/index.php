<?php

use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'Todolist';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Todolist Apps!</h1>
        <p class="lead">You have successfully created your Yii-powered application.</p>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-md-8">
                <?= GridView::widget([
                    'dataProvider'  => $dataProvider,
                    'summary'       => '',
                    'columns'       => [
                        [
                            'class'         => 'yii\grid\SerialColumn',
                            'header'        => 'No.',
                            'headerOptions' => ['style' => 'width: 10px']
                        ],
                        [
                            'header' => 'Kegiatan',
                            'value' => function($model) {
                                return $model->kegiatan;
                            }
                        ],
                        [
                            'header' => 'Tanggal',
                            'value' => function($model) {
                                return date('m/d/Y', strtotime($model->kegiatan_date));
                            }
                        ],
                        [
                            'header' => '#',
                            'format' => 'raw',
                            'value' => function($model) {
                                $btn = '<form id="destroy-form-'.$model->id.'" action="'.Url::to(['/site/destroy', 'id' => $model->id]).'" method="POST">
                                    <input type="hidden" name="'.Yii::$app->request->csrfParam.'" value="'.Yii::$app->request->csrfToken.'" />
                                    <button type="button" class="btn btn-info btn-sm" onclick="handleUpdate(`'.$model->id.'`, `'.$model->kegiatan.'`, `'.$model->kegiatan_date.'`)">Ubah</button>
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>';
                                return "{$btn}";
                            }
                        ],
                    ]
                ])?>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h6>Form Input / Update</h6>
                    </div>
                    <form method="POST" action="<?=Url::to(['/site/store'])?>" id="form-todolist">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kegiatan">Kegiatan / Aktifitas</label>
                                <input type="text" class="form-control" name="kegiatan" id="kegiatan" autocomplete="off" required />
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" required />
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="button-submit">Simpan</button>
                            <button type="reset" class="btn btn-warning" onclick="handleBatal()">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    handleUpdate = (id, kegiatan, tgl) => {
        document.getElementById('form-todolist').action = `<?=Url::to(['/site/update'])?>/${id}`
        document.getElementById('kegiatan').value = kegiatan
        document.getElementById('tanggal').value = tgl
        document.getElementById('button-submit').innerText = 'Update'
    }

    handleBatal = () => {
        document.getElementById('form-todolist').action = `<?=Url::to(['/site/store'])?>`
        document.getElementById('kegiatan').value = ''
        document.getElementById('tanggal').value = ''
        document.getElementById('button-submit').innerText = 'Simpan'
    }
</script>