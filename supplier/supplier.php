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
  <?php include("suppliertambah.php"); ?>

 <!-- Tombol Buka Sidebar -->
<main class="flex-1 p-6 m-20 mt-8 overflow-auto rounded-md bg-white">
  <div class="flex justify-between items-center mt-6">
    <h2 class="text-2xl font-bold mb-4">Table Supplier</h2>   
    <button id="open-sidebar-btn" class="bg-yellow-400 hover:bg-yellow-300 text-white px-4 py-2 rounded-md">+ TAMBAHKAN</button>
  </div>

  <!-- Tabel Customer -->
  <div class="w-full mt-6 overflow-x-auto">
    <table id="example" class="w-full text-center border-collapse text-sm font-medium">
      <thead class="bg-blue-200">
        <tr>
          <th class="border px-4 py-2">No</th>
          <th class="border px-4 py-2">Id Supplier</th>
          <th class="border px-4 py-2">Nama Supplier</th>
          <th class="border px-4 py-2">Alamat</th>
          <th class="border px-4 py-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
       <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM supplier");
        while ($data = mysqli_fetch_array($query)) {
          $sidebarId = "sidebar-edit-" . $data['ID_SUPPLIER'];
        ?>
          <tr class="hover:bg-gray-100">
            <td class="border px-4 py-2"><?php echo $no++; ?></td>
            <td class="border px-4 py-2"><?php echo $data['ID_SUPPLIER']; ?></td>
            <td class="border px-4 py-2 text-left"><?php echo $data['Nama_Supplier']; ?></td>
            <td class="border px-4 py-2"><?php echo $data['Alamat']; ?></td>
            <td class="border px-4 py-2">
              <button class="open-sidebar-btn bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition" 
                      data-target="<?= $sidebarId ?>">Ubah</button>
              <span class="mx-1">|</span>
                <button onclick="document.getElementById('myModal').classList.remove('hidden')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                      Hapus
              </button>
            </td>
          </tr>
         <?php include("supplierhapus.php");  ?>
         <?php include("supplierubah.php");  ?>
         <?php } ?>
        

   <Script>       

  document.addEventListener('DOMContentLoaded', function () {
    const sidebar2 = document.getElementById('sidebar2');
    const openBtn2 = document.getElementById('open-sidebar-btn2');
    const closeBtn2 = document.getElementById('toggle-btn2');

    // Buka sidebar
    openBtn2.addEventListener('click', () => {
      sidebar2.classList.remove('translate-x-full');
      sidebar2.classList.add('translate-x-0');
    });

    // Tutup sidebar
    closeBtn2.addEventListener('click', () => {
      sidebar2.classList.add('translate-x-full');
      sidebar2.classList.remove('translate-x-0');
    });
  });
</script>

<!-- Sidebar -->


<!-- Script harus di akhir -->


    <script>
     $(document).ready(function () {
        const table = $('#example').DataTable({
            info: false,        // Hilangkan "Showing 1 to X..."
            paging: false,      // Hilangkan pagination (Previous, Next, dll)
            searching: true     // Tetap aktifkan pencarian
        });

        // Styling Tailwind ke input search
        const filter = $('#example_filter');
        filter.addClass('flex justify-end mb-4');

        const label = filter.find('label');
        label.addClass('text-sm font-medium text-gray-700');

        const input = filter.find('input');
        input.addClass('ml-2 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500');
        input.attr('placeholder', 'Cari data...');
        });
    </script>
  </main>

</body>
</html>