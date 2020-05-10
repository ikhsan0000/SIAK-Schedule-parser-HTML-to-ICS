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
  $link = pg_connect("host=localhost dbname=scheduie user=postgres password=admin");
  //check connection
  if($link === false){
      die("ERROR: Could not connect. " . "Error");

  }
  ?>

<table style="width:100%">
  <tr>
    <th>Org</th>
    <th>Nama_acara</th>
    <th>Deskripsi</th>
    <th>Tanggal</th>
    <th>Hari</th>
    <th>waktu_mulai</th>
    <th>waktu_selesai</th>
    <th>Sent</th>
    <th>Send Button</th>
    <th>ID</th>
  </tr>
  <?php
  $init = pg_query("SELECT * FROM acara");
  while ($data = pg_fetch_assoc($init))
  {
    ?>
    <tr>
      <td><?php echo $data['org']; ?></td>
      <td><?php echo $data['nama_acara']; ?></td>
      <td><?php echo $data['deskripsi']; ?></td>
      <td><?php echo $data['tanggal']; ?></td>
      <td><?php echo $data['hari']; ?></td>
      <td><?php echo $data['waktu_mulai']; ?></td>
      <td><?php echo $data['waktu_selesai']; ?></td>
      <td><?php echo $data['sent'];
          if($data['sent'] == 0){echo "FALSE";}else{echo "TRUE";}?></td>
	         <td><button type="button" onclick="alert('Email has been sent!')">Send!</button></td>
      <td><?php echo $data['id']; ?></td>
    </tr>
    <?php
  }
  ?>
</table><br>
<button type="button" onclick="alert('Email has been sent!')">Send Email!</button>
</body>
</html>
