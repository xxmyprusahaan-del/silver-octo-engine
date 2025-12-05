<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas PHP Ganjil - Solusi Akhir</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-top: 0;
        }
        form {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: 600;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #2ecc71;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #27ae60;
        }
        .result {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #3498db;
            border-left: 5px solid #3498db;
            background-color: #e8f7ff;
            border-radius: 5px;
        }
        .result p {
            margin: 5px 0;
        }
        .menu a {
            text-decoration: none;
            color: #3498db;
            margin-right: 15px;
            font-weight: 600;
        }
        .menu a:hover {
            color: #2980b9;
        }
        .error {
            color: #e74c3c;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="menu">
        Pilih Soal: 
        <a href="?soal=1">Soal 1</a> | 
        <a href="?soal=2">Soal 2</a> | 
        <a href="?soal=3">Soal 3</a> | 
        <a href="?soal=4">Soal 4</a> | 
        <a href="?soal=5">Soal 5</a> | 
        <a href="?soal=6">Soal 6</a>
    </div>

    <hr>

    <?php
    // Inisialisasi variabel soal, default ke 1
    $soal = isset($_GET['soal']) ? intval($_GET['soal']) : 1;

    // Fungsi untuk memformat angka menjadi format Rupiah
    function format_rupiah($angka) {
        return "Rp " . number_format($angka, 0, ',', '.');
    }

    // --- SOAL 1: Konversi Usia ke Kategori Manusia (Percabangan Bertingkat) ---
    if ($soal == 1) {
        echo "<h2>Soal 1: Konversi Usia ke Kategori Manusia</h2>";
        echo "<form method='POST' action='?soal=1'>";
        echo "<label for='usia'>Input Usia (0–120):</label>";
        echo "<input type='number' name='usia' id='usia' required min='0'>";
        echo "<input type='submit' name='submit1' value='Tentukan Kategori'>";
        echo "</form>";

        if (isset($_POST['submit1'])) {
            $usia = intval($_POST['usia']);
            $kategori = "";

            if ($usia < 0 || $usia > 120) { // Jika usia di luar rentang 0–120
                $kategori = "<span class='error'>Usia tidak valid.</span>"; 
            } elseif ($usia >= 0 && $usia <= 5) { // Usia 0–5
                $kategori = "Balita"; 
            } elseif ($usia >= 6 && $usia <= 12) { // Usia 6–12
                $kategori = "Anak-anak"; 
            } elseif ($usia >= 13 && $usia <= 17) { // Usia 13–17
                $kategori = "Remaja"; 
            } elseif ($usia >= 18 && $usia <= 59) { // Usia 18–59
                $kategori = "Dewasa"; 
            } else { // 60-120
                $kategori = "Lansia"; 
            }
            
            echo "<div class='result'>";
            echo "<p><strong>Usia:</strong> $usia tahun</p>";
            echo "<p><strong>Kategori:</strong> $kategori</p>"; 
            echo "</div>";
        }
    }

    // --- SOAL 2: Perhitungan Gaji Bersih Karyawan (Operator, Percabangan) ---
    elseif ($soal == 2) {
        echo "<h2>Soal 2: Perhitungan Gaji Bersih Karyawan</h2>";
        echo "<form method='POST' action='?soal=2'>";
        echo "<label for='nama_karyawan'>Nama Karyawan:</label>"; 
        echo "<input type='text' name='nama_karyawan' id='nama_karyawan' required>";
        echo "<label for='gaji_pokok'>Gaji Pokok (Rp):</label>"; 
        echo "<input type='number' name='gaji_pokok' id='gaji_pokok' required min='0'>";
        echo "<label for='tunjangan'>Tunjangan (Rp):</label>"; 
        echo "<input type='number' name='tunjangan' id='tunjangan' required min='0'>";
        echo "<input type='submit' name='submit2' value='Hitung Gaji Bersih'>";
        echo "</form>";

        if (isset($_POST['submit2'])) {
            $nama = $_POST['nama_karyawan'];
            $gaji_pokok = floatval($_POST['gaji_pokok']);
            $tunjangan = floatval($_POST['tunjangan']);

            // Hitung Gaji Kotor
            $gaji_kotor = $gaji_pokok + $tunjangan;

            // Terapkan potongan
            $persen_potongan = 0;
            if ($gaji_kotor >= 4000000) { // Jika Gaji Kotor ≥ 4.000.000
                $persen_potongan = 0.05; // potongan 5%
            } else { // Jika Gaji Kotor < 4.000.000
                $persen_potongan = 0.02; // potongan 2%
            }

            $besaran_potongan = $gaji_kotor * $persen_potongan;
            
            // Hitung Gaji Bersih
            $gaji_bersih = $gaji_kotor - $besaran_potongan;

            echo "<div class='result'>";
            echo "<p><strong>Nama Karyawan:</strong> $nama</p>"; 
            echo "<p><strong>Gaji Kotor:</strong> " . format_rupiah($gaji_kotor) . "</p>"; 
            echo "<p><strong>Besaran Potongan (" . ($persen_potongan * 100) . "%):</strong> " . format_rupiah($besaran_potongan) . "</p>"; 
            echo "<p><strong>Gaji Bersih:</strong> " . format_rupiah($gaji_bersih) . "</p>"; 
            echo "</div>";
        }
    }

    // --- SOAL 3: Program Menghitung Biaya Parkir (Tarif & Diskon) ---
    elseif ($soal == 3) {
        echo "<h2>Soal 3: Program Menghitung Biaya Parkir</h2>";
        echo "<form method='POST' action='?soal=3'>";
        echo "<label for='jenis_kendaraan'>Jenis Kendaraan:</label>"; 
        echo "<select name='jenis_kendaraan' id='jenis_kendaraan' required>";
        echo "<option value='Motor'>Motor</option>";
        echo "<option value='Mobil'>Mobil</option>";
        echo "</select>";
        echo "<label for='lama_parkir'>Lama Parkir (jam):</label>"; 
        echo "<input type='number' name='lama_parkir' id='lama_parkir' required min='0'>";
        echo "<input type='submit' name='submit3' value='Hitung Biaya Parkir'>";
        echo "</form>";

        if (isset($_POST['submit3'])) {
            $jenis_kendaraan = $_POST['jenis_kendaraan'];
            $lama_parkir = intval($_POST['lama_parkir']);
            $tarif_per_jam = 0;
            $diskon = 0;

            // Tentukan tarif
            if ($jenis_kendaraan == 'Motor') {
                $tarif_per_jam = 2000; // Motor: Rp2.000 per jam
            } else { // Mobil
                $tarif_per_jam = 5000; // Mobil: Rp5.000 per jam
            }

            // Hitung Total Awal
            $total_awal = $tarif_per_jam * $lama_parkir;
            $total_akhir = $total_awal;

            // Terapkan diskon 10% jika lama parkir > 5 jam
            $keterangan_diskon = "Tidak ada diskon.";
            if ($lama_parkir > 5) {
                $diskon = $total_awal * 0.10; // diskon 10% dari total
                $total_akhir = $total_awal - $diskon;
                $keterangan_diskon = "Diskon 10% diterapkan.";
            }

            echo "<div class='result'>";
            echo "<p><strong>Jenis Kendaraan:</strong> $jenis_kendaraan (Tarif: " . format_rupiah($tarif_per_jam) . "/jam)</p>"; 
            echo "<p><strong>Lama Parkir:</strong> $lama_parkir jam</p>"; 
            echo "<p><strong>Total Biaya Awal:</strong> " . format_rupiah($total_awal) . "</p>"; 
            echo "<p><strong>Diskon ($keterangan_diskon):</strong> " . format_rupiah($diskon) . "</p>"; 
            echo "<p><strong>Total Akhir yang harus dibayar:</strong> " . format_rupiah($total_akhir) . "</p>"; 
            echo "</div>";
        }
    }

    // --- SOAL 4: Program Menghitung Gaji Karyawan (Bonus) ---
    elseif ($soal == 4) {
        echo "<h2>Soal 4: Program Menghitung Gaji Karyawan (Lembur & Bonus)</h2>";
        echo "<form method='POST' action='?soal=4'>";
        echo "<label for='nama_karyawan4'>Nama Karyawan:</label>"; 
        echo "<input type='text' name='nama_karyawan4' id='nama_karyawan4' required>";
        echo "<label for='jam_kerja'>Jam Kerja (Rp20.000/jam):</label>"; 
        echo "<input type='number' name='jam_kerja' id='jam_kerja' required min='0'>";
        echo "<label for='jam_lembur'>Jam Lembur (Rp30.000/jam):</label>"; 
        echo "<input type='number' name='jam_lembur' id='jam_lembur' required min='0'>";
        echo "<input type='submit' name='submit4' value='Hitung Total Gaji'>";
        echo "</form>";

        if (isset($_POST['submit4'])) {
            $nama = $_POST['nama_karyawan4'];
            $jam_kerja = intval($_POST['jam_kerja']);
            $jam_lembur = intval($_POST['jam_lembur']);
            $gaji_per_jam = 20000; 
            $upah_lembur_per_jam = 30000; 
            $bonus = 0;

            // Hitung Gaji Pokok
            $gaji_pokok = $jam_kerja * $gaji_per_jam;
            
            // Hitung Gaji Lembur
            $gaji_lembur = $jam_lembur * $upah_lembur_per_jam;

            // Hitung Total Gaji (sebelum bonus)
            $total_gaji = $gaji_pokok + $gaji_lembur;

            // Tentukan bonus
            $keterangan_bonus = "Tidak ada bonus.";
            if ($total_gaji >= 1000000) { // Jika Total Gaji ≥ 1.000.000
                $bonus = 50000; // berikan bonus Rp50.000
                $keterangan_bonus = "Mendapat bonus karena total gaji ≥ Rp1.000.000.";
            }

            $total_gaji_akhir = $total_gaji + $bonus;

            echo "<div class='result'>";
            echo "<p><strong>Nama Karyawan:</strong> $nama</p>"; 
            echo "<p><strong>Jam Kerja:</strong> $jam_kerja jam</p>"; 
            echo "<p><strong>Jam Lembur:</strong> $jam_lembur jam</p>"; 
            echo "<p><strong>Gaji Pokok:</strong> " . format_rupiah($gaji_pokok) . "</p>"; 
            echo "<p><strong>Gaji Lembur:</strong> " . format_rupiah($gaji_lembur) . "</p>"; 
            echo "<p><strong>Total Gaji (sebelum bonus):</strong> " . format_rupiah($total_gaji) . "</p>";
            echo "<p><strong>Bonus ($keterangan_bonus):</strong> " . format_rupiah($bonus) . "</p>"; 
            echo "<h3>Total Gaji Akhir: " . format_rupiah($total_gaji_akhir) . "</h3>"; 
            echo "</div>";
        }
    }

    // --- SOAL 5: Program Konversi Suhu (Celsius → Fahrenheit & Reamur) ---
    elseif ($soal == 5) {
        echo "<h2>Soal 5: Program Konversi Suhu (°C ke °F & °R)</h2>";
        echo "<form method='POST' action='?soal=5'>";
        echo "<label for='celsius'>Suhu dalam Celsius (°C):</label>"; 
        echo "<input type='number' step='any' name='celsius' id='celsius' required>";
        echo "<input type='submit' name='submit5' value='Konversi Suhu'>";
        echo "</form>";

        if (isset($_POST['submit5'])) {
            $celsius = floatval($_POST['celsius']);
            $nol_absolut = -273.15; // Nol absolut

            echo "<div class='result'>";
            echo "<p><strong>Suhu Awal (Celsius):</strong> " . number_format($celsius, 2) . " °C</p>";
            
            // Periksa batas suhu nol absolut
            if ($celsius < $nol_absolut) { 
                echo "<p class='error'>**Suhu tidak valid secara ilmiah.** Suhu di bawah Titik Nol Absolut ($nol_absolut °C).</p>"; 
            } else {
                // Konversi Fahrenheit = (C × 9/5) + 32
                $fahrenheit = ($celsius * 9 / 5) + 32;
                
                // Konversi Reamur = C × 4/5
                $reamur = $celsius * 4 / 5;

                echo "<p><strong>Suhu dalam Fahrenheit:</strong> " . number_format($fahrenheit, 2) . " °F</p>"; 
                echo "<p><strong>Suhu dalam Reamur:</strong> " . number_format($reamur, 2) . " °R</p>"; 
            }
            echo "</div>";
        }
    }

    // --- SOAL 6: Pemutusan Listrik karena Tunggakan Pembayaran (Percabangan Bertingkat) ---
    elseif ($soal == 6) {
        echo "<h2>Soal 6: Pemutusan Listrik karena Tunggakan Pembayaran</h2>";
        echo "<form method='POST' action='?soal=6'>";
        echo "<label for='tunggakan'>Jumlah bulan menunggak (≥ 0):</label>"; 
        echo "<input type='number' name='tunggakan' id='tunggakan' required min='0'>";
        echo "<input type='submit' name='submit6' value='Cek Status Listrik'>";
        echo "</form>";

        if (isset($_POST['submit6'])) {
            $tunggakan = intval($_POST['tunggakan']);
            $status = "";

            // Gunakan percabangan bertingkat if-else if-else
            if ($tunggakan < 0) { // Seharusnya tidak mungkin karena min='0' di form, tapi ditambahkan untuk keamanan
                $status = "<span class='error'>Input tidak valid.</span>"; 
            } elseif ($tunggakan == 0) { // Jika tunggakan = 0 bulan
                $status = "Listrik aktif. Tidak ada tunggakan. ✅"; 
            } elseif ($tunggakan >= 1 && $tunggakan <= 2) { // Jika tunggakan = 1–2 bulan
                $status = "Peringatan! Segera lakukan pembayaran. ⚠️"; 
            } elseif ($tunggakan == 3) { // Jika tunggakan = 3 bulan
                $status = "Listrik dalam status pemutusan sementara. ❌"; 
            } else { // $tunggakan > 3
                $status = "<span class='error'>Listrik diputus total sampai seluruh tagihan lunas. 🚫</span>"; 
            }

            echo "<div class='result'>";
            echo "<p><strong>Jumlah Tunggakan:</strong> $tunggakan bulan</p>";
            echo "<p><strong>Status Layanan:</strong> $status</p>";
            echo "</div>";
        }
    }
    ?>
</div>

</body>
</html>