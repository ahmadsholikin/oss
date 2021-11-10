<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover" id="datatb">
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">NIP</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">Jabatan</th>
                <th rowspan="2">Unit Kerja</th>
                <th colspan="3" class="text-center">KGB Lama</th>
                <th colspan="3" class="text-center">KGB Baru</th>
            </tr>
            <tr>
                <th>Gaji</th>
                <th>Masker</th>
                <th>TMT</th>
                <th>Gaji</th>
                <th>Masker</th>
                <th>TMT</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1;foreach ($data as $row) : ?>
            <tr>
                <td><?=$no++;?></td>
                <td><?=$row['nip'];?></td>
                <td><?=$row['sinkron'];?>&nbsp;<?=$row['nama'];?></td>
                <td><?=$row['jabatan'];?></td>
                <td><?=$row['unitkerja'];?></td>
                <td  class="text-right"><?=$row['lm_gaji'];?></td>
                <td><?=$row['lm_mk'];?> th</td>
                <td><?=$row['lm_tmt'];?></td>
                <td class="text-right"><?=$row['br_gaji_nominal'];?></td>
                <td><?=$row['br_mk'];?> th</td>
                <td><?=$row['br_tmt_format'];?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>