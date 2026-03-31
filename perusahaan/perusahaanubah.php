  
  
  
<aside id="<?= $sidebarId ?>" class="fixed top-0 right-0 h-full w-96 mt-36 rounded-xl transform translate-x-full bg-[#001f3f] text-white border flex flex-col transition-transform duration-300 z-50 overflow-y-auto">
  <div class="px-4 pt-4 flex justify-between items-center">
    <h2 class="text-lg font-semibold">Ubah Perusahaan</h2>
    <button class="close-sidebar-btn bg-[#001f3f] hover:bg-blue-800 p-2 rounded-md focus:outline-none" aria-label="Tutup sidebar">✕</button>
  </div>

  <form action="" method="POST" class="space-y-4 pb-6">
    <div class="px-6">
      <label class="block mb-1 font-medium">Id Perusahaan</label>
      <input type="text" name="ID_PT" value="<?= $data['ID_PT'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded" readonly>
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Nama Perusahaan</label>
      <input type="text" name="Nama_PT" value="<?= $data['Nama_PT'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded">
    </div>

    <div class="px-6">
      <label class="block mb-1 font-medium">Alamat Perusahaan</label>
      <input type="text" name="Alamat_PT" value="<?= $data['Alamat_PT'] ?>" class="w-full text-black border px-4 py-2 mb-4 rounded">
    </div>

    <div class="px-6 text-end pt-4">
      <button type="submit" name="submit_ubah" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
    </div>
  </form>
</aside>





 <!-- Tombol Buka Sidebar -->




<!-- Script harus di akhir -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Buka sidebar berdasarkan data-target
    document.querySelectorAll('.open-sidebar-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        const targetId = this.getAttribute('data-target');
        const sidebar = document.getElementById(targetId);
        sidebar.classList.remove('translate-x-full');
        sidebar.classList.add('translate-x-0');
      });
    });

    // Tutup semua sidebar
    document.querySelectorAll('.close-sidebar-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        this.closest('aside').classList.add('translate-x-full');
        this.closest('aside').classList.remove('translate-x-0');
      });
    });
  });
</script>


<?php

if (isset($_POST['submit_ubah'])) {
  include '../koneksi.php';
  $nopol = $_POST['ID_PT'];
  $nama = $_POST['Nama_PT'];
  $T_harga2 = $_POST['Alamat_PT'];


  $query = ("UPDATE perusahaan SET Nama_PT='$nama', Alamat_PT='$T_harga2' WHERE ID_PT='$nopol'");
  mysqli_query($conn, $query);
    echo "<script>window.location.href = 'Perusahaan.php';</script>";

}
?>