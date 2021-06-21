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
    <th>Mail Sent</th>
    <th>Push Sent</th>
    <th>Send Mail</th>
    <th>Send Push</th>
  </tr>
  <?php
  $sql = "SELECT * FROM acara";
  $result = mysqli_query($link, $sql);
  while ($data = mysqli_fetch_assoc($result))
  {
    ?>
    <tr id="<?php echo $data['id']?>">
      <td class="row-data"><?php echo $data['id']; ?></td>
      <td class="row-data"><?php echo $data['Org']; ?></td>
      <td class="row-data"><?php echo $data['Nama_acara']; ?></td>
      <td class="row-data"><?php echo $data['Deskripsi']; ?></td>
      <td class="row-data"><?php echo $data['Tanggal']; ?></td>
      <td class="row-data"><?php echo $data['Hari']; ?></td>
      <td class="row-data"><?php echo $data['Waktu_mulai']; ?></td>
      <td class="row-data"><?php echo $data['Waktu_selesai']; ?></td>
      <td class="row-data"><?php if($data['Sent'] == 0){echo "FALSE";}else{echo "TRUE";}?></td>
      <td class="row-data"><?php if($data['push_sent'] == 0){echo "FALSE";}else{echo "TRUE";}?></td>
      <td>
        <form action="debug_send_one_event.php" method="POST">
        <input type="hidden" name="targetAudienceMail" value="<?php echo $data['Target_Audience'] ?>" readonly>
        <button type="submit" name="id" value="<?php echo $data['id'];?>">Send !</button>
        </form>
      </td>
      <td>
        <form action="send_one_push.php" method="post">
        <!-- <input type="hidden" id="namaAcara" name="namaAcara">
        <input type="hidden" id="deskripsi" name="deskripsi">
        <input type="hidden" id="waktuMulai" name="waktuMulai">
        <input type="hidden" id="waktuSelesai" name="waktuSelesai"> -->
        <input type="hidden" id="targetAudience" name="targetAudience" value="<?php echo $data['Target_Audience'] ?>" readonly>
        <button type="submit" class="btn-lg btn-block btn-dark" value="<?php echo $data['id'];?>" name="eIdPush" id="send-push" onclick="show()">Send Push</button>
        </form>
      </td>
      <!-- <td>
        <form action="push/pushAction.php">
          <button type="submit" class="btn-lg btn-block btn-dark" value="submit" onclick="show()">test Push</button>
        </form>
      </td> -->
    </tr>
  <?php
  }
  ?>

</table><br>
	<form action="debug_send_all_event.php" method="POST">
	<button type="submit" >Send Email to All!</button>
	</form>

  <script src="app.js">
  </script>

  <script>
     function show() 
    {
      var rowId = event.target.parentNode.parentNode.parentNode.id;
      //this gives id of tr whose button was clicked
      var data = document.getElementById(rowId).querySelectorAll(".row-data"); 
      /*returns array of all elements with 
      "row-data" class within the row with given id*/

      var acara = data[2].innerHTML;
      var deskripsi = data[3].innerHTML;
      var waktuMulai = data[6].innerHTML;
      var waktuSelesai = data[7].innerHTML;

      document.cookie = "namaAcara=" + acara + ";expires=Fri, 31 Dec 9999 23:59:59 GMT;secure";
      document.cookie = "deskripsi=" + deskripsi + ";expires=Fri, 31 Dec 9999 23:59:59 GMT;secure";
      document.cookie = "waktuMulai=" + waktuMulai + ";expires=Fri, 31 Dec 9999 23:59:59 GMT;secure";
      document.cookie = "waktuSelesai=" + waktuSelesai + ";expires=Fri, 31 Dec 9999 23:59:59 GMT;secure";

      // document.getElementById("namaAcara").value = acara; 
      // document.getElementById("deskripsi").value = deskripsi; 
      // document.getElementById("waktuMulai").value = waktuMulai; 
      // document.getElementById("waktuSelesai").value = waktuSelesai; 
      console.log(acara);
    }
  </script>
</body>
</html>

