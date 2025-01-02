<?php include '../backend/conn.php';

$customer_id = $_REQUEST['c_id'];

$sql ="SELECT * FROM vehicle WHERE customer_id = '$customer_id'";
$rs = $conn->query($sql);
?>
<label for="">Customer Vehicle</label>
<select class="form-control" name="vehicle_id">
<?php
if($rs->num_rows > 0){
  while($row = $rs->fetch_assoc()){
?>
  <option value="<?= $row['vehicle_id'] ?>"><?= $row['vehicle_type'] ?> (<?= $row['number_plate'] ?>)</option>
<?php } }else{ ?>
  <option value="">Vehicle Not Available Please add</option>
<?php } ?>
</select>
