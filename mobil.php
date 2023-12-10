<?php
// Program sederhana pemanggilan class

class Mobil {
    private $warna;
    private $merk;
    private $harga;

    public function __construct() {
        $this->warna = "Biru";
        $this->merk = "Porsche";
        $this->harga = "10000000";
    }

    public function gantiWarna($warnaBaru) {
        $this->warna = $warnaBaru;
    }

    public function tampilWarna() {
        echo "Warna mobil : ".$this->warna;
    }
}

// Objek mobil
$a = new Mobil();
$b = new Mobil();

// Memanggil objek
echo "<b>Mobil pertama<b><br>";
$a->tampilWarna();
echo "<br>Mobil pertama ganti warna<br>";
$a->gantiWarna('Merah');
$a->tampilWarna();

echo "<br><b>Mobil kedua</b><br>";
$b->gantiWarna('Hijau');
$b->tampilWarna();

?>