  
  
  
<aside id="sidebar1" class="fixed top-0 right-0 h-full w-96 rounded-xl transform translate-x-full bg-[#001f3f] text-white border flex flex-col transition-transform duration-300 z-50 overflow-y-auto">
  <div class="px-4 pt-4 flex justify-between items-center">
    <h2 class="text-lg font-semibold">Tambah Nota</h2>
    <button id="toggle-btn1" class="bg-[#001f3f] hover:bg-blue-800 p-2 rounded-md focus:outline-none" aria-label="Tutup sidebar">✕</button>
  </div>

<form id="pegawaiForm" method="POST" action="" class="p-6 space-y-4">
  <input type="hidden" id="formMode" value="add">
  <input type="hidden" id="editRowIndex">

  <div>
    <label class="block mb-1 font-medium">No Pesanan </label>
    <input type="text" name="nopes" id="idcustomer" class="w-full text-black border px-4 py-2 rounded">
  </div>
  <div>
    <label class="block font-medium">Nama Customer</label>
   <tr><td> 
        <td><select name="idcustomer" class="w-full text-black border px-4 py-2 rounded">
        <option value="">--Pilih--</option>
        <?php
        include '../koneksi.php';
        $query=mysqli_query($conn, "SELECT * FROM pegawai");
        while ($data = mysqli_fetch_array($query)) {
        ?>
          
            <option value="<?php echo $data['ID_PEGAWAI'];?>" >
            <?php echo $data['Nama_Pegawai'];?></option>
        <?php
        }
        ?></td>
        </select>
        </td></tr>
  </div>
    <div>
    <label class="block  font-medium">Nama Pegawai</label>
   <tr><td> 
        <td><select name="idpegawai" class="w-full text-black border px-4 py-2 rounded">
        <option value="">--Pilih--</option>
        <?php
        include '../koneksi.php';
        $query=mysqli_query($conn, "SELECT * FROM customer");
        while ($data = mysqli_fetch_array($query)) {
        ?>
          
            <option value="<?php echo $data['ID_CUSTOMER'];?>" >
            <?php echo $data['Nama_Customer'];?></option>
        <?php
        }
        ?></td>
        </select>
        </td></tr>
  </div>
  <div>
    <label class="block mb-1 font-medium">Tanggal Transaksi</label>
    <input type="date" name="jabatan" id="noHp" class="w-full text-black border px-4 py-2 rounded">
  </div>
    <div>
    <label class="block mb-1 font-medium">Total</label>
    <input type="number" name="noHp" id="noHp" class="w-full text-black border px-4 py-2 rounded">
  </div>
   <div>
    <label class="block mb-1 font-medium">Uang Muka</label>
    <input type="number" name="noHp1" id="noHp" class="w-full text-black border px-4 py-2 rounded">
  </div>
   <div>
    <label class="block mb-1 font-medium">Sisa</label>
    <input type="number" name="noHp2" id="noHp" class="w-full text-black border px-4 py-2 rounded">
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
    $T_id = $_POST['nopes'];
    $T_package = $_POST['idcustomer'];
    $T_harga = $_POST['idpegawai'];
    $T_package1 = $_POST['jabatan'];
    $T_harga1 = $_POST['noHp'];
    $T_harga2 = $_POST['noHp1'];
    $T_harga3 = $_POST['noHp2'];
 

    $query = "INSERT INTO nota VALUES ('$T_id','$T_package','$T_harga','$T_package1','$T_harga1','$T_harga2','$T_harga3')";
    mysqli_query($conn, $query);
    echo "<script>
        window.location.href = 'nota.php';
      </script>";

}



