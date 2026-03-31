  
  
  

<!-- Modal -->


<!-- Modal Konfirmasi -->
<div id="myModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-[9999]">
  <div class="bg-white p-6 rounded shadow-xl w-1/3">
    <h2 class="text-xl font-bold mb-4">Konfirmasi Hapus</h2>
    <p class="mb-4">Apakah Anda yakin ingin menghapus data ini?</p>
    <form method="POST">
      <input type="hidden" name="hapus" value="<?php echo $data['ID_PEGAWAI'] ;?>">
      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeModal()" class="bg-gray-400 px-4 py-2 text-white rounded">Batal</button>
        <button type="submit" name="submit_hapus" class="bg-red-600 px-4 py-2 text-white rounded">Ya, Hapus</button>
      </div>
    </form>
  </div>
</div>

    <?php
if (isset($_POST['submit_hapus'])) {
  $hapus = $_POST['hapus'];
  mysqli_query($conn, "DELETE FROM pegawai WHERE ID_PEGAWAI='$hapus'");
  echo "<script>window.location.href = 'pegawai.php';</script>";
}
?>

 <script>
  function showModal() {
    document.getElementById('myModal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('myModal').classList.add('hidden');
  }
</script>
