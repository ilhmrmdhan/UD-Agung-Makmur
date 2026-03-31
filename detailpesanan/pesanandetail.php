
<?php
include '../koneksi.php';

// Periksa apakah 'nota_no' ada di URL
if (isset($_GET['NO_TRANSAKSI'])) {
    $nota_no = $_GET['NO_TRANSAKSI'];
    $query = mysqli_query($conn, "SELECT * FROM pesanan join perusahaan on pesanan.ID_PT = perusahaan.ID_PT join supplier on pesanan.ID_SUPPLIER=supplier.ID_SUPPLIER WHERE pesanan.ID_PT = perusahaan.ID_PT AND pesanan.NO_TRANSAKSI = '$nota_no'");
    $data = mysqli_fetch_array($query);
    // Mengubah format tanggal ke dd/mm/yyyy
    $tanggal = date('d/m/Y', strtotime($data['Tanggal']));

    // Periksa apakah query SQL berhasil mengambil data
    if ($data) {
        // Lanjutkan dengan proses normal jika data ada
    } else {
        // Tangani kasus di mana data tidak ditemukan
        die("Nota tidak ditemukan.");
    }
} else {
    // Tangani kasus di mana 'nota_no' tidak ada di URL
    die("Nota nomor tidak disediakan.");
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
<main class="flex-1 p-6 mx-20 mt-8 overflow-auto rounded-md bg-white">
 

<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-center text-xl font-bold mb-4">DETAIL NOTA: <?php echo htmlspecialchars($data['NO_TRANSAKSI']); ?></h2>
    <hr class="mb-4">
    <a class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm" href="../pesanan/pesanan.php">Kembali</a>

    <div class="space-y-4 mt-4">
        <div class="flex items-center">
            <label class="w-32 font-medium">NO NOTA</label>
            <input class="flex-1 border rounded px-3 py-2 bg-gray-100" value="<?php echo htmlspecialchars($data['NO_TRANSAKSI']); ?>" readonly>
        </div>

        <div class="flex items-center">
            <label class="w-32 font-medium">TANGGAL</label>
            <input class="flex-1 border rounded px-3 py-2 bg-gray-100" value="<?php echo $tanggal; ?>" readonly>
        </div>

        <div class="flex items-center">
            <label class="w-32 font-medium">Total</label>
            <input class="flex-1 border rounded px-3 py-2 bg-gray-100" value="<?php echo htmlspecialchars($data['Total_Pembelian']); ?>" readonly>
        </div>

        <div class="flex items-center">
            <label class="w-32 font-medium">Nama Customer</label>
            <input class="flex-1 border rounded px-3 py-2 bg-gray-100" value="<?php echo htmlspecialchars($data['Nama_PT']); ?>" readonly>
        </div>

        <div class="flex items-center">
            <label class="w-32 font-medium">KASIR</label>
            <input class="flex-1 border rounded px-3 py-2 bg-gray-100" value="<?php echo htmlspecialchars($data['Nama_Supplier']); ?>" readonly>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-center text-xl font-bold mb-4">TABEL DETAIL NOTA</h2>
    <hr class="mb-4">
    <div class="flex gap-4 mb-4">
        <a href="pesanandetail-tambah.php?NO_TRANSAKSI=<?php echo htmlspecialchars($data['NO_TRANSAKSI']); ?>" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Tambah</a>
        <a href="pesanancetak.php?NO_TRANSAKSI=<?php echo htmlspecialchars($data['NO_TRANSAKSI']); ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Cetak</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-300 text-center text-sm">
            <thead class="bg-blue-100 text-black">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Banyaknya</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Barang</th>
                    <th class="border border-gray-300 px-4 py-2">Harga Satuan</th>
                    <th class="border border-gray-300 px-4 py-2">Jumlah</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../koneksi.php';

                $index = 1;
                $query = mysqli_query($conn, "SELECT B.NO_ITEM, B.Nama_Barang, B.Harga_Satuan, DB.Total, N.NO_TRANSAKSI, DB.Jumlah
                                              FROM pesanan N
                                              JOIN detail_pesanan DB ON N.NO_TRANSAKSI = DB.NO_TRANSAKSI
                                              JOIN item B ON DB.NO_ITEM = B.NO_ITEM
                                              WHERE N.NO_TRANSAKSI = '$nota_no'");

                $jumlah_rp = 0;

                while ($data_barang = mysqli_fetch_array($query)) {
                    $jumlah = $data_barang['Harga_Satuan'] * $data_barang['Jumlah'];
                    $jumlah_rp += $jumlah;

                    $updateFakturQuery = "UPDATE pesanan SET Total_Pembelian = '$jumlah_rp' WHERE NO_TRANSAKSI = '$nota_no'";
                    mysqli_query($conn, $updateFakturQuery);
                ?>
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($index++); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($data_barang['Jumlah']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($data_barang['Nama_Barang']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($data_barang['Harga_Satuan']); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($jumlah); ?></td>
                        <td class="border border-gray-300 px-4 py-2 space-x-2">
                            <a href="pesanandetail-ubah.php?NO_TRANSAKSI=<?php echo htmlspecialchars($data_barang['NO_TRANSAKSI']); ?>&NO_ITEM=<?php echo htmlspecialchars($data_barang['NO_ITEM']); ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-sm">Ubah</a>
                            <a href="pesanandetail-hapus.php?NO_TRANSAKSI=<?php echo htmlspecialchars($data_barang['NO_TRANSAKSI']); ?>&NO_ITEM=<?php echo htmlspecialchars($data_barang['NO_ITEM']); ?>" onclick="return confirm('Yakin hapus?')" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-sm">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
                <tr class="bg-gray-100 font-bold">
                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-center">TOTAL HARGA</td>
                    <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($jumlah_rp); ?></td>
                    <td class="border border-gray-300 px-4 py-2"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

