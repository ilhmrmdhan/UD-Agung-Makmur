<?php
include '../koneksi.php';

// Proses form sebelum ada output HTML


// Ambil data untuk tampilan form
if (isset($_GET['NO_TRANSAKSI']) && isset($_GET['NO_ITEM'])) {
    $nota_no = $_GET['NO_TRANSAKSI'];
    $no_barang = $_GET['NO_ITEM'];

    $query_nota = mysqli_query($conn, "SELECT * FROM pesanan join perusahaan on pesanan.ID_PT = perusahaan.ID_PT join supplier on pesanan.ID_SUPPLIER=supplier.ID_SUPPLIER WHERE pesanan.ID_PT = perusahaan.ID_PT AND pesanan.NO_TRANSAKSI = '$nota_no'");

    if ($query_nota) {
        $data_nota = mysqli_fetch_array($query_nota);
    } else {
        die("Error: " . mysqli_error($conn));
    }

    $query_barang = mysqli_query($conn, "SELECT B.NO_ITEM, B.Nama_Barang, B.Harga_Satuan, DB.Total, N.NO_TRANSAKSI, DB.Jumlah
                                              FROM pesanan N
                                              JOIN detail_pesanan DB ON N.NO_TRANSAKSI = DB.NO_TRANSAKSI
                                              JOIN item B ON DB.NO_ITEM = B.NO_ITEM
                                              WHERE N.NO_TRANSAKSI = '$nota_no' AND db.NO_ITEM = '$no_barang'");
                                     
                                         
    if ($query_barang) {
        $data = mysqli_fetch_array($query_barang);
    } else {
        die("Error: " . mysqli_error($conn));
    }
} else {
    die("Nota nomor atau nomor barang tidak disediakan.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard with Tailwind CSS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">

  <!-- jQuery dan DataTables -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  
</head>
<body class="flex h-screen bg-gray-200 font-sans">

  <?php include("../sidebar2.php"); ?>


 <!-- Tombol Buka Sidebar -->
<main class="flex-1 p-6 mx-4 mt-8 overflow-auto rounded-md bg-white">
  <div class="flex justify-between items-center mt-6">

    <!-- Kontainer Diperlebar -->
    <div class="w-full p-6 bg-white shadow-md rounded-lg">
      <h2 class="text-center text-xl font-bold mb-4">FORM DETAIL NOTA : <?php echo htmlspecialchars($data_nota['NO_TRANSAKSI']);?></h2>
      <hr class="mb-6">
      <form action="" method="post">
        <div class="space-y-4">
          <div class="flex items-center">
            <label class="w-32 font-medium">NO NOTA</label>
            <input name="nota_no" class="flex-1 px-3 py-2 border rounded bg-gray-100" value="<?php echo htmlspecialchars($data_nota['NO_TRANSAKSI']);?>" readonly>
          </div>
          <div class="flex items-center">
            <label class="w-32 font-medium">TANGGAL</label>
            <input type="date" name="tanggal" class="flex-1 px-3 py-2 border rounded bg-gray-100" value="<?php echo htmlspecialchars($data_nota['Tanggal']);?>" readonly>
          </div>
          <div class="flex items-center">
            <label class="w-32 font-medium">KM MOBIL</label>
            <input type="number" name="km_mobil" class="flex-1 px-3 py-2 border rounded bg-gray-100" value="<?php echo htmlspecialchars($data_nota['Total_Pembelian']);?>" readonly>
          </div>
          <div class="flex items-center">
            <label class="w-32 font-medium">NOPOL</label>
            <input type="text" name="nopol" class="flex-1 px-3 py-2 border rounded bg-gray-100" value="<?php echo htmlspecialchars($data_nota['Nama_PT']);?>" readonly>
          </div>
          <div class="flex items-center">
            <label class="w-32 font-medium">KASIR</label>
            <input type="text" name="kasir" class="flex-1 px-3 py-2 border rounded bg-gray-100" value="<?php echo htmlspecialchars($data_nota['Nama_Supplier']);?>" readonly>
          </div>
        </div>

        <h2 class="text-center text-xl font-bold mt-10 mb-4">UBAH DETAIL NOTA</h2>
        <hr class="mb-6">

        <div class="space-y-4">
        <div class="flex items-center">
            <label class="w-32 font-medium">BARANG</label>
            <input type="text" name="nama_barang" class="flex-1 px-3 py-2 border rounded bg-gray-100" value="<?php echo htmlspecialchars($data['NO_ITEM']);?>" readonly>
          </div>
          <div class="flex items-center">
            <label class="w-32 font-medium">BANYAKNYA</label>
            <input type="number" name="banyaknya" class="flex-1 px-3 py-2 border rounded" value="<?php echo htmlspecialchars($data['Jumlah']);?>" oninput="hitungTotal()">
          </div>
          <div class="flex items-center">
            <label class="w-32 font-medium">JUMLAH</label>
            <input type="number" name="jumlah" class="flex-1 px-3 py-2 border rounded bg-gray-100" value="<?php echo htmlspecialchars($data['Total']);?>" readonly>
          </div>
        </div>

        <div class="flex justify-end gap-4 mt-6">
          <button type="submit" name="proses" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Simpan Detail</button>
          <a href="notadetail.php?nota_no=<?php echo htmlspecialchars($data_nota['NO_TRANSAKSI']); ?>" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Kembali</a>
        </div>
      </form>
    </div>

  </div>
</main>
<script>
    function hitungTotal() {
        var banyaknya = document.querySelector("input[name='banyaknya']").value;
        var harga_satuan = <?php echo $data['Harga_Satuan']; ?>;
        var total = banyaknya * harga_satuan;
        document.querySelector("input[name='jumlah']").value = total;
    }
</script>


<?php 
if (isset($_POST['proses'])) {
    $nota_no = $_GET['NO_TRANSAKSI'];
    $no_barang = $_GET['NO_ITEM'];
    $banyaknya = $_POST['banyaknya'];
    $jumlah = $_POST['jumlah'];

    $query_total = "SELECT Total_Pembelian FROM pesanan WHERE NO_TRANSAKSI = '$nota_no'";
    $result_total = mysqli_query($conn, $query_total);

    if ($result_total) {
        $row_total = mysqli_fetch_assoc($result_total);
        $total_sebelumnya = $row_total['Total_Pembelian'];

        $queryUpdate = "UPDATE detail_pesanan SET Jumlah='$banyaknya', Total='$jumlah' WHERE NO_TRANSAKSI='$nota_no' AND NO_ITEM='$no_barang' LIMIT 1";
        $result_update = mysqli_query($conn, $queryUpdate);

        if ($result_update) {
            // Mengupdate nilai total
            $total = $total_sebelumnya + $jumlah;
            $query_update_total = "UPDATE pesanan SET Total_Pembelian='$total' WHERE NO_TRANSAKSI = '$nota_no'";
            $result_update_total = mysqli_query($conn, $query_update_total);

            if ($result_update_total) {
                // Redirect ke halaman lain setelah sukses
               echo "<script>
                        window.location.href = 'pesanandetail.php?NO_TRANSAKSI=$nota_no';
                    </script>";
               
            } else {
                echo "Error Update Total: " . mysqli_error($conn);
            }
        } else {
            echo "Error Update: " . mysqli_error($conn);
        }
    } else {
        echo "Error Total: " . mysqli_error($conn);
    }
}
?>