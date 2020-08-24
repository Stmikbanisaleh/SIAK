<html>
    <head>
        <style>
            .header{
                width : 100%;
                font-family:Rockwell;
            }
            .content{
                width :100%;
                font-family:Rockwell;
            }
            .widht1{
                width : 25px;
            }
            .widht2{
                width : 50px;
            }
            .widht3{
                width : 75px;
            }
            .widht4{
                width : 125px;
            }
            .widht5{
                width : 270px;
            }
            .aligntextcenter{
                text-align : center;
            }
            .aligntextright{
                text-align : right;
            }
            .fontsize12{
                font-size : 14px;
            }
            .tablecolapse{
                /* border-collapse: collapse;
                border: 1px solid black; */
                margin-top : 20px;
            }
            .tablecolapse .str{
                border-bottom: 1px solid #ddd;
                padding: 0px;
                height: 50px;
            }
            .tablecolapse .str .std{
                border-bottom: 1px solid #ddd;
                padding: 0px;
                height: 30px;
            }
        </style>
    </head>
    <body>
        <div class="headers">
            <center><font size="4"><b>SEKOLAH ISLAM TERPADU GEMA NURANI</b><font></center>
            <center><font size="2">Jl. Raya Kaliabang Tengah No.75B, RT.003/RW.006, Kaliabang Tengah,<font></center>
            <center><font size="2">Kec. Bekasi Utara, Kota Bks, Jawa Barat 17125<font></center>
            
        </div>
        <div class="content">
            <hr>
            <center><font size="3"><b>BUKTI PEMBAYARAN SISWA</b><font></center>
            <hr>
            <br>
            <table class="fontsize12">
                <tr>
                    <td class="widht4">Nama</td>
                    <td style="width : 330px;">: <?php echo $nama;?></td>
                    <td class="widht4">Tanggal</td>
                    <td>: <?php echo date("Y-m-d") ?></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>: <?php echo $kelas; ?></td>
                    <td>Jam Cetak</td>
                    <td>: <?php echo date("H:i:s"); ?></td>
                </tr>
                <tr>
                    <td>Sekolah</td>
                    <td>: <?php echo $sekolah; ?></td>
                    <td>Tahun Akademik</td>
                    <td>: <?php echo $ta; ?></td>
                </tr>
            </table>
            <br>
            <hr>
            <table class="fontsize12" >
                <tr class="str">
                    <td class="widht1 aligntextcenter std">No</td>
                    <td class="widht5 aligntextcenter std">Jenis Tagihan</td>
                    <td class="widht4 aligntextcenter std">Nominal</td>
                    <td class="widht4 aligntextcenter std">Dibayar</td>
                    <td class="widht4 aligntextcenter std">Belum Dibayar</td>
                </tr>
            </table>
            <hr>
            <table class="fontsize12" >
                <hr>
                <?php
                    $no = 1;
                    $jml_nominal = 0;
                    $jml_bayar = 0;
                    $jml_total = 0;
                    foreach($myrincian as $row){
                ?>
                <tr class="str">
                    <td class="widht1 aligntextcenter std"><?php echo $no; ?></td>
                    <td class="widht5 std"><?php echo $row['namajenisbayar']; ?></td>
                    <td class="widht4 aligntextright std"><?php echo 'Rp. '.number_format($row['Nominal']) ?></td>
                    <td class="widht4 aligntextright std"><?php echo 'Rp. '.number_format($row['jumlah_bayar']) ?></td>
                    <td class="widht4 aligntextright std"><?php echo 'Rp. '.number_format($row['total']) ?></td>
                </tr>
                <?php
                    $jml_nominal = $jml_nominal+$row['Nominal'];
                    $jml_bayar = $jml_bayar+$row['jumlah_bayar'];;
                    $jml_total = $jml_total+$row['total'];;
                    $no++;
                    }
                ?>
            </table>
            <table class="fontsize12" >
                <tr class="str">
                    <td class="widht1 aligntextcenter std"> </td>
                    <td class="widht5 std">Jumlah</td>
                    <td class="widht4 aligntextright std"><?php echo 'Rp. '.number_format($jml_nominal) ?></td>
                    <td class="widht4 aligntextright std"><?php echo 'Rp. '.number_format($jml_bayar) ?></td>
                    <td class="widht4 aligntextright std"><?php echo 'Rp. '.number_format($jml_total) ?></td>
                </tr>
            </table>
            <hr>
            <br><br>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <th align="center" width="30%" scope="col" style="padding-left : 300px;"><span style="font-family:Rockwell;font-size: 12px;">Bekasi, <?php echo $tgl; ?></th>
                </tr>
                <tr>
                    <th align="center" width="30%" scope="col" style="padding-left : 300px;"><span style="font-family:Rockwell;font-size: 12px;">Ka. Biro Keuangan,</th>
                </tr>
                <tr>
                    <th align="center" width="30%" scope="col" style="padding-left : 300px; height : 150px;"><span style="font-family:Rockwell;font-size: 12px;">(.......................................................)</th>
                </tr>
            </table>
        </div>
    </body>
</html>