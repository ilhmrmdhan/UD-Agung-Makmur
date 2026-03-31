  
  
  
<aside id="sidebar1" class="fixed top-0 right-0 h-full w-96 mt-36 rounded-xl transform translate-x-full bg-[#001f3f] text-white border flex flex-col transition-transform duration-300 z-50 overflow-y-auto">
  <div class="px-4 pt-4 flex justify-between items-center">
    <h2 class="text-lg font-semibold">Tambah Pegawai</h2>
    <button id="toggle-btn1" class="bg-[#001f3f] hover:bg-blue-800 p-2 rounded-md focus:outline-none" aria-label="Tutup sidebar">✕</button>
  </div>

<form id="pegawaiForm" method="POST" action="" class="p-6 space-y-4">
  <input type="hidden" id="formMode" value="add">
  <input type="hidden" id="editRowIndex">

  <div>
    <label class="block mb-1 font-medium">ID Pegawai</label>
    <input type="text" name="ID_PEGAWAI" id="ID_PEGAWAI" class="w-full text-black border px-4 py-2 rounded">
  </div>
  <div>
    <label class="block mb-1 font-medium">Nama Pegawai</label>
    <input type="text" name="nama" id="nama" class="w-full text-black border px-4 py-2 rounded">
  </div>
  <div>
    <label class="block mb-1 font-medium">jabatan</label>
    <input type="text" name="jabatan" id="noHp" class="w-full text-black border px-4 py-2 rounded">
  </div>
    <div>
    <label class="block mb-1 font-medium">No HP</label>
    <input type="number" name="noHp" id="noHp" class="w-full text-black border px-4 py-2 rounded">
  </div>

  <div class="text-end pt-4">
    <button type="submit" name="submit_tambah" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
  </div>
</form>
</aside>



 <!-- Tombol Buka Sidebar -->




<!-- Script harus di akhir -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const sidebar1 = document.getElementById('sidebar1');
    const openBtn1 = document.getElementById('open-sidebar-btn');
    const closeBtn1 = document.getElementById('toggle-btn1');

    // Buka sidebar
    openBtn1.addEventListener('click', () => {
      sidebar1.classList.remove('translate-x-full');
      sidebar1.classList.add('translate-x-0');
    });

    // Tutup sidebar
    closeBtn1.addEventListener('click', () => {
      sidebar1.classList.add('translate-x-full');
      sidebar1.classList.remove('translate-x-0');
    });
  });
</script>

<?php
include '../koneksi.php';

// Tambah Data
if (isset($_POST['submit_tambah'])) {
    $T_id = $_POST['ID_PEGAWAI'];
    $T_package = $_POST['nama'];
    $T_harga2 = $_POST['jabatan'];
    $T_harga = $_POST['noHp'];
 

    $query = "INSERT INTO pegawai(ID_PEGAWAI,Nama_Pegawai,Jabatan,No_Hp) VALUES ('$T_id','$T_package','$T_harga2','$T_harga')";
    mysqli_query($conn, $query);
    echo "<script>
        window.location.href = 'pegawai.php';
      </script>";

}



