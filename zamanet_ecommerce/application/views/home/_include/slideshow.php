<div class="block-slideshow block-slideshow--layout--full block">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="block-slideshow__body">

                    <div class="owl-carousel" id="MainSlider">

                        <?php
                        $slide = $this->db->query("SELECT * FROM tb_web_slide ORDER BY id_slide DESC");;
                        foreach ($slide->result_array() as $row) {
                        ?>
                            <a class="block-slideshow__slide" href="<?= base_url() . $row['link']; ?>">
                                <div class="block-slideshow__slide-image block-slideshow__slide-image--desktop" style="background-image: url('<?= base_url('assets/images/slider/') . $row['gambar_besar']; ?>')"></div>
                                <div class="block-slideshow__slide-image block-slideshow__slide-image--mobile" style="background-image: url('<?= base_url('assets/images/slider/') . $row['gambar_kecil']; ?>')"></div>
                                <div class="block-slideshow__slide-content">
                                    <div class="block-slideshow__slide-title text-justify">
                                        <?= $row['judul']; ?>
                                    </div>
                                    <div class="block-slideshow__slide-text text-justify" style="width: 450px">
                                        <?= $row['ket']; ?>
                                    </div>
                                    <div class="block-slideshow__slide-button">
                                        <span class="btn btn-primary btn-lg">
                                            Selengkapnya
                                        </span>
                                    </div>
                                </div>
                            </a>

                        <?php } ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>