<div class='card'>
    <div class='card-header bg-transparent'>
        <a>Informasi Detail Riwayat Diklat</a>
    </div>
    <div class='card-body'>
        <div class="form p-2">
            <label class="content-label content-label-lg mg-b-15 tx-color-01">KATEGORI PELATIHAN : <?=$data['DIKTEKFUNG'];?></label>
            <ul class="list-unstyled media-list-profile">
                <li class="media">
                    <div class="wd-40 ht-40 bg-gray-400"></div>
                    <div class="media-body">
                        <h6 class="mg-b-5 tx-semibold"><?=$data['nm_dik'];?></h6>
                        <p class="tx-color-03 tx-13">Diselenggarakan Oleh : <?=$data['pnylgr_dik'];?>
                        <br>Tempat Pelaksanaan : <?=$data['tmp_dik'];?></p>
                    </div>
                </li>
                <li class="media">
                    <div class="wd-40 ht-40 bg-gray-400"></div>
                    <div class="media-body">
                        <h6 class="mg-b-5 tx-semibold">Waktu Pelaksanaan</h6>
                        <p class="tx-color-03 tx-13"><?=tanggal_dMY($data['tgl_mul_dik']);?> - <?=tanggal_dMY($data['tgl_sls_dik']);?>
                        <br>Angkatan : <?=$data['agkt_dik']==''?'-':$data['agkt_dik'];?>
                        <br>Tahun : <?=$data['th_agkt_dik']==''?'-':$data['th_agkt_dik'];?></p>
                  </div>
                </li>
                <li class="media">
                    <div class="wd-40 ht-40 bg-gray-400"></div>
                    <div class="media-body">
                        <h6 class="mg-b-5 tx-semibold">STPP / Sertifikat Pelatihan</h6>
                        <p class="tx-color-03 tx-13">No. <?=$data['sttpp_dik_no'];?>
                        <br>Tanggal : <?=tanggal_dMY($data['sttpp_dik_tgl']);?>
                        <br>Tahun  : <?=$data['sttpp_dik_thn'];?></p>
                    </div>
                </li>
            </ul>
            <div class="form-group tx-13 tx-color-04">
                Jika ada data yang kurang lengkap atau kesalahan dalam pengentrian, Mohon dilakukan pembaharuan data dengan mengeditnya. Terima kasih
            </div>
        </div>
    </div>
</div>