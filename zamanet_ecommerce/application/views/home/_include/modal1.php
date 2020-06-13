<div class="modal fade" id="uploadfoto">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content rounded">
            <div class="modal-body">
                <?php
                $attributes = array('class' => 'form', 'role' => 'form');
                echo form_open_multipart('members/foto', $attributes); ?>

                <h6 class="text-center mb-3 mt-3">Ganti foto profil</h6>

                <div class="custom-file mt-3 mb-3">
                    <input style='text-transform:lowercase;' type="file" class="custom-file-input" name="userfile" required>
                    <label class="custom-file-label" for="customFileLangHTML" data-browse="Pilih">Pilih file..</label>
                </div>


                <div class="row mt-3">
                    <div class="col-5 col-md-5 col-sm-5 col-xs-5 mx-auto">
                        <button type="button" class="btn btn-danger btn-sm btn-block" data-dismiss="modal" aria-hidden="true">Batal</button>
                    </div>
                    <div class="col-5 col-md-5 col-sm-5 col-xs-5 mx-auto">
                        <button type="submit" name='submit' class="btn btn-primary btn-sm btn-block">Perbarui</button>
                    </div>
                </div>

            </div>
            </form>
        </div>

    </div>
</div>
</div>