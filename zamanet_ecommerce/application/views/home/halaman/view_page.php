<?php $tanggal = tgl_indo($record['tgl_posting']); ?>

<div class="row">
    <div class="col-12">
        <div class="block post post--layout--classic">
            <div class="post__header post-header post-header--layout--classic">

                <h1 class="post-header__title"><?= $record['judul']; ?></h1>
                <div class="post-header__meta">
                    <div class="post-header__meta-item">Oleh: Admin</div>
                    <div class="post-header__meta-item"><?= $tanggal; ?></div>
                    <div class="post-header__meta-item">Dilihat <?= $record['dibaca']; ?>x</div>
                </div>
            </div>

            <!-- <div class="post__featured"><a href="#"><img src="" alt=""></a></div> -->

            <div class="post__content typography">
                <?= $record['isi_halaman']; ?>
            </div>

        </div>
    </div>

</div>