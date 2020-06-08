<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
</head>
<body>
<?php
/* Attempt to connect to database */
require_once "config_database.php";

?>

<table style="width:100%">
  <tr>
	<th>Id</th>
    <th>Org</th>
    <th>Nama_acara</th>
	<th>Deskripsi</th>
    <th>Tanggal</th>
    <th>Hari</th>
    <th>waktu_mulai</th>
    <th>waktu_selesai</th>
    <th>Sent</th>
  </tr>
  <?php
  $init = pg_query("SELECT * FROM acara");
  while ($data = pg_fetch_assoc($init))
  {
    ?>
    <tr>
	  <td><?php echo $data['id']; ?></td>
      <td><?php echo $data['org']; ?></td>
      <td><?php echo $data['nama_acara']; ?></td>
	  <td><?php echo $data['deskripsi']; ?></td>
      <td><?php echo $data['tanggal']; ?></td>
      <td><?php echo $data['hari']; ?></td>
      <td><?php echo $data['waktu_mulai']; ?></td>
      <td><?php echo $data['waktu_selesai']; ?></td>
      <td><?php $data['sent']; 
	  if($data['sent'] == 0){echo "FALSE";}else{echo "TRUE";}?></td>
	  <td>
		<form action="send_one_event.php" method="POST">
			<button type="submit" name="id" value="<?php echo $data['id'];?>">Send !</button> <!-- ganti data yang diecho jadi ID series (blm ada di table)  -->
		</form>
	  </td>
    </tr>
    <?php
  }
  
  
  ?>
</table><br>
	<form action="send_all_event.php" method="POST">
	<button type="submit" >Send Email to All!</button>
	</form>
</body>
</html>

