<?php
$conn = mysqli_connect("localhost", "root", "root", "menu_db");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if(isset($_POST['simpan'])){

    $nama = $_POST['nama_makanan'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $status = $_POST['status_ketersediaan'];

    mysqli_query($conn,"
        INSERT INTO menu
        (nama_makanan,kategori,harga,status_ketersediaan)
        VALUES
        ('$nama','$kategori','$harga','$status')
    ");

    header("Location:index.php");
}

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $nama = $_POST['nama_makanan'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $status = $_POST['status_ketersediaan'];

    mysqli_query($conn,"
        UPDATE menu SET
        nama_makanan='$nama',
        kategori='$kategori',
        harga='$harga',
        status_ketersediaan='$status'
        WHERE id='$id'
    ");

    header("Location:index.php");
}

if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    mysqli_query($conn,"
        DELETE FROM menu
        WHERE id='$id'
    ");

    header("Location:index.php");
}
?>