<div class='card'>
    <div class='card-header bg-transparent'>
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <a class="btnAdd" href="#" role="button" data-toggle="modal" data-target="#tambahModal"><i  data-toggle="tooltip" title="" data-original-title="klik untuk menambahkan data penerima PLT" class="mdi mdi-plus-circle"></i> Penerima</a>
                <p class="tx-12 tx-color-03 pt-1 pb-0 mb-1">Pembaharuan data nominatif penerima TPP sudah otomatis terintegrasi dari data kepegawaian</p>
            </div>
            <div class="col-sm-12 col-md-5 mg-t-15 mg-sm-t-0 pt-1">
                <div class="d-flex">
                    <select class="custom-select custom-select-sm tx-12 mr-2" id="unit_kerja">
                        <option selected="-" disabled>Pilihan Unit Kerja</option>
                        <?php foreach($skpd as $r_skpd) : ?>
                            <option value="<?=$r_skpd['SKPD_KD'];?>"><?=$r_skpd['SKPD'];?></option>
                        <?php endforeach; ?>
                        <option value="123">Badan Kepegawaian Pendidikan dan Pelatihan Daerah</option>
                    </select>
                    <!-- <input type="text" class="form-control form-control-sm tahun" value="<?=date('Y');?>" readonly> -->
                    <!-- <select class="custom-select custom-select-sm tx-12" id="unit_kerja">
                        <option selected="">Pilihan Periode Pengajuan</option>
                        <option value="<?=date('Y');?>-01-01">Januari <?=date('Y');?></option>
                        <option value="<?=date('Y');?>-02-01">Februari <?=date('Y');?></option>
                        <option value="<?=date('Y');?>-03-01">Maret <?=date('Y');?></option>
                        <option value="<?=date('Y');?>-04-01">April <?=date('Y');?></option>
                        <option value="<?=date('Y');?>-05-01">Mei <?=date('Y');?></option>
                        <option value="<?=date('Y');?>-06-01">Juni <?=date('Y');?></option>
                        <option value="<?=date('Y');?>-07-01">Juli <?=date('Y');?></option>
                        <option value="<?=date('Y');?>-08-01">Agustus <?=date('Y');?></option>
                        <option value="<?=date('Y');?>-09-01">September <?=date('Y');?></option>
                        <option value="<?=date('Y');?>-10-01">Oktober <?=date('Y');?></option>
                        <option value="<?=date('Y');?>-11-01">November <?=date('Y');?></option>
                        <option value="<?=date('Y');?>-12-01">Desember <?=date('Y');?></option>
                    </select> -->
                    <button class="btn btn-secondary btn-xs btn-icon pd-y-0 mg-l-5 flex-shrink-0" id="btnPreviewPenerimaTPP">
                        <i data-feather="search"></i> Tampilkan
                    </button>
                </div>
            </div>
            <div class="col-sm-12 col-md-2 mg-t-15 mg-sm-t-0 pt-1">
                <div class="search-form">
                    <input type="search" class="form-control form-control-sm" onkeyup="searching()" id="keyword" placeholder="Search">
                    <button class="btn btn-sm" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
                </div>
            </div>
        </div>
    </div>
    <div class='card-body'>
        <div class="table-responsive">
            <div id="target">
                <p>
                    Cara penggunaan fitur ini : 
                </p>
                <ul>
                    <li>Klik (+) Penerima, jika ingin menambahkan data penerima baru bersifat tambahan lainnya diluar TPP utamanya. Contoh kasus : PLT</li>
                    <li>Klik "Pilihan unit kerja" dan klik tombol "Tampilkan " untuk melihat data daftar penerima TPP pada SKPD tersebut</li>
                    <li>Entrikan nama pegawai pada kolom entrian "search" untuk mencari atau menyaring data pegawai tertentu</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Penambahan Penerima TPP</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="row_index">
            <div class="form-row">
                <div class="col form-group">
                    <label for="kodeSimpeg">NIP</label>
                    <div class="search-form">
                        <input type="search" class="form-control" id="keyword_nip" placeholder="Search">
                        <button class="btn" onclick="cariNIP()" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="nama">Nama</label>
                    <input type="text" required maxlength="255" readonly class="form-control form-control-sm" name="nama" id="nama">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="nama">Jabatan</label>
                    <input type="text" required maxlength="255" readonly class="form-control form-control-sm" name="jabatan" id="jabatan">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="nama">Tipe</label>
                    <input type="text" required maxlength="255" readonly class="form-control form-control-sm" name="tipe" id="tipe">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="col form-group">
                    <label for="nama">Pendidikan</label>
                    <input type="text" required maxlength="255" readonly class="form-control form-control-sm" name="pendidikan" id="pendidikan">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="nama">Jenis Penerimaan</label>
                    <select class="form-control form-control-sm" name="jenis" id="jenis">
                        <option value="primer" >Primer</option>
                        <option value="sekunder" title="Diberikan untuk yang bertugas ganda (PLT)">Sekunder</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="nama">Pilihan Kelas Jabatan dan Nominal Penerimaan</label>
                    <select class="form-control form-control-sm" name="kelas" id="kelas" onchange="getNominalFix()">
                        <option value="0" selected disabled>-- Pilihan --</option>
                        <?php foreach($kelas as $r_kelas) : ?>
                            <option value="<?=$r_kelas['id'];?>" data-kelas="<?=$r_kelas['kelas'];?>" data-nominal="<?=$r_kelas['nominal'];?>"  title="<?=$r_kelas['keterangan'];?>"><?=$r_kelas['kelas'];?> - Rp. <?=rp($r_kelas['nominal']);?>,- </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="nama">Prosentase Penerimaan</label>
                    <input type="number" required  class="form-control form-control-sm" name="prosentase" id="prosentase" value="100" min='0' max="100" onkeyup="getNominalFix()">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="col form-group">
                    <label for="nama">Jumlah Nominal Penerimaan</label>
                    <input type="text" required class="form-control form-control-sm" name="penerimaan" id="penerimaan" readonly>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="btnSubmit" data-dismiss="modal">Tambahkan</button>
        </div>
        </div>
    </div>
</div>  
<script>
    $( "#btnPreviewPenerimaTPP" ).click(function() {
        var unit_kerja  = $("#unit_kerja").val();
        var periode     = $("#periode").val();
        $("#target").html("<center><img src='<?=base_url();?>/public/assets/image/loader.gif'></center>");
        $.ajax(
        {
            "url" : "<?=backend_url();?>/nominatif-penerima/get-list",
            "type" : "POST",
            "data" : { 
                "csrf_app"      : $("input[name='csrf_app']").val(),
                "unit_kerja"    : unit_kerja,
                "periode"       : periode,
            },
            success: function(data, textStatus, xhr)
            {
                $("#target").html(data);
            },
            error: function(textStatus,xhr)
            {
                
            }
        });
    });

    function cariNIP()
    {
        var nip = $("#keyword_nip").val();
        alert(nip);
    }
</script>