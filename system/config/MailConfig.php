<?php 
/**
* 
*/
class MailConfig {
	public static function bodyFirstPaymentNotificationMail($nama, $notrx, $nominal){
		$body = '<table style="width: 100%; max-width: 600px; margin: 0 auto;" border="0" cellspacing="0" cellpadding="0"> <tbody> <tr> <td style="text-align: left;" width="100%"><p><img src="'.UPLOAD.'/assets/header_email_small_center.png" alt="" width="600" height="58" /></p><p>Hi {nama}</p>
<p>Terima kasih sudah mengikuti program Cicilan Tiket Yovie And His Friends, <span style="font-size: 12pt;"><strong>No. transaksi Anda adalah #{notrx}</strong></span> silahkan melakukan pembayaran pertama sebesar <span style="font-size: 12pt;"><strong>Rp. {nominal},- </strong></span>melalui rekening sebagai berikut:</p>
<p><span style="font-size: 12pt;"><strong>Transfer BRI</strong></span><br /><span style="font-size: 12pt;"><strong>0206-01-007281-30-2</strong></span><br /><span style="font-size: 12pt;"><strong>a/n. Berlian Entertainment Indonesia, PT</strong></span><br /><span style="font-size: 12pt;"><strong>Cabang KCK1</strong></span><br /><span style="font-size: 12pt;"><strong>Note: masukkkan no transaksi pada berita transfer</strong></span></p>
<p>Konfirmasi pembayaran hanya bisa dilakukan melalui satu nomor Whatsapp di <span style="font-size: 12pt;"><strong>0813 8146 2556 (No Call)</strong></span>&nbsp;pada jam kerja <span style="font-size: 12pt;"><strong>Senin-Jumat pukul 11.00-18.00 WIB</strong></span>. Maksimal pembayaran ditunggu <span style="font-size: 12pt;"><strong>2 jam setelah email ini diterima</strong></span>.</p>
<p>Pembayaran yang dilakukan pada hari libur/weekend, akan kami proses pada hari kerja berikutnya.</p>
<p>Tanda terima pembayaran akan kami kirimkan melalui email setelah pembayaran yang pertama kami terima 1 x 24 jam.</p>
<p>Jika permbayaran yang kedua tidak dilakukan sampai tanggal <span style="font-size: 12pt;"><strong>5 September 2018</strong></span>, maka&nbsp;pembayaran pertama&nbsp;yang sudah masuk akan dianggap <span style="font-size: 12pt;"><strong>hangus</strong></span>.</p>
<p>&nbsp;</p>
<p>Terima kasih</p>
<p><strong>Berlian Entertainment</strong></p></td> </tr> </tbody> </table>';

		$body = str_replace("{nama}", $nama, $body);
		$body = str_replace("{notrx}", $notrx, $body);
		$body = str_replace("{nominal}", $nominal, $body);

		return $body;
	}

	public static function bodySecondPaymentNotificationMail($nama, $notrx, $nominal, $dueday, $willwait){
		$body = '<table style="width: 100%; max-width: 600px; margin: 0 auto;" border="0" cellspacing="0" cellpadding="0"> <tbody> <tr> <td style="text-align: left;" width="100%"><p><img src="'.UPLOAD.'/assets/header_email_small_center.png" alt="" width="600" height="58" /></p><p>Hi {nama}</p>
<p>Kami informasikan bahwa Program Cicilan Tiket Yovie And His Friends Anda dengan no. <span style="font-size: 12pt;"><strong>transaksi #{notrx}</strong></span> akan memasuki masa expired <strong>{dueday}</strong>. Silahkan melakukan pembayaran yang Kedua sebesar <strong>Rp. {nominal},- </strong>melalui rekening sebagai berikut:</p>
<p><span style="font-size: 12pt;"><strong>Transfer BRI</strong></span><br /><span style="font-size: 12pt;"><strong>0206-01-007281-30-2</strong></span><br /><span style="font-size: 12pt;"><strong>a/n. Berlian Entertainment Indonesia, PT</strong></span><br /><span style="font-size: 12pt;"><strong>Cabang KCK1&nbsp;</strong></span><br /><span style="font-size: 12pt;"><strong>Note: masukkan no transaksi pada berita transfer</strong></span></p>
<p>Konfirmasi pembayaran hanya bisa dilakukan melalui satu nomor Whatsapp di <span style="font-size: 12pt;"><strong>0813 8146 2556 (No Call)</strong></span> pada jam kerja <span style="font-size: 12pt;"><strong>Senin-Jumat pukul 11.00-18.00 WIB</strong></span>. Maksimal pembayaran ditunggu sampai dengan tanggal <span style="font-size: 12pt;"><strong>5 September 2018</strong></span>.</p>
<p>Pembayaran yang dilakukan pada hari libur/weekend, akan kami proses pada hari kerja berikutnya.</p>
<p>Tanda terima pembayaran akan kami kirimkan melalui email setelah pembayaran yang Kedua kami terima 1 x 24 jam.</p>
<p>Jika permbayaran yang kedua tidak dilakukan sampai&nbsp;tanggal 5 September 2018, maka pembayaran pertama yang sudah masuk akan dianggap <span style="font-size: 12pt;"><strong>hangus</strong></span>.</p>
<p>&nbsp;</p>
<p>Terima kasih</p>
<p>Berlian Entertainment</p></td> </tr> </tbody> </table>';

		$body = str_replace("{nama}", $nama, $body);
		$body = str_replace("{notrx}", $notrx, $body);
		$body = str_replace("{nominal}", $nominal, $body);
		$body = str_replace("{dueday}", $dueday, $body);
		$body = str_replace("{willwait}", $willwait, $body);

		return $body;
	}

	public static function bodyFirstPaymentAdminNotificationMail($date, $notrx, $deskripsi, $tiket, $amount, $nama, $email, $telp, $ktp){
		$body = '<table style="width: 100%; max-width: 600px; margin: 0 auto;" border="0" cellspacing="0" cellpadding="0"> <tbody> <tr> <td style="text-align: left;" width="100%"><p><img src="'.UPLOAD.'/assets/header_email_small_center.png" alt="" width="600" height="58" /></p><p>Hi Admin</p>
<p>Berikut request cicilan yang masuk di tanggal {date} dengan detail sebagai berikut:</p>
<ul>
<li>No Transaksi : {notrx}</li>
<li>Deskripsi : {deskripsi}</li>
<li>Pilihan jenis tiket : {tiket}</li>
<li>Total tagihan : {amount}</li>
<li>Nama : {nama}</li>
<li>Email : {email}</li>
<li>Telp : {telp}</li>
<li>KTP : {ktp}</li>
</ul>
<p><strong>Terima kasih,</strong></p>
<p><strong>Berlian Entertainment</strong></p></td> </tr> </tbody> </table>';

		$body = str_replace("{date}", $date, $body);
		$body = str_replace("{notrx}", $notrx, $body);
		$body = str_replace("{deskripsi}", $deskripsi, $body);
		$body = str_replace("{tiket}", $tiket, $body);
		$body = str_replace("{amount}", $amount, $body);
		$body = str_replace("{nama}", $nama, $body);
		$body = str_replace("{email}", $email, $body);
		$body = str_replace("{telp}", $telp, $body);
		$body = str_replace("{ktp}", $ktp, $body);

		return $body;
	}

	public static function bodySecondPaymentAdminNotificationMail($date, $notrx, $deskripsi, $tiket, $amount, $nama, $email, $telp, $ktp){
		$body = '<table style="width: 100%; max-width: 600px; margin: 0 auto;" border="0" cellspacing="0" cellpadding="0"> <tbody> <tr> <td style="text-align: left;" width="100%"><p><img src="'.UPLOAD.'/assets/header_email_small_center.png" alt="" width="600" height="58" /></p><p>Hi Admin</p>
<p>Berikut informasi program cicilan yang kedua pada tanggal {date} dengan detail sebagai berikut:</p>
<ul>
<li>No Transaksi : {notrx}</li>
<li>Deskripsi : {deskripsi}</li>
<li>Pilihan jenis tiket : {tiket}</li>
<li>Total tagihan : {amount}</li>
<li>Nama : {nama}</li>
<li>Email : {email}</li>
<li>Telp : {telp}</li>
<li>KTP : {ktp}</li>
</ul>
<p><strong>Terima kasih</strong></p>
<p><strong>Berlian Entertainment</strong></p></td> </tr> </tbody> </table>';

		$body = str_replace("{date}", $date, $body);
		$body = str_replace("{notrx}", $notrx, $body);
		$body = str_replace("{deskripsi}", $deskripsi, $body);
		$body = str_replace("{tiket}", $tiket, $body);
		$body = str_replace("{amount}", $amount, $body);
		$body = str_replace("{nama}", $nama, $body);
		$body = str_replace("{email}", $email, $body);
		$body = str_replace("{telp}", $telp, $body);
		$body = str_replace("{ktp}", $ktp, $body);

		return $body;
	}

	public static function bodyPaymentCompleteMail($notrx, $deskripsi, $tiket, $amount, $nama, $email, $telp, $ktp){
		$body = '<table style="width: 100%; max-width: 600px; margin: 0 auto;" border="0" cellspacing="0" cellpadding="0"> <tbody> <tr> <td style="text-align: left;" width="100%"><p><img src="'.UPLOAD.'/assets/header_email_small_center.png" alt="" width="600" height="58" /></p><p>Hi {nama}</p>
					<p>Terima kasih telah melakukan pembayaran <strong>Cicilan Tiket Yovie And His Friends</strong>. Berikut ini merupakan informasi transaksi yang telah Anda lakukan sebelumnya:</p>
					<ul>
					<li>No Transaksi : <strong>#{notrx}</strong></li>
					<li>Nama : <strong>{nama}</strong></li>
					<li>Email : <strong>{email}</strong></li>
					<li>Telp : <strong>{telp}</strong></li>
					<li>KTP : <strong>{ktp}</strong></li>
					<li>Deskripsi transaksi: <strong>{deskripsi}</strong></li>
					<li>Pilihan jenis tiket : <strong>{tiket}</strong></li>
					<li>Total tagihan :&nbsp;<strong>{amount}</strong></li>
					</ul>
					<p>Terima Kasih</p>
					<p><strong>Berlian Entertainment</strong></p></td> </tr> </tbody> </table>';

		$body = str_replace("{notrx}", $notrx, $body);
		$body = str_replace("{deskripsi}", $deskripsi, $body);
		$body = str_replace("{tiket}", $tiket, $body);
		$body = str_replace("{amount}", $amount, $body);
		$body = str_replace("{nama}", $nama, $body);
		$body = str_replace("{email}", $email, $body);
		$body = str_replace("{telp}", $telp, $body);
		$body = str_replace("{ktp}", $ktp, $body);

		return $body;
	}



}

?>