
<?php include '../koneksi.php';

if (isset($_GET['NO_PESANAN'])) {
    $nota_no = $_GET['NO_PESANAN'];
    $query = mysqli_query($conn, "SELECT * FROM nota join customer on nota.ID_CUSTOMER = customer.ID_CUSTOMER join pegawai on nota.ID_PEGAWAI=pegawai.ID_PEGAWAI WHERE nota.ID_CUSTOMER = customer.ID_CUSTOMER AND nota.NO_PESANAN = '$nota_no'");
    $data = mysqli_fetch_array($query);
} else {
    die("Nota nomor tidak disediakan.");
}?>
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

  <!-- Konten Utama -->
  <main class="flex-1 p-6 mx-4 mt-8 overflow-auto bg-white rounded-md shadow-inner">
    <div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
      <h2 class="text-center text-xl font-bold mb-4">FORM DETAIL NOTA : <?php echo htmlspecialchars($data['NO_PESANAN']);?></h2>
      <hr class="mb-6">
      
      <form action="" method="post">
        <!-- Bagian Atas -->
        <div class="space-y-4">
          <div class="flex items-center">
            <label class="w-32 font-medium">NO NOTA</label>
            <input name="nota_no" class="flex-1 px-3 py-2 border rounded bg-gray-100" value="<?php echo htmlspecialchars($data['NO_PESANAN']);?>" readonly>
          </div>
          <div class="flex items-center">
            <label class="w-32 font-medium">TANGGAL</label>
            <input type="date" name="tanggal" class="flex-1 px-3 py-2 border rounded bg-gray-100" value="<?php echo htmlspecialchars($data['Tanggal_Transaksi']);?>" readonly>
          </div>
          <div class="flex items-center">
            <label class="w-32 font-medium">KM MOBIL</label>
            <input type="number" name="km_mobil" class="flex-1 px-3 py-2 border rounded bg-gray-100" value="<?php echo htmlspecialchars($data['Total']);?>" readonly>
          </div>
          <div class="flex items-center">
            <label class="w-32 font-medium">NOPOL</label>
            <input type="text" name="nopol" class="flex-1 px-3 py-2 border rounded bg-gray-100" value="<?php echo htmlspecialchars($data['Nama_Customer']);?>" readonly>
          </div>
          <div class="flex items-center">
            <label class="w-32 font-medium">KASIR</label>
            <input type="text" name="kasir" class="flex-1 px-3 py-2 border rounded bg-gray-100" value="<?php echo htmlspecialchars($data['Nama_Pegawai']);?>" readonly>
          </div>
        </div>

        <!-- Detail Nota -->
        <h2 class="text-center text-xl font-bold mt-10 mb-4">TAMBAH DETAIL NOTA</h2>
        <hr class="mb-6">

        <div class="space-y-4">
          <div class="flex items-center">
            <label for="exampleDataList" class="w-32 font-medium">BARANG</label>
            <select class="flex-1 px-3 py-2 border rounded" name="no_barang">
              <option selected disabled>---Pilih----</option>
              <?php
              $query = mysqli_query($conn, "SELECT * FROM item");
              while ($data_barang = mysqli_fetch_array($query)) {
                echo "<option value='".htmlspecialchars($data_barang['NO_ITEM'])."' data-harga='".htmlspecialchars($data_barang['Harga_Satuan'])."'>".htmlspecialchars($data_barang['NO_ITEM'])." - ".htmlspecialchars($data_barang['Nama_Barang'])." - ".htmlspecialchars($data_barang['Harga_Satuan'])."</option>";
              }
              ?>
            </select>
          </div>
          <div class="flex items-center">
            <label class="w-32 font-medium">BANYAKNYA</label>
            <input type="number" name="banyaknya" class="flex-1 px-3 py-2 border rounded" placeholder="Banyaknya">
          </div>
          <div class="flex items-center">
            <label class="w-32 font-medium">JUMLAH</label>
            <input type="number" name="jumlah" class="flex-1 px-3 py-2 border rounded bg-gray-100" readonly>
          </div>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end gap-4 mt-6">
          <button type="submit" name="proses" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Simpan Detail</button>
          <a href="notadetail.php?NO_PESANAN=<?php echo htmlspecialchars($data['NO_PESANAN']); ?>" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Kembali</a>
        </div>
      </form>
    </div>
  </main>
</body>
  <script>
$(document).ready(function() {
    $('select[name="no_barang"], input[name="banyaknya"]').on('change keyup', function() {
        var harga = $('select[name="no_barang"] option:selected').data('harga') || 0;
        var qty = $('input[name="banyaknya"]').val() || 0;
        var jumlah = harga * qty;
        $('input[name="jumlah"]').val(jumlah);
    });
});
</script>
<?php 
if (isset($_POST['proses'])) {
    $nota_no = $_POST['nota_no'];
    $no_barang = $_POST['no_barang'];
    $banyaknya = $_POST['banyaknya'];
   $jumlah = (int)$_POST['jumlah']; 

    $query_total = "SELECT Total FROM nota WHERE NO_PESANAN = '$nota_no'";
    $result_total = mysqli_query($conn, $query_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_sebelumnya = (int)$row_total['Total'];

    $query_insert = "INSERT INTO detail_nota VALUES('$nota_no','$no_barang','$banyaknya','$jumlah')";
    $result_insert = mysqli_query($conn, $query_insert);

    if ($result_insert) {
        // Mengupdate nilai total
        $total = $total_sebelumnya + $jumlah;
        $query_update_total = "UPDATE nota SET Total='$total' WHERE NO_PESANAN = '$nota_no'";
        $result_update_total = mysqli_query($conn, $query_update_total);
        
        // Redirect ke halaman lain setelah sukses
         echo "<script>
        window.location.href = 'notadetail.php?NO_PESANAN=$nota_no';
      </script>";

    }
      // atau (float) jika bisa desimal
              // atau (float)

}

// Ambil data untuk tampilan form



?>