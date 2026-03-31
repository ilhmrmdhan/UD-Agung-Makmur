<?php
include '../koneksi.php';

if (isset($_POST['submit_ubah'])) {
  $T_id = $_POST['no_transaksi'];
  $T_supplier = $_POST['nama_supplier'];
  $T_perusahaan = $_POST['nama_perusahaan'];
  $T_kwitansi = $_POST['no_kwitansi'];
  $T_tanggal = $_POST['tanggal_transaksi'];
  $T_total_pembelian = $_POST['total_pembelian'];
  $T_ppn = $_POST['PPN'];
  $T_total_tagihan = $_POST['total_tagihan'];
  $T_status = $_POST['status_pembayaran'];
  $T_metode = $_POST['metode_pembayaran'];

  $query = "UPDATE pesanan SET 
    ID_SUPPLIER = '$T_supplier', 
    ID_PT = '$T_perusahaan',
    NO_Kwitansi_Transaksi = '$T_kwitansi',
    Tanggal = '$T_tanggal',
    Total_Pembelian = '$T_total_pembelian',
    PPN = '$T_ppn',
    Total_Tagihan = '$T_total_tagihan',
    Status_Pembayaran = '$T_status',
    Metode_Pembayaran = '$T_metode'
    WHERE NO_TRANSAKSI = '$T_id'";

  $result = mysqli_query($conn, $query);

  if ($result) {
    echo "<script>window.location.href = 'pesanan.php';</script>";
  } else {
    echo "Query gagal: " . mysqli_error($conn);
  }
}
?>

<aside id="<?= $sidebarId ?>" class="fixed top-0 right-0 h-screen w-96 rounded-xl transform translate-x-full bg-[#001f3f] text-white border transition-transform duration-300 z-50 overflow-y-auto">
  <div class="px-4 pt-4 flex justify-between items-center">
    <h2 class="text-lg font-semibold">Ubah Pesanan</h2>
    <button class="close-sidebar-btn bg-[#001f3f] hover:bg-blue-800 p-2 rounded-md focus:outline-none">&times;</button>
  </div>

  <form action="" method="POST" class="space-y-4 pb-6">
    <div class="px-6">
      <label class="block mb-1 font-medium">No Transaksi</label>
      <input type="text" name="no_transaksi" value="<?= $data['NO_TRANSAKSI'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded" readonly>
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Nama Supplier</label>
      <select name="nama_supplier" class="w-full text-black border px-4 py-2 rounded">
        <?php
        $ambilsupplier = mysqli_query($conn, "SELECT * FROM supplier");
        while ($supplier = mysqli_fetch_array($ambilsupplier)) {
          $selected = ($data['ID_SUPPLIER'] == $supplier['ID_SUPPLIER']) ? 'selected' : '';
          echo "<option value='{$supplier['ID_SUPPLIER']}' $selected>{$supplier['Nama_Supplier']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Nama Perusahaan</label>
      <select name="nama_perusahaan" class="w-full text-black border px-4 py-2 rounded">
        <?php
        $ambilperusahaan = mysqli_query($conn, "SELECT * FROM perusahaan");
        while ($perusahaan = mysqli_fetch_array($ambilperusahaan)) {
          $selected = ($data['ID_PT'] == $perusahaan['ID_PT']) ? 'selected' : '';
          echo "<option value='{$perusahaan['ID_PT']}' $selected>{$perusahaan['Nama_PT']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">No Kwitansi</label>
      <input type="number" name="no_kwitansi" value="<?= $data['No_Kwitansi_Transaksi'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded">
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Tanggal Transaksi</label>
      <input type="date" name="tanggal_transaksi" value="<?= $data['Tanggal'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded">
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Total Pembelian</label>
      <input type="number" name="total_pembelian" value="<?= $data['Total_Pembelian'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded" readonly>
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">PPN</label>
      <input type="text" name="PPN" value="<?= $data['PPN'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded">
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Total Tagihan</label>
      <input type="number" name="total_tagihan" value="<?= $data['Total_Tagihan'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded"readonly >
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Status Pembayaran</label>
      <select name="status_pembayaran" class="w-full text-black border px-4 py-2 rounded">
        <option value="" <?= $data['Status_Pembayaran'] == '' ? 'selected' : '' ?>>--Pilih--</option>
        <option value="Sudah" <?= $data['Status_Pembayaran'] == 'Sudah' ? 'selected' : '' ?>>Sudah</option>
        <option value="Belum" <?= $data['Status_Pembayaran'] == 'Belum' ? 'selected' : '' ?>>Belum</option>
      </select>
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Metode Pembayaran</label>
      <select name="metode_pembayaran" class="w-full text-black border px-4 py-2 rounded">
        <option value="" <?= $data['Metode_Pembayaran'] == '' ? 'selected' : '' ?>>--Pilih--</option>
        <option value="Cash" <?= $data['Metode_Pembayaran'] == 'Cash' ? 'selected' : '' ?>>Cash</option>
        <option value="Qris" <?= $data['Metode_Pembayaran'] == 'Qris' ? 'selected' : '' ?>>Qris</option>
      </select>
    </div>

    <div class="px-6 text-end pt-4">
      <button type="submit" name="submit_ubah" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
    </div>
  </form>
</aside>

<script>
function lockBodyScroll() {
  document.body.style.overflow = 'hidden';
}
function unlockBodyScroll() {
  document.body.style.overflow = '';
}

document.querySelectorAll('.open-sidebar-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    const targetId = this.getAttribute('data-target');
    const sidebar = document.getElementById(targetId);
    sidebar.classList.remove('translate-x-full');
    sidebar.classList.add('translate-x-0');
    lockBodyScroll();
  });
});

document.querySelectorAll('.close-sidebar-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    this.closest('aside').classList.add('translate-x-full');
    this.closest('aside').classList.remove('translate-x-0');
    unlockBodyScroll();
  });
});
</script>
