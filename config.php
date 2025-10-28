<?php
$conn = mysqli_connect("localhost", "root", "", "dbnnk");
if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: ", mysqli_connect_error();
    exit();
}
class Database {
    public $conn;

    public function __construct() {
        $this->conn = mysqli_connect("localhost", "root", "", "dbnnk");

        if (mysqli_connect_error()) {
            echo "Failed to connect to MySQL: ", mysqli_connect_error();
            exit();
        }
    }

    public function getData_flower() {
        $item = "SELECT * FROM tblflower WHERE Item_category='Flower'";
        $result = mysqli_query($this->conn, $item);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return null;
        }
    }

    public function getData_headband() {
        $item = "SELECT * FROM tblflower WHERE Item_category='Headband'";
        $result = mysqli_query($this->conn, $item);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return null;
        }
    }

    public function getData_keychain() {
        $item = "SELECT * FROM tblflower WHERE Item_category='Keychain'";
        $result = mysqli_query($this->conn, $item);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return null;
        }
    }

    public function getData_bag() {
        $item = "SELECT * FROM tblflower WHERE Item_category='Bag'";
        $result = mysqli_query($this->conn, $item);
        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return null;
        }
    }


    public function __destruct() {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }
}
?>


