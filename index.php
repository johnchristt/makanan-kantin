<?php
$conn = mysqli_connect("localhost", "root", "root", "menu_db");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$edit = null;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM menu WHERE id='$id'");
    $edit = mysqli_fetch_assoc($result);
}

$data = mysqli_query($conn, "SELECT * FROM menu ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Menu Kantin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>Manajemen Menu Kantin</h1>

    <form action="proses.php" method="POST">

        <input type="hidden" name="id"
        value="<?php echo isset($edit['id']) ? $edit['id'] : ''; ?>">

        <input type="text"
               name="nama_makanan"
               placeholder="Nama Makanan"
               value="<?php echo isset($edit['nama_makanan']) ? $edit['nama_makanan'] : ''; ?>"
               required>

        <input type="text"
               name="kategori"
               placeholder="Kategori"
               value="<?php echo isset($edit['kategori']) ? $edit['kategori'] : ''; ?>"
               required>

        <input type="number"
               name="harga"
               placeholder="Harga"
               value="<?php echo isset($edit['harga']) ? $edit['harga'] : ''; ?>"
               required>

        <select name="status_ketersediaan" required>
            <option value="">Pilih Status</option>
            <option value="Tersedia"
            <?php
            if(isset($edit['status_ketersediaan']) &&
               $edit['status_ketersediaan']=="Tersedia") echo "selected";
            ?>>
            Tersedia
            </option>

            <option value="Habis"
            <?php
            if(isset($edit['status_ketersediaan']) &&
               $edit['status_ketersediaan']=="Habis") echo "selected";
            ?>>
            Habis
            </option>
        </select>

        <?php if($edit){ ?>
            <button type="submit" name="update">Update</button>
        <?php } else { ?>
            <button type="submit" name="simpan">Tambah</button>
        <?php } ?>

    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama Makanan</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($data)){ ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nama_makanan']; ?></td>
            <td><?php echo $row['kategori']; ?></td>
            <td>Rp <?php echo number_format($row['harga']); ?></td>
            <td><?php echo $row['status_ketersediaan']; ?></td>
            <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
                |
                <a href="proses.php?hapus=<?php echo $row['id']; ?>"
                   onclick="return confirm('Hapus data?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>