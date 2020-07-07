<html>
<head>
<style type="text/css">
    .text_center{
        text-align: center;
    }

    .text_right{
        text-align: right;
    }

    .type_text1{
        font-size: 10pt;
        color: #000000;
        font-family:"Times New Roman", Times, serif;
    }

    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
        padding: 3px;
    }

</style>
</head>
<body>
    <div class="text_center type_text1">
        <B>
        HONORARIUM GURU GEMA TERPADU <BR>
        BULAN JANUARI 2020
        </B>
    </div>
    <br>
    <div>
        <table style="width: 100%;">
            <tr class="text_center type_text1" style="font-weight: bold;">
                <td style="width: 5%;">No</td>
                <td style="width: 30%;">Nama Guru</td>
                <td style="width: 15%;">Honor/Jam (Rp)</td>
                <td style="width: 20%;">Jumlah Jam X Hadir</td>
                <td style="width: 20%;">Pendapatan (Rp)</td>
            </tr>
            <?php
                $no = 1;
                foreach($mydata->result_array() as $row){
            ?>
            <tr class="type_text1">
                <td class="text_center"><?= $no; ?></td>
                <td><?= $row['GuruNama'] ?></td>
                <td class="text_right"><?= number_format($row['TARIF']) ?></td>
                <td class="text_right"><?= $row['totaljam'] ?></td>
                <td class="text_right"><?= number_format($row['totaljam']*$row['TARIF']) ?></td>
            </tr>
            <?php
                $no++;
                }
            ?>
        </table>
    </div>
</body>
</html>