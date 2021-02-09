<div class="modal fade" id="rekening" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="myModalLabel">No Rekening Perusahaan</h5>
      </div>
      <div class="modal-body">
        <?php
        echo "<table class='table table-hover table-condensed'>
                  <tr bgcolor=#cecece>
                    <th>No</th>
                    <th>Nama Bank</th>
                    <th>No Rekening</th>
                    <th>Atas Nama</th>
                    <th></th>
                  </tr>";
        $no = 1;
        $rekening = $this->db->query("SELECT * FROM tb_toko_rekening");
        foreach ($rekening->result_array() as $row) {
          echo "<tr>
                        <td>$no</td>
                        <td>$row[nama_bank]</td>
                        <td>$row[no_rekening]</td>
                        <td>$row[pemilik_rekening]</td>
                      </tr>";
          $no++;
        }
        echo "</table>";
        ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="lupass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">
          <h6 class="text-center mb-2">Lupa password Anda?</h6>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <?php
        $attributes3 = array('id' => 'formku', 'class' => 'form-horizontal', 'role' => 'form');
        echo form_open_multipart('auth/lupass', $attributes3);
        ?>
        <div class='col-sm-12'>
          <div class="form-group">
            <input class="form-control" style='text-transform:lowercase;' type="email" class="required form-control" name="a" placeholder="Masukan Email Anda" required>
          </div>
        </div>
        <div class='col-sm-12'>
          <div class="form-group">
            <button type="submit" name='lupa' class="form-control btn btn-primary">Kirim</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>