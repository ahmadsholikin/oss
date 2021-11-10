<div class="table-responsive">
    <table class="table table-bordered table-hover" id="datatb">
        <thead>
            <tr class="bg-secondary text-white">
                <th style="width:2%">No.</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Gapok</th>
                <th>TJ. SUAMI/ISTRI</th>
                <th>TJ. ANAK</th>
                <th>TJ. Fung</th>
                <th>TJ. Esl</th>
                <th style="width:6%">Checklist</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no=1;
                foreach ($data as $row) : 
                    $JF = '0';
                    if((trim($row['KDFUNGSI'])==='00000')&&(trim($row['KDESELON'])==='00'))
                    {
                        $JF='175000';
                        $e = substr($row['KDPANGKAT'],0,1);
                        switch ($e)
                        {
                            case '1':
                                $JF='175000';
                                break;
                            case '2':
                                $JF='180000';
                                break;
                            case '3':
                                $JF='185000';
                                break;
                            default:

                                $JF='190000';
                            break;
                        }
                    }
                    else
                    {
                        $JF = $row['TJFUNGSI'];
                    }

                    $JE = $row['TJESELON'];

                    $JPSG = 0;
                    if($row['JISTRI']==1)
                    {
                        $JPSG = round($row['GAPOK']*0.1);
                    }

                    $JANAK = 0;
                    if($row['JANAK']<>0)
                    {
                        $JANAK = round($row['GAPOK']*0.02*$row['JANAK']);
                    }

                    $bg_gapok = "#FFF";
                    if($row['GAPOK']<>$row['GAJI']['GAPOK'])
                    {
                        $bg_psgn = "#fdb7d1";
                    }

                    $bg_psgn = "#FFF";
                    if($JPSG<>$row['GAJI']['TJISTRI'])
                    {
                        $bg_psgn = "#ffe7a2";
                    }

                    $bg_anak = "#FFF";
                    if($JANAK<>$row['GAJI']['TJANAK'])
                    {
                        $bg_anak = "#d7ffa2";
                    }

                    $bg_fungsional = "#FFF";
                    if($JF<>($row['GAJI']['TJUMUM']+$row['GAJI']['TJFUNGSI']))
                    {
                        $bg_fungsional = "#a2ffea";
                    }

                    $bg_eselon = "#FFF";
                    if($JE<>$row['GAJI']['TJESELON'])
                    {
                        $bg_eselon = "#e4d1f5";
                    }
            ?>
            <tr>
                <td><?=$no;?></td>
                <td><?=$row['NIP'];?></td>
                <td><?=$row['NAMA'];?></td>
                <td style="background-color: <?=$bg_gapok;?>;" class="text-right" title="Gaji pokok nominatif saat ini"><?=rp($row['GAPOK']);?></td>
                <td class="text-right" title="Tunjangan suami/istri nominatif saat ini" style="background-color: <?=$bg_psgn;?>;"><?=rp($JPSG);?></td>
                <td class="text-right" title="Tunjangan anak nominatif saat ini" style="background-color: <?=$bg_anak;?>;"><span class="text-left">(<?=$row['JANAK'];?>)</span>&nbsp;&nbsp;&nbsp;&nbsp; <?=rp($JANAK);?></td>
                <td class="text-right" title="Tunjangan fungsional nominatif saat ini" style="background-color: <?=$bg_fungsional;?>;"><?=rp($JF);?></td>
                <td class="text-right" title="Tunjangan eselon/struktural nominatif saat ini" style="background-color: <?=$bg_eselon;?>;"><?=rp($JE);?></td>
                <td rowspan="2">
                    <?php if($row['VALID']=='0'):?>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="valid<?=$no;?>" style="margin-top:0.1rem" value="1" onclick="checkitout(this,'<?=$row['NIP'];?>','<?=$pengajuan;?>','<?=$no;?>')">
                        <label class="form-check-label" for="valid<?=$no;?>">Valid &nbsp;<span class="spinner-border spinner-border-sm d-none" id="spin<?=$no;?>" role="status"></span></label>
                    </div>
                    <?php else : ?>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" checked id="valid<?=$no;?>" style="margin-top:0.1rem" value="0" onclick="checkitout(this,'<?=$row['NIP'];?>','<?=$pengajuan;?>','<?=$no;?>')">
                        <label class="form-check-label" for="valid<?=$no;?>">Valid &nbsp;<span class="spinner-border spinner-border-sm d-none" id="spin<?=$no;?>" role="status"></span></label>
                    </div>
                    <?php endif;?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" class="text-right">Penerimaan Periode Gaji : <?=$row['PERIODE'];?></td>
                <td style="background-color: <?=$bg_gapok;?>;"  class="text-right" title="Gaji pokok nominatif periode <?=$row['PERIODE'];?>" ><?=rp($row['GAJI']['GAPOK']);?></td>
                <td class="text-right" title="Tunjangan suami/istri nominatif periode <?=$row['PERIODE'];?>" style="background-color: <?=$bg_psgn;?>;"><?=rp($row['GAJI']['TJISTRI']);?></td>
                <td class="text-right" title="Tunjangan anak nominatif periode <?=$row['PERIODE'];?>" style="background-color: <?=$bg_anak;?>;"><span class="text-left">(<?=$row['GAJI']['JANAK'];?>)</span>&nbsp;&nbsp;&nbsp;&nbsp;<?=rp($row['GAJI']['TJANAK']);?></td>
                <td class="text-right" title="Tunjangan fungsional nominatif periode <?=$row['PERIODE'];?>" style="background-color: <?=$bg_fungsional;?>;"><?=rp($row['GAJI']['TJUMUM']+$row['GAJI']['TJFUNGSI']);?></td>
                <td class="text-right" title="Tunjangan eselon/struktural nominatif periode <?=$row['PERIODE'];?>" style="background-color: <?=$bg_eselon;?>;"><?=rp($row['GAJI']['TJESELON']);?></td>
            </tr>
            <tr>
                <td colspan="9" class="py-2" style="background:#ebebeb"></td>
            </tr>
            <?php $no++;endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    function checkitout(obj,id,periode,spin)
    {
        $("#spin"+spin).removeClass("d-none");
        $("#spin"+spin).addClass("d-print-inline");
        $.ajax(
        {
            "url" : "<?=backend_url();?>/penggajian/set-check-list",
            "type" : "POST",
            "data" : { 
                "csrf_app"  : $("input[name='csrf_app']").val(),
                "status"    : obj.value,
                "id"        : id,
                "periode"   : periode,
                "skpd"      : $("#skpd").val(),
            },
            success: function(data, textStatus, xhr)
            {
                if(obj.value==1)
                {
                    $("#"+obj.id).val(0);
                }
                else
                {
                    $("#"+obj.id).val(1);
                }
                $("#spin"+spin).addClass("d-none");
                $("#spin"+spin).removeClass("d-print-inline");
            },
            error: function(textStatus,xhr)
            {
                
            }
        });
    }
</script>