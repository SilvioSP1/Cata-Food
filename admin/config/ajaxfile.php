<?php
include "dbcon.php";
 
$userid = $_POST['userid'];
 
$sql = "select * from producto where Prod_Id=".$userid;
$result = mysqli_query($conn,$sql);
while( $row = mysqli_fetch_array($result) ){
?>
<table border='0' width='100%'>
<tr>
    <td width="300"><img src="images/<?php echo $row['Prod_Imagen']; ?>">
    <td style="padding:20px;">
    <p>Nombre <?php echo $row['Prod_Nombre']; ?></p>
    <p>Descripción<?php echo $row['Prod_Descripcion']; ?></p>
    <p>Precio:<?php echo $row['Prod_Precio']; ?></p>
    </td>
</tr>
</table>
 
<?php } ?>