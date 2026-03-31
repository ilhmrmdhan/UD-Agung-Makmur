<!DOCTYPE html>
<style>
    h1,
    h2 {
        text-align: center;
    }

    .transaction-details {
        margin-bottom: 20px;
    }

    .medicine-list table {
        width: 100%;
        border-collapse: collapse;
    }

    .medicine-list th,
    .medicine-list td {
        padding: 1px;
        border: 1px solid #ccc;
        text-align: center;
    }
    .total-amount td {
        border: none !important; /* Hapus border pada td jumlah */
        padding: 2px;
        text-align: right;
    }

       

    .total-amount {
        text-align: right;
        margin-top: 20px;
    }

    .ttd1 {
        display: flex;
        align-items: center;
    }

    p {
        margin: 0;
    }

    strong {
        font-weight: bold;
    }

    .kanan {
        margin-left: auto;
    }

    .kanann {
        margin-left: 150px;
    }

    .kanan2 {
        margin-left: 80px;
    }
</style>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CETAK PESANAN</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f1f1f1;">
    <div
        style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #fff; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <?php
        include '../koneksi.php';
        $query = mysqli_query($conn, "SELECT * from pesanan join perusahaan on pesanan.ID_PT = perusahaan.ID_PT join supplier on pesanan.ID_SUPPLIER=supplier.ID_SUPPLIER where NO_TRANSAKSI= '$_GET[NO_TRANSAKSI]'");
        $data1 = mysqli_fetch_array($query);
        // Mengubah format tanggal ke dd/mm/yyyy
        $tanggal = date('d/m/Y', strtotime($data1['Tanggal']));
        ?>
        <div style=" display: flex; align-items: center;">
            <div>
                <p style="text-align: center; font-size: 0.7rem; width: 310px;">
                    <img src="../asset/Logo2.jpg" alt="" style="width: 300px; height: auto;"><br>
                </p>
            </div>
            <div class="text-xl font-bold">
                <h1>Struk Pembelian Barang Furnitur</h1>
            </div>
        </div>
        <div class="border border-black-2 p-2 mb-2">
            <ul style="list-style: none; padding-left: 0; margin: 2px;">
                <li>NO PESANAN:&nbsp;&nbsp;&nbsp;<?php echo $data1['NO_TRANSAKSI']; ?></li>
                <li>Vendor:&nbsp;&nbsp;&nbsp;<?php echo $data1['Nama_Supplier']; ?></li>
                <li>Alamat:&nbsp;&nbsp;&nbsp;<?php echo $data1['Alamat']; ?></li>
            </ul>
        </div>


        <div class="p-2">
            <ul>
                <li>Pembeli:&nbsp;&nbsp;&nbsp;<?php echo $data1['NO_TRANSAKSI']; ?></li>
                <li>No Hp:&nbsp;&nbsp;&nbsp;<?php echo $data1['Nama_PT']; ?></li>
                <li>Alamat:&nbsp;&nbsp;&nbsp;<?php echo $data1['Alamat_PT']; ?></li>
            </ul>
        </div>

        <div class="medicine-list">
            <table>
                <thead>
                    <tr>
                        <th>Banyaknya</th>
                        <th>Nama Barang</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';
                    $index = 1;
                    $nota_no = $_GET['NO_TRANSAKSI'];
                    $query_barang = mysqli_query($conn, "SELECT B.NO_ITEM, B.Nama_Barang, B.Harga_Satuan, DB.Jumlah, DB.Total, N.NO_TRANSAKSI, N.PPN, DB.Jumlah
                                         FROM pesanan N
                                         JOIN detail_pesanan DB ON N.NO_TRANSAKSI = DB.NO_TRANSAKSI
                                         JOIN item B ON DB.NO_ITEM = B.NO_ITEM
                                         WHERE N.NO_TRANSAKSI = '$nota_no'");
                    $jumlah_rp = 0;
                    $rowCount = 0;

                    while ($data = mysqli_fetch_array($query_barang)) {
                        $jumlah = $data['Harga_Satuan'] * $data['Jumlah'];
                        $jumlah_rp += $jumlah;
                        $rowCount++;
                    ?>
    <tr>
        <td><?php echo $data['Jumlah']; ?></td>
        <td style="text-align: start;"><?php echo $data['Nama_Barang']; ?></td>
        <td><?php echo number_format($data['Harga_Satuan'], 0, ',', '.'); ?></td>
        <td><?php echo number_format($data['Total'], 0, ',', '.'); ?></td>
    </tr>
<?php }

    for ($i = $rowCount; $i < 11; $i++) {
        echo "<tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>";
    }

    // Ambil PPN dari query utama
    $ppn =  $data1['PPN'] ;
    $total_tagihan = $jumlah_rp * $ppn/100;
?>
                </tbody>
                <tfoot>
                    <tr class="total-amount">
                        <td colspan="3"><strong>Total Pembelian Rp</strong></td>
                        <td><?php echo number_format($jumlah_rp, 0, ',', '.'); ?></td>
                    </tr>
                    <tr class="total-amount">
                        <td colspan="3"><strong>PPN</strong></td>
                        <td><?php echo number_format($ppn, 0, ',', '.'); ?></td>
                    </tr>
                    <tr class="total-amount">
                        <td colspan="3"><strong>Total Tagihan</strong></td>
                        <td><?php echo number_format($total_tagihan, 0, ',', '.'); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div style="display: flex; justify-content: space-between; margin-top: 40px;">
            <div style="text-align: center;">
                <strong>Vendor</strong><br>
                <img src="../images/ttds.png" alt="" style="width: 90px; height: auto;"><br>
                <strong>HERU</strong>
            </div>
            <div style="text-align: center;">
                <strong>Pembeli</strong><br>
                <img src="../images/ttds.png" alt="" style="width: 90px; height: auto;"><br>
                <strong>TAMA</strong>
            </div>
        </div>
        <div style="position: absolute; top: 50px; left: 50%; transform: translate(-50%, -50%) rotate(-15deg); opacity: 0.4;">
            <img src="../images/stempel.png" alt="" style="width: 90px; height: auto;">
        </div>
    </div>
    <script>
        window.onload = function () {
            window.print();
        }
    </script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>