<aside id="sidebar" class="sidebar-transition w-64 bg-[#001f3f] text-white flex flex-col transition-all duration-300 overflow-hidden">
  <div id="sidebar-content"></div>
      

     
      <div class="bg-image-css px-20 py-12  ">
        <img src="" class="w-20 ml-1 mt-4"alt="">
        <h2 class="text-lg font-semibold mt-4 ml-5 mb-2"></h2>
       </div>

      <nav class="flex flex-col space-y-3 border border-gray-500 border-t-1 border-x-0 border-b-0 pt-4">
         <h2 class="px-2 py-2 text-gray-500">Home</h2>
        <a href="../dashboard.php" class="px-4 py-2  transition <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? ' rounded-l-md ml-4 bg-white text-black font-semibold' : ''; ?>"><i class="bi bi-house-door-fill"></i>
      Dashboard</a>
      <h2 class="px-2 py-2 text-gray-500">Table Master</h2>
        <a href="../pegawai/pegawai.php" class="px-4 py-2 transition <?php echo basename($_SERVER['PHP_SELF']) == 'pegawai.php' ? 'rounded-l-md ml-4 bg-white text-black font-semibold' : ''; ?>"><i class="bi bi-person-standing"></i>
    Pegawai</a>
        <a href="../customer/customer.php" class="px-4 py-2 transition <?php echo basename($_SERVER['PHP_SELF']) == 'customer.php' ? ' rounded-l-md ml-4 bg-white text-black font-semibold' : ''; ?>"><i class="bi bi-person-arms-up"></i>
    Pelanggan</a>
        <a href="../item/item.php" class="px-4 py-2 transition <?php echo basename($_SERVER['PHP_SELF']) == 'item.php' ? 'rounded-l-md ml-4 bg-white text-black font-semibold' : ''; ?>"><i class="bi bi-box"></i></i>
    Barang</a>
    <a href="../perusahaan/perusahaan.php" class="px-4 py-2 transition <?php echo basename($_SERVER['PHP_SELF']) == 'perusahaan.php' ? 'rounded-l-md ml-4 bg-white text-black font-semibold' : ''; ?>"><i class="bi bi-building"></i></i>
    Perusahaan</a>
    <a href="../supplier/supplier.php" class="px-4 py-2 transition <?php echo basename($_SERVER['PHP_SELF']) == 'supplier.php' ? ' rounded-l-md ml-4 bg-white text-black font-semibold' : ''; ?>"><i class="bi bi-diagram-2-fill"></i>
    Pemasok</a>
          <h2 class="px-2 py-2 text-gray-500">Table transaction</h2>
    <a href="../pesanan/pesanan.php" class="px-4 py-2 transition <?php echo basename($_SERVER['PHP_SELF']) == 'pesanan.php' ? 'rounded-l-md ml-4 bg-white text-black font-semibold' : ''; ?>"><i class="bi bi-card-list"></i></i>
    Nota Pembelian</a>
     <a href="../nota/nota.php" class="px-4 py-2 transition <?php echo basename($_SERVER['PHP_SELF']) == 'nota.php' ? 'rounded-l-md ml-4 bg-white text-black font-semibold' : ''; ?>"><i class="bi bi-card-list"></i></i>
    Nota Penjualan</a>
     
      </nav>
    </div>
</aside>

<!-- Main content -->
<div id="main-content" class="flex-1 flex flex-col transition-all duration-300">

  <!-- Navbar -->
  <header class="h-20  bg-gray-100 text-black flex items-center justify-between pl-6 border shadow-lg rounded-xl m-4">
  <!-- Kiri: Tombol + Judul -->
  <div class="flex items-center space-x-4">
    <!-- Toggle Button -->
    <button id="toggle-btn" class="bg-[#001f3f] hover:bg-blue-800 p-2 rounded-md focus:outline-none" aria-label="Toggle sidebar">
      <!-- Icon hamburger -->
      <svg id="icon-open" class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        viewBox="0 0 24 24">
        <line x1="3" y1="12" x2="21" y2="12" />
        <line x1="3" y1="6" x2="21" y2="6" />
        <line x1="3" y1="18" x2="21" y2="18" />
      </svg>
      <!-- Icon close -->
      <svg id="icon-close" class="w-6 h-6 hidden text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        viewBox="0 0 24 24">
        <line x1="3" y1="12" x2="21" y2="12" />
        <line x1="3" y1="6" x2="21" y2="6" />
        <line x1="3" y1="18" x2="21" y2="18" />
      </svg>
    </button>

    <!-- Judul -->
  </div>

  <!-- Kanan: Menu User -->
  <div class="relative h-20 pl-12 flex p-6 bg-red-500 rounded-xl">
    <button class="text-white mr-2 pr-2 border border-y-0 border-l-0 border-r-3 border-white">
      <i class="bi bi-bell-fill"></i>
    </button>
    <button id="user-menu" class="flex items-center text-white focus:outline-none">
      <h1 class="text-md font-semibold mr-2">USER</h1>
      <img src="../asset/R.png" class="w-8 h-8 mr-2 rounded-full" alt="User Image">
      <h1 class="text-md font-semibold mr-2"><i class=" h-2 bi bi-chevron-down"></i></h1>
    </button>

    <!-- Dropdown -->
    <div id="dropdown" class="absolute right-0 mt-8 w-40 bg-white border rounded-md shadow-lg hidden z-10">
      <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Setting</a>
      <a href="../login.php" class="block px-4 py-2 text-sm hover:bg-gray-100">Logout</a>
    </div>
  </div>
</header>

  <script>
    const toggleBtn = document.getElementById('toggle-btn');
    const sidebar = document.getElementById('sidebar');
    const sidebarContent = document.getElementById('sidebar-content');
    const mainContent = document.getElementById('main-content');
    const iconOpen = document.getElementById('icon-open');
    const iconClose = document.getElementById('icon-close');

    let isSidebarOpen = true;

    toggleBtn.addEventListener('click', () => {
      isSidebarOpen = !isSidebarOpen;

      if (isSidebarOpen) {
        sidebar.classList.remove('w-0');
        sidebar.classList.add('w-64');
        sidebarContent.classList.remove('hidden');
        iconOpen.classList.remove('hidden');
        iconClose.classList.add('hidden');
      } else {
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-0');
        sidebarContent.classList.add('hidden');
        iconOpen.classList.add('hidden');
        iconClose.classList.remove('hidden');
      }
    });
      const userMenuBtn = document.getElementById('user-menu');
  const dropdown = document.getElementById('dropdown');

  userMenuBtn.addEventListener('click', () => {
    dropdown.classList.toggle('hidden');
  });

  // Optional: klik di luar dropdown untuk menutup
  document.addEventListener('click', (e) => {
    if (!userMenuBtn.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.classList.add('hidden');
    }
  });

  </script>