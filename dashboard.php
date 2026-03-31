<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard with Tailwind CSS</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body class="flex h-screen bg-gray-200">

  <?php include("sidebar.php"); ?>

  <!-- Content -->
  <main class="p-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

      <!-- Card -->
      <div class="flex items-center p-5 bg-white rounded-md shadow-md">
        <div class="text-white bg-blue-400 p-4 rounded-full mr-4">
          <i class="bi bi-person-arms-up" style="font-size: 2.5rem;"></i>
        </div>
        <?php
        include 'koneksi.php';
        $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM customer; ");
        while ($data = mysqli_fetch_array($query)) {
          ?>
          <div>
            <h2 class="text-lg font-semibold text-gray-700">Total Pegawai</h2>
            <p class="text-2xl font-bold text-gray-900"><?php echo $data['total']; ?></p>
          </div>
        <?php } ?>
      </div>

      <!-- Card -->
      <div class="flex items-center p-5 bg-white rounded-md shadow-md">
        <div class="text-white bg-green-400 p-4 rounded-full mr-4">
          <i class="bi bi-people" style="font-size: 2.5rem;"></i>
        </div>
        <?php
        include 'koneksi.php';
        $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM customer; ");
        while ($data = mysqli_fetch_array($query)) {
          ?>
          <div>
            <h2 class="text-lg font-semibold text-gray-700">Total Customer</h2>
            <p class="text-2xl font-bold text-gray-900"><?php echo $data['total']; ?></p>
          </div>
        <?php } ?>
      </div>

      <!-- Card -->
      <div class="flex items-center p-5 bg-white rounded-md shadow-md">
        <div class="text-white bg-yellow-400 p-4 rounded-full mr-4">
          <i class="bi bi-cart-check" style="font-size: 2.5rem;"></i>
        </div>
        <?php
        include 'koneksi.php';
        $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM nota; ");
        while ($data = mysqli_fetch_array($query)) {
          ?>
          <div>
            <h2 class="text-lg font-semibold text-gray-700">Total Transaksi</h2>
            <p class="text-2xl font-bold text-gray-900"><?php echo $data['total']; ?></p>
          </div>
        <?php } ?>
      </div>

      <!-- Card -->
      <div class="flex items-center p-5 bg-white rounded-md shadow-md">
        <div class="text-white bg-red-400 p-4 rounded-full mr-4">
          <i class="bi bi-cash-stack" style="font-size: 2.5rem;"></i>
        </div>
        <?php
        include 'koneksi.php';
        $query = mysqli_query($conn, "SELECT SUM(Total) AS total FROM nota;");
        while ($data = mysqli_fetch_array($query)) {
          $angka = $data['total'];
          $rupiah = number_format($angka, 0, ',', '.');
          ?>
          <div>
            <h2 class="text-lg font-semibold text-gray-700">Total Pendapatan</h2>
            <p class="text-2xl font-bold text-gray-900">Rp<?php echo $rupiah; ?></p>
          </div>
        <?php } ?>
      </div>


    </div>

    <div class="flex flex-col lg:flex-row gap-6 mt-5">
  <!-- Grafik -->
  <div class="w-full lg:w-1/2">
    <div class="bg-white shadow-md rounded-md p-5 h-full">
      <div class="bg-gray-800 text-white rounded-t-md p-4 text-center">
        <h5 class="text-lg font-semibold">Grafik Customers</h5>
        <p class="text-sm">dengan Chart</p>
      </div>
      <div class="mt-4">
        <canvas id="barChart" class="w-full h-72"></canvas>
      </div>
    </div>
  </div>
  <!-- Table Audit -->
  <div class="w-full lg:w-1/2">
    <div class="bg-white shadow-md rounded-md p-5 h-full">
      <div class="bg-gray-800 text-white rounded-t-md p-4 text-center">
        <h5 class="text-lg font-semibold">Audit Log</h5>
      </div>
      <div class="overflow-x-auto mt-4">
        <table class="min-w-full text-sm text-left">
          <thead>
            <tr>
              <th class="px-2 py-1 border-b">No</th>
              <th class="px-2 py-1 border-b">User</th>
              <th class="px-2 py-1 border-b">Aktivitas</th>
              <th class="px-2 py-1 border-b">Waktu</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include 'koneksi.php';
            $no = 1;
            $audit = mysqli_query($conn, "SELECT * FROM audit ORDER BY waktu DESC LIMIT 10");
            while ($row = mysqli_fetch_assoc($audit)) {
              echo "<tr>
                <td class='px-2 py-1 border-b'>{$no}</td>
                <td class='px-2 py-1 border-b'>{$row['waktu']}</td>
                <td class='px-2 py-1 border-b'>{$row['keterangan']}</td>
                <td class='px-2 py-1 border-b'>{$row['id_pegawai']}</td>
              </tr>";
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
  </main>


</body>
<?php include 'koneksi.php';
$query = "SELECT MONTH(created_at) AS month_num, count(nama_customer) AS total FROM customer_log GROUP BY MONTH(created_at) ORDER BY MONTH(created_at)";
$result = $conn->query($query);

$months = [
  "Januari",
  "Februari",
  "Maret",
  "April",
  "Mei",
  "Juni",
  "Juli",
  "Agustus",
  "September",
  "Oktober",
  "November",
  "Desember"
];

// Inisialisasi array total penjualan dengan nilai 0
$sales = array_fill(0, 12, 0);

// Masukkan data dari database ke dalam array bulan yang sesuai
while ($row = $result->fetch_assoc()) {
  $index = $row['month_num'] - 1; // Index mulai dari 0 (Januari = 0)
  $sales[$index] = $row['total'];
}
?>
<script>
  const ctx = document.getElementById('barChart').getContext('2d');
  const barChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($months); ?>,
      datasets: [{
        label: 'Jumlah Customers',
        data: <?= json_encode($sales); ?>,
        backgroundColor: '#4f46e5'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          grid: {
            display: false
          }
        },
        y: {
          grid: {
            display: false
          },
          beginAtZero: true
        }
      }
    }
  });

</script>

</html>