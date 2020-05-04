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


<table style="width:100%">
  <tr>
    <th>Org</th>
    <th>Nama_acara</th>
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
      <td><?php echo $data['Org']; ?></td>
      <td><?php echo $data['nama_acara']; ?></td>
      <td><?php echo $data['tanggal']; ?></td>
      <td><?php echo $data['hari']; ?></td>
      <td><?php echo $data['waktu_mulai']; ?></td>
      <td><?php echo $data['waktu_selesai']; ?></td>
      <td><?php echo $data['sent']; ?></td>
    </tr>
    <?php
  }
  ?>
</table><br>
<button type="button" onclick="alert('Hello world!')">Click Me!</button>
</body>
</html>
