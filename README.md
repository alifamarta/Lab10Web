<h1 align="center">Praktikum 10: OOP</h1>

<table align="center">
  <tr>
    <th colspan="2">DATA MAHASISWA</th>
  </tr>
  <tr>
    <td>Nama</td>
    <td>Alif Nur Fathlii Amarta</td>
  </tr>
  <tr>
    <td>NIM</td>
    <td>312210326</td>
  </tr>
  <tr>
    <td>Kelas</td>
    <td>TI.22.A3</td>
  </tr>
</table>

## Praktikum

buat file dengan nama **mobil.php** yang berisi

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

Buat file dengan nama **form.php**

    <?php
    
    class Form {
        private $fields = array();
        private $action;
        private $submit = "Submit Form";
        private $jumField = 0;
    
        public function __construct($action, $submit) {
            $this->action = $action;
            $this->submit = $submit;
        }
    
        public function displayForm() {
            echo "<form action='".$this->action."' method='POST'>";
            echo '<table width="100%" border="0">';
            for ($j=0; $j<count($this->fields); $j++) {
            echo "<tr><td
            align='right'>".$this->fields[$j]['label']."</td>";
            echo "<td><input type='text'
            name='".$this->fields[$j]['name']."'></td></tr>";
            }
            echo "<tr><td colspan='2'>";
            echo "<input type='submit' value='".$this->submit."'></td></tr>";
            echo "</table>";
        }
    
        public function addField($name, $label) {
            $this->fields [$this->jumField]["name"] = $name;
            $this->fields [$this->jumField]["label"] = $label;
            $this->jumField++;
        }
    }
    ?>

Buat file dengan nama form_input.php

    <?php
    include("form.php");
    
    echo "<html><head><title>Mahasiswa</title></head><body>";
    $form = new Form("", "Input Form");
    $form->addField("txtnim", "Nim");
    $form->addField("txtnama", "Nama");
    $form->addField("txtalamat", "Alamat");
    echo "<h3>Silahkan isi form berikut ini :</h3>";
    $form->displayForm();
    echo "</body></html>";
    
    ?>

Buat file dengan nama **database.php**

    <?php 
    
    class Database {
        protected $host;
        protected $user;
        protected $password;
        protected $db_name;
        protected $conn;
    
        public function __construct() {
            $this->getConfig();
            $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                die("Connection failed: ". $this->conn->connect_error);
            }
        }
    
        private function getConfig() {
            include_once("config.php");
            $this->host = $config['host'];
            $this->user = $config['username'];
            $this->password = $config['password'];
            $this->db_name = $config['db_name'];
        }
    
        public function query($sql) {
            return $this->conn->query($sql);
        }
    
        public function get($table, $where=null) {
            if($where){
                $where = 'WHERE' .$where;
            }
            $sql = 'SELECT * FROM '. $table. $where;
            $sql = $this->conn->query($sql);
            $sql = $sql->fetch_assoc();
            return $sql;
        }
    
        public function insert($table, $data) {
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $column[] = $key;
                    $value[] = "'${value}'";
                }
                $columns = implode(", ", $column);
                $values = implode(", ", $value);
            }
            $sql = "INSERT INTO".$table."(".$columns.") VALUES (".$values.")";
            $sql = $this->conn->query($sql);
    
            if ($sql == true){
                return $sql;
            } else {
                return false;
            }
        }
    
        public function update($table, $data, $where) {
            $update_value = "";
    
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $update_value[]= "$key='${value}'";
                }
                $update_value = implode(", ", $update_value);
            }
    
            $sql = "UPDATE " .$table." SET ".$update_value." WHERE ".$where;
            $sql = $this->conn->query($sql);
            if ($sql == true){
                return true;
            } else {
                return false;
            }
        }
    }
    ?>
