<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/indexstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>
<body>
  <!-- Login Section -->
    <div class="flex flex-col items-center justify-center min-h-screen text-center pt-20 ">
     <div class="text-white w-96 px-10 py-4 border border-white/50 rounded-md backdrop-blur-sm shadow-xl">
      <div class="flex justify-center text-center">
          <img src="asset/icon-removebg-preview.png" class="h-44 w-44" alt="">
      </div>
   
        
    <form action="" method="POST" class="flex flex-col">

      <h1 class="text-3xl font-bold text-white mb-8 mt-6">Login</h1>
      
      <input
        type="text" name="nama"
        class="mb-6 h-12 px-4 bg-transparent text-white placeholder-white border border-white/50 rounded-full w-full focus:outline-none focus:ring-2 focus:ring-white"
        placeholder="Name"
      />

      <input
        type="password" name="password"
        class="mb-6 h-12 px-4 bg-transparent text-white placeholder-white border border-white/50 rounded-full w-full focus:outline-none focus:ring-2 focus:ring-white"
        placeholder="Password"
      />

       <button type="submit" name="submit" class="text-lg font-semibold h-10 bg-indigo-500 backdrop-blur-sm rounded-full hover:bg-indigo-600 transition duration-200">
          Login
      </button>
          <?php
                        // Pastikan koneksi ke database
                        include 'koneksi.php';

                        if (!$conn) {
                            die("Koneksi gagal: " . mysqli_connect_error());
                        }

                        // Inisialisasi variabel error
                        $salah = "";

                        if (isset($_POST['submit'])) {
                            $nama = $_POST['nama'];
                            $password = $_POST['password'];

                            $query = mysqli_query($conn, "SELECT * FROM akun_pegawai WHERE Nama='$nama'");
                         $data = mysqli_fetch_array($query);

                            if ($data) {
                                // Jika password di-hash di database, gunakan password_verify()
                                if ($password == $data['Password']) {  
                                    echo "<script>window.location.href = 'dashboard.php?nama=<?php echo $nama;?>';</script>";
                                    exit();  
                                }
                                
                                else {
                                    $salah = "⚠ Password Anda salah!";
                                }
                            } else {
                                $salah = "⚠ Username tidak ditemukan!";
                            }
                        }
                        ?>

          <?php if (!empty($salah)) { ?>
                        <p class="text-red-500 text-center mt-2"><?php echo $salah; ?></p>
          <?php } ?>
    </form>
  </div>
    </div>

</body>
</html>