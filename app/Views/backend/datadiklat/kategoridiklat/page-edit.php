<div class='card'>
    <div class='card-header bg-transparent'>
        Formulir Ubah Data Kategori Diklat
    </div>
    <div class='card-body'>
        <form  method="POST" data-toggle="validator" role="form" action="<?=backend_url();?>/kategori-diklat/update">
            <input type="hidden" name="id" id="id" value="<?=$data['id'];?>">
            <div class="form-row">
                <div class="col form-group">
                    <label for="kode">Kode</label>
                    <input type="text" required maxlength="2" class="form-control form-control-sm" name="kode" id="kode" readonly value="<?=$data['kode'];?>">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="nama">Nama</label>
                    <input type="text" required maxlength="255" class="form-control form-control-sm" name="nama" id="nama" value="<?=$data['nama'];?>">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="jamPelajaran">Jam Pelajaran</label>
                    <input type="text"   class="form-control form-control-sm" name="jamPelajaran" id="jamPelajaran" value="<?=$data['jam_pelajaran'];?>">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>