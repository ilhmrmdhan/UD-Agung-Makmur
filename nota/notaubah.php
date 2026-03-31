  
  
  
<aside id="<?= $sidebarId ?>" class="fixed top-0 right-0 h-screen w-96  rounded-xl transform translate-x-full bg-[#001f3f] text-white border transition-transform duration-300 z-50 overflow-y-auto">
  <div class="px-4 pt-4 flex justify-between items-center">
    <h2 class="text-lg font-semibold">Ubah Nota</h2>
    <button class="close-sidebar-btn bg-[#001f3f] hover:bg-blue-800 p-2 rounded-md focus:outline-none" aria-label="Tutup sidebar">✕</button>
  </div>

  <form action="" method="POST" class="space-y-4 pb-6">
    <div class="px-6">
      <label class="block mb-1 font-medium">No Pesanan</label>
      <input type="text" name="nopes" value="<?= $data['NO_PESANAN'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded" readonly>
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Nama Pegawai</label>
      <select name="idpegawai" class="w-full text-black border px-4 py-2 rounded">
        <?php
        include '../koneksi.php';
        $ambilpelanggan = mysqli_query($conn, "SELECT * FROM pegawai");
        while ($pelanggan = mysqli_fetch_array($ambilpelanggan)) {
            $selected = ($data['ID_PEGAWAI'] == $pelanggan['ID_PEGAWAI']) ? 'selected' : '';
            echo "<option value='{$pelanggan['ID_PEGAWAI']}' $selected>{$pelanggan['Nama_Pegawai']}</option>";
        }
        ?>
      </select>
  </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Nama customer</label>
      <select name="idcustomer" class="w-full text-black border px-4 py-2 rounded">
        <?php
        include '../koneksi.php';
        $ambilpelanggan = mysqli_query($conn, "SELECT * FROM customer");
        while ($pelanggan = mysqli_fetch_array($ambilpelanggan)) {
            $selected = ($data['ID_CUSTOMER'] == $pelanggan['ID_CUSTOMER']) ? 'selected' : '';
            echo "<option value='{$pelanggan['ID_CUSTOMER']}' $selected>{$pelanggan['Nama_Customer']}</option>";
        }
        ?>
      </select>
  </div>
   

    <div class="px-6">
      <label class="block mb-1 font-medium">Tanggal Transaksi</label>
      <input type="date" name="jabatan" value="<?= $data['Tanggal_Transaksi'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded">
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Total</label>
      <input type="number" name="noHp" value="<?= $data['Total'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded">
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Uang Muka</label>
      <input type="number" name="noHp1" value="<?= $data['Uang_Muka'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded">
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Sisa</label>
      <input type="number" name="noHp2" value="<?= $data['Sisa'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded">
    </div>

    <div class="px-6 text-end pt-4">
      <button type="submit" name="submit_ubah" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
    </div>
  </form>
</aside>





 <!-- Tombol Buka Sidebar -->




<!-- Script harus di akhir -->
<script>
 // Lock scroll saat sidebar terbuka
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


<?php

if (isset($_POST['submit_ubah'])) {
  include '../koneksi.php';
    $T_id = $_POST['nopes'];
    $T_harga = $_POST['idpegawai'];
    $T_package = $_POST['idcustomer'];
    $T_package1 = $_POST['jabatan'];
    $T_harga1 = $_POST['noHp'];
    $T_harga2 = $_POST['noHp1'];
    $T_harga3 = $_POST['noHp2'];
  $query = ("UPDATE nota SET ID_PEGAWAI='$T_harga', ID_CUSTOMER='$T_package',Tanggal_Transaksi='$T_package1',Total='$T_harga1',Uang_Muka='$T_harga2',Sisa='$T_harga3' WHERE NO_PESANAN='$T_id'");
  mysqli_query($conn, $query);
    echo "<script>window.location.href = 'nota.php';</script>";

}
?>