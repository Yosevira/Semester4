<!DOCTYPE html>
<html>

<head>
    <title>Pemweb</title>
    <style>
    body {
        font-family: sans-serif;
        margin: 40px auto;
        /* Memberikan margin atas bawah dan otomatis kiri kanan untuk memusatkan */
        padding: 20px;
        background-color: #f4f4f4;
        color: #333;
        line-height: 1.6;
        max-width: 800px;
        /* Menentukan lebar maksimum konten */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* Efek bayangan opsional */
        border-radius: 8px;
        /* Sudut membulat opsional */
    }

    h1 {
        color: #000080;
        /* Warna navy untuk judul */
        text-align: center;
        margin-bottom: 20px;
        padding: 15px 0;
        background-color: #e0e0e0;
        border-bottom: 2px solid #000080;
    }

    table {
        width: 100%;
        /* Membuat tabel mengisi lebar konten */
        border-collapse: collapse;
        /* Menggabungkan batas sel */
        margin-bottom: 20px;
        background-color: white;
        /* Latar belakang tabel putih */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        /* Efek bayangan tipis untuk tabel */
        border-radius: 5px;
        /* Sudut membulat untuk tabel */
        overflow: hidden;
        /* Untuk memastikan border-radius bekerja dengan baik */
    }

    th,
    td {
        border: 1px solid #ddd;
        /* Garis pemisah antar sel */
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        /* Latar belakang header tabel */
        color: #333;
        font-weight: bold;
        text-align: center;
        /* Teks header di tengah */
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
        /* Warna latar belakang baris genap sedikit berbeda */
    }

    a {
        color: #000080;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    a:hover {
        color: #4169e1;
    }
    </style>
</head>

<body>
    <h1>Rekayasa Perangkat Lunak</h1>
    <table border="1">
        <tr>
            <th>Jam</th>
            <th>Dosen</th>
            <th>Link Google Classroom</th>
        </tr>
        <tr>
            <td>10.15-13.00</td>
            <td>Pak Masrur</td>
            <td><a href="https://classroom.google.com/c/NzU2OTUwNDk1Mzgz" target="_blank">Klik
                    Disini</a></td>
        </tr>
        <tr>
            <td>-</td>
            <td>-</td>
            <td><a href="https://classroom.google.com/c/NzE4MDM0MTAzMjc5" target="_blank">Klik
                    Disini</a></td>
        </tr>

    </table>
</body>

</html>