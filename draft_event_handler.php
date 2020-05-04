<?php
/* Attempt to connect to database */
$link = pg_connect("host=localhost dbname=scheduie user=postgres password=120399");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . "Error");

}

	
	$kueri = "SELECT a.id, b.nama, a.hari, a.waktu_mulai, a.waktu_selesai FROM jadwal a RIGHT JOIN user_list b ON a.id = b.id";
	$kueri2 = pg_query($kueri)or die (error);
	while ($row = pg_fetch_assoc($kueri2))
	{
		if($row['id'] == 1706985981)
		{
			echo $row['id'];
			echo "<br>";
		}
	}
	
	echo "<br>";
	echo "<br>";
	echo "<br>";
	
	$kueri_row = "SELECT * FROM user_list";
	$count_row = pg_query("SELECT COUNT(1) FROM user_list");
	$total_row = pg_fetch_row($count_row);
	$total_row = $total_row[0];
	$execute = pg_query($kueri_row);
	

	echo $total_row;
	echo "<br>";
	
	$kueri_e = "SELECT * FROM acara";
	$execute_e = pg_query($kueri_e);
	while($row_e = pg_fetch_assoc($execute_e))
	{
		$hari_event = $row_e['hari'];
		$nama_event = $row_e['nama_acara'];
		$e_mulai = $row_e['waktu_mulai'];
		$e_selesai = $row_e['waktu_selesai'];
		echo "<br>";
		echo $nama_event;
		echo "<br>";
		echo $hari_event;
		echo "<br>";
		echo $e_mulai;
		echo "<br>";
		echo $e_selesai;
		echo "<br>";
		echo "<br>";
		
		while($row2 = pg_fetch_assoc($execute))
		{
			//if($row2['id'] == 1706043046)
			//{
				$current_user = $row2['id'];
				$current_name = $row2['nama'];
				$kueri_row2 = "SELECT a.id, b.nama, b.email, a.hari, a.waktu_mulai, a.waktu_selesai FROM jadwal a RIGHT JOIN user_list b ON a.id = b.id WHERE a.id = '$current_user'";
				$execute2 = pg_query($kueri_row2);
				echo "nama: ";
				echo $current_name;
				echo "<br>";
				echo "email: ";
				echo $row2['email'];
				echo "<br>";
				while($row3 = pg_fetch_row($execute2))
				{
					$hari_matkul = $row3[3];
					echo "hari: ";
					echo $hari_matkul;
					echo "<br>";
					echo "jam mulai: ";
					$k_mulai = $row3[4];
					echo $row3[4];
					echo "<br>";
					echo "jam selesai: ";
					$k_selesai= $row3[5];
					echo $row3[5];
					echo "<br>";
					
					$flag_passed = 0;
					
					if($e_mulai < $k_mulai && $e_selesai < $k_mulai)
					{
						if($e_mulai < $k_selesai && $e_selesai < $k_selesai)
						{
							$flag_passed = 1;
						}
					}
					
					if($e_mulai > $k_mulai && $e_selesai > $k_mulai)
					{
						if($e_mulai > $k_selesai && $e_selesai > $k_selesai)
						{
							$flag_passed = 1;
						}
					}
					

				}
					if($flag_passed == 1)
					{
						//block kirim email disini
						echo $current_name;
						echo " IS VALID TO SEND";
						echo "<br>";
						echo "<br>";
					}
				
				
			//}
			
			
		}
		pg_result_seek($execute,0);
		pg_result_seek($execute2,0);
	}
	echo "<br>";
	
?>

