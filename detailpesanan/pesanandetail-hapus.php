<?php
// include database connection file
include '../koneksi.php';

// Get id from URL to delete that user
if (isset($_GET['NO_TRANSAKSI']) && isset($_GET['NO_ITEM'])) {
    $nota_no = mysqli_real_escape_string($conn, $_GET['NO_TRANSAKSI']);
    $no_barang = mysqli_real_escape_string($conn, $_GET['NO_ITEM']);
    
    // Delete user row from table based on given id with LIMIT 1
    $result = mysqli_query($conn, "DELETE FROM detail_pesanan WHERE NO_TRANSAKSI = '$nota_no' AND NO_ITEM = '$no_barang' LIMIT 1");

    if ($result) {
        // Calculate new total price after deletion
        $query = "SELECT SUM(Jumlah) AS total FROM detail_pesanan WHERE NO_TRANSAKSI = '$nota_no'";
        $totalResult = mysqli_query($conn, $query);
        
        if ($totalResult) {
            $row = mysqli_fetch_assoc($totalResult);
            $jumlah_rpBaru = $row['total'] ?? 0;

            // Update total price in nota table
            $updateResult = mysqli_query($conn, "UPDATE pesanan SET Total_Pembelian = '$jumlah_rpBaru' WHERE NO_TRANSAKSI = '$nota_no'");

            if ($updateResult) {
                // After delete redirect to Home, so that latest user list will be displayed.
                header("Location: pesanandetail.php?NO_TRANSAKSI=$nota_no");
                exit();
            } else {
                echo "Error updating total price: " . mysqli_error($conn);
            }
        } else {
            echo "Error calculating new total: " . mysqli_error($conn);
        }
    } else {
        echo "Error deleting item: " . mysqli_error($conn);
    }
} else {
    echo "Invalid parameters.";
}
?>
