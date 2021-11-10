<div class='card'>
    <div class='card-header bg-transparent'>
        <a href="">Formulir Entri Data Riwayat Diklat</a>
    </div>
    <div class='card-body'>
        <?php $session = session(); if($session->getFlashdata('info')) : ?>
        <div class="alert alert-primary alert-dismissible mg-b-10 fade show" role="alert">
            <strong>Informasi.</strong> <?=$session->getFlashdata('info') ;?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </div>
        <br>
        <?php endif; ?>
        <form  method="POST" data-toggle="validator" role="form" action="<?=backend_url();?>/riwayat-diklat/update">
            <?=csrf_field();?>
            <input type="hidden" name="k_u" id="k_u" value="<?=$data['k_u'];?>">
            <div class="form-row">
                <div class="col-12 col-md-3 form-group">
                    <label for="kategoriDiklat">Kategori Diklat</label>
                    <select required  class="form-control form-control-sm" name="kategoriDiklat" id="kategoriDiklat">
                        <?php foreach($kategori_diklat as $r_dk):?>
                            <option <?=selected($data['DIKTEKFUNG'],$r_dk['nama']);?> value="<?=$r_dk['id'];?>" data-jp="<?=$r_dk['jam_pelajaran'];?>"><?=$r_dk['nama'];?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="nmDik">Nama Kegiatan Diklat</label>
                    <input type="text" required maxlength="255" class="form-control form-control-sm" name="nmDik" id="nmDik" value="<?=$data['nm_dik'];?>">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-3 form-group">
                    <label for="tmpDik">Tempat Pelaksanaan Diklat</label>
                    <input type="text"  maxlength="100" class="form-control form-control-sm" name="tmpDik" id="tmpDik" value="<?=$data['tmp_dik'];?>">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12 col-md-5 form-group">
                    <label for="pnylgrDik">Penyelenggara</label>
                    <input type="text"  maxlength="100" class="form-control form-control-sm" name="pnylgrDik" id="pnylgrDik" value="<?=$data['pnylgr_dik'];?>">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="agktDik">Angkatan Diklat</label>
                    <input type="text"  maxlength="10" class="form-control form-control-sm" name="agktDik" id="agktDik" value="<?=$data['agkt_dik'];?>">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-3 form-group">
                    <label for="thAgktDik">Tahun Pelaksanaan</label>
                    <input type="number" required maxlength="4" class="form-control form-control-sm tahun" name="thAgktDik" id="thAgktDik" value="<?=$data['th_agkt_dik'];?>">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12 col-md-3 form-group">
                    <label for="tglMulDik">Tanggal Mulai Diklat</label>
                    <input type="text"  maxlength="20" class="form-control form-control-sm tanggal" name="tglMulDik" id="tglMulDik" value="<?=tanggal_dMY($data['tgl_mul_dik']);?>">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-3 form-group">
                    <label for="tglSlsDik">Tanggal Selesai Diklat</label>
                    <input type="text"  maxlength="20" class="form-control form-control-sm tanggal" name="tglSlsDik" id="tglSlsDik" value="<?=tanggal_dMY($data['tgl_sls_dik']);?>">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-6 form-group">
                    <label for="jmlJamDik">Jumlah Durasi Diklat</label>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="pilihan_durasi">Pilihan Durasi</span></button>
                            <div class="dropdown-menu tx-13" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -143px, 0px);">
                                <a class="dropdown-item" onclick="changeDurasi('Jam Pelajaran')">Jam Pelajaran (JP)</a>
                                <a class="dropdown-item" onclick="changeDurasi('Hari')">Hari</a>
                                <a class="dropdown-item" onclick="changeDurasi('SKP')">SKP</a>
                            </div>
                        </div>
                        <input type="number"  class="form-control form-control-sm" name="jmlJamDik" id="jmlJamDik">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2" title="Konversi" onclick="konversi()"><i class="fas fa-exchange-alt"></i></span>
                        </div>
                        <input type="number" readonly required  class="form-control form-control-sm" name="konversijmlJamDik" id="konversijmlJamDik" value="<?=$data['jml_jam_dik'];?>">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">JP</span>
                        </div>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12 col-md-5 form-group">
                    <label for="sttppDikNo">No. STTPP / Sertifikat</label>
                    <input type="text"  maxlength="55" class="form-control form-control-sm" name="sttppDikNo" id="sttppDikNo" value="<?=$data['sttpp_dik_no'];?>">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="sttppDikTgl">Tanggal STTPP / Sertifikat Diklat</label>
                    <input type="text"  maxlength="20" class="form-control form-control-sm tanggal" name="sttppDikTgl" id="sttppDikTgl" value="<?=tanggal_dMY($data['sttpp_dik_tgl']);?>">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col-12 col-md-3 form-group">
                    <label for="sttppDikThn">Tahun STTPP / Sertifikat Diklat</label>
                    <input type="number"  maxlength="4" class="form-control form-control-sm tahun" required name="sttppDikThn" id="sttppDikThn" value="<?=$data['sttpp_dik_thn'];?>">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    <a href="<?=backend_url();?>/riwayat-diklat"  class="btn btn-sm btn-outline-light">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function changeDurasi(ex)
    {
        $("#pilihan_durasi").html(ex);
    }

    $("#jmlJamDik").keyup(function() {
        var durasi = $("#pilihan_durasi").html();
        var jumlah = $("#jmlJamDik").val();
        var jp     = 0;
        if(durasi=='Pilihan Durasi')
        {
            alert("Uupss.. Mohon pilih durasi terlebih dahulu");
        }
        else if(durasi=='Hari')
        {
            var harian =  $("#kategoriDiklat").find(':selected').data('jp');
            jp = parseInt(jumlah)*parseInt(harian);
        }
        else if(durasi=='Jam Pelajaran')
        {
            jp = parseInt(jumlah);
        }
        else if(durasi=='SKP')
        {
            jp = parseInt(jumlah);
        }
        else
        {
            jp = parseInt(jumlah)*4;
        }
        $("#konversijmlJamDik").val(jp);
    });

    function konversi()
    {
        var durasi = $("#pilihan_durasi").html();
        var jumlah = $("#jmlJamDik").val();
        var jp     = 0;
        if(durasi=='Pilihan Durasi')
        {
            alert("Uupss.. Mohon pilih durasi terlebih dahulu");
        }
        else if(durasi=='Hari')
        {
            var harian =  $("#kategoriDiklat").find(':selected').data('jp');
            jp = parseInt(jumlah)*parseInt(harian);
        }
        else if(durasi=='Jam Pelajaran')
        {
            jp = parseInt(jumlah);
        }
        else if(durasi=='SKP')
        {
            jp = parseInt(jumlah);
        }
        else
        {
            jp = parseInt(jumlah)*4;
        }
        $("#konversijmlJamDik").val(jp);
    }
</script>