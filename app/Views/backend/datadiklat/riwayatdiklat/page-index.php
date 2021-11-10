<div class='card'>
    <div class='card-header bg-transparent'>
        <a class="" href="<?=backend_url();?>/riwayat-diklat/add" role="button" data-toggle="tooltip" title="klik untuk menambah data baru" ><i class="mdi mdi-plus-circle"></i> Data Baru</a>
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
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="datatable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kategori</th>
                        <th>Nama Diklat</th>
                        <th>Penyelenggara</th>
                        <th>Tahun</th>
                        <th>Durasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($data as $row) : ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$row['DIKTEKFUNG'];?></td>
                        <td><?=$row['nm_dik'];?></td>
                        <td><?=$row['pnylgr_dik'];?></td>
                        <td><?=$row['th_agkt_dik'];?></td>
                        <td><?=$row['jml_jam_dik'];?> JP</td>
                        <td>
                            <div class="btn-group">
                                <?=btn_detail('riwayat-diklat/detail?id='.$row['k_u']);?>
                                <?=btn_edit('riwayat-diklat/edit?id='.$row['k_u']);?>
                                <?=btn_delete('riwayat-diklat/delete?id='.$row['k_u']);?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>