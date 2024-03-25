<?php
$servername = "localhost";
$username = "root";
$password = "root"; 
$dbname = "exam";


$conn = new mysqli($servername, $username, $password, $dbname);
/*ALTER TABLE NHANVIEN
ADD CONSTRAINT fk_ma_phong
FOREIGN KEY (Ma_Phong) 
REFERENCES PHONGBAN(Ma_Phong);
*/

?>