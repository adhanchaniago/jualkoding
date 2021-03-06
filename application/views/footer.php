<?php
$ceks = $this->session->userdata('un_member'); ?>

<?php
$ip      = $_SERVER['REMOTE_ADDR']; // Dapatkan IP user
$tanggal = date("Ymd"); // Dapatkan tanggal sekarang
$waktu   = time(); // Dapatkan nilai waktu

// Cek user yang mengakses berdasarkan IP-nya
$s = $this->db->query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
// Kalau belum ada, simpan datanya sebagai user baru
if($s->num_rows() == 0){
	$this->db->query("INSERT INTO statistik(ip, tanggal, hits, online) VALUES('$ip', '$tanggal', '1', '$waktu')");
}
// Kalau sudah ada, update data hits user
else{
	$this->db->query("UPDATE statistik SET hits=hits+1, online='$waktu' WHERE ip='$ip' AND tanggal='$tanggal'");
}

$query1     = $this->db->query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip");
$pengunjung = $query1->num_rows();

$query2        = $this->db->query("SELECT COUNT(hits) as total FROM statistik");
$hasil2        = $query2->row();
$totpengunjung = $hasil2->total;

$query3 = $this->db->query("SELECT SUM(hits) as jumlah FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal");
$hasil3 = $query3->row();
$hits   = $hasil3->jumlah;

$query4  = $this->db->query("SELECT SUM(hits) as total FROM statistik");
$hasil4  = $query4->row();
$tothits = $hasil4->total;

// Cek berapa pengunjung yang sedang online
$bataswaktu       = time() - 300;
$pengunjungonline = $this->db->query("SELECT * FROM statistik WHERE online > '$bataswaktu'")->num_rows();

// Angka total pengunjung dalam bentuk gambar
$folder = "images/counter"; // nama folder
$ext    = ".png";     // ekstension file gambar

// ubah digit angka menjadi enam digit
// $totpengunjung = 7891099;
$totpengunjunggbr = sprintf("%06d", $totpengunjung);
// ganti angka teks dengan angka gambar
$awal=2; $awal2=0;
for ($i = 0; $i <= 9; $i++){ ?>
 <style>#v_counter_<?php echo $i; ?>{width:25px; height:25px; background:url(<?php echo $folder; ?>/counter.png) -<?php echo $awal; ?>px;margin-top: -6px;}</style>
 <?php
 $awal=$awal+23.9;
 $img_new="<img src=\"$folder/n.gif\" alt=\"$i\" id='v_counter_$i'>";
 $totpengunjunggbr = str_replace($i, $img_new, $totpengunjunggbr);
}
?>

<div class="page-bottom-info">
		<div class="page-bottom-info-inner">

				<div class="page-bottom-info-content text-center">
						<h1>Jika Anda memiliki pertanyaan, komentar atau masalah, silahkan hubungi kami</h1>
						<a class="btn  btn-lg btn-primary-dark" href="tel:<?php echo $this->Mcrud->get_web('no_hp'); ?>">
								<i class="icon-mobile"></i> <span class="hide-xs color50">No. HP/WA:</span> <?php echo $this->Mcrud->get_web('no_hp'); ?> </a>
				</div>

		</div>
</div>

<footer class="main-footer">
  <div class="footer-content">
    <div class="container">
      <div class="row">

        <div class=" col-xl-3  ">
          <div class="footer-col">
            <h4 class="footer-title" style="margin-bottom:-20px;"><?php echo "$totpengunjunggbr"; ?></h4>
						 <hr style="margin-bottom:5px;">
						 <style>
				 			#text-pengunjung{color:#222;}
				 			#hariini {width:14px; height:14px; background:url(<?php echo "$folder/icon_statistik.png"; ?>) 0 0px;}
				 			#total {width:14px; height:14px; background:url(<?php echo "$folder/icon_statistik.png"; ?>) -15px;}
				 			#online {width:14px; height:14px; background:url(<?php echo "$folder/icon_statistik.png"; ?>) -30px;}
				 		</style>
				 		<?php
				 		echo "
				 				<img id='hariini' src='$folder/n.gif'> <span id='text-pengunjung'>Pengunjung hari ini : $pengunjung </span> <br>
				 				<img id='total' src='$folder/n.gif'> <span id='text-pengunjung'>Total pengunjung    : $totpengunjung </span> <br>
				 				<img id='hariini' src='$folder/n.gif'> <span id='text-pengunjung'>Hits hari ini  :  $hits </span> <br>
				 				<img id='total' src='$folder/n.gif'> <span id='text-pengunjung'>Total hits     :  $tothits </span> <br>

				 				<img id='online' src='$folder/n.gif'> <span id='text-pengunjung'>Pengunjung Online : $pengunjungonline</span>";
				 		 ?>
          </div>
          <br><br>

          <!-- Histats.com  (div with counter) --><div id="histats_counter"></div>
            <!-- Histats.com  START  (aync)-->
            <script type="text/javascript">var _Hasync= _Hasync|| [];
            _Hasync.push(['Histats.start', '1,4308939,4,605,110,55,00011111']);
            _Hasync.push(['Histats.fasi', '1']);
            _Hasync.push(['Histats.track_hits', '']);
            (function() {
            var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
            hs.src = ('//s10.histats.com/js15_as.js');
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
            })();</script>
            <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?4308939&101" alt="invisible hit counter" border="0"></a></noscript>
            <!-- Histats.com  END  -->

        </div>

        <div class=" col-xl-3 ">
          <div class="footer-col">
            <h4 class="footer-title" style="margin-bottom:-20px;">Bantuan & Kontak Kami</h4>
						<hr style="margin-bottom:5px;">
            <ul class="list-unstyled footer-nav">
              <li>
                <a href="panduan.html">Panduan</a>
              </li>
							<li>
                <a href="hubungi.html">Kontak</a>
              </li>
            </ul>
          </div>
        </div>

        <div class=" col-xl-3  ">
          <div class="footer-col">
            <h4 class="footer-title" style="margin-bottom:-20px;">Akun</h4>
						<hr style="margin-bottom:5px;">
            <ul class="list-unstyled footer-nav">
              <?php if(isset($ceks)){?>
              <li>
                <a href="member"> Panel</a>
              </li>
              <li>
                <a href="logout"> logout</a>
              </li>
            <?php }else{ ?>
              <li>
                <a href="login"> login</a>
              </li>
              <li>
                <a href="pendaftaran"> Pendaftaran</a>
              </li>
            <?php } ?>
            </ul>
          </div>
        </div>
        <div class=" col-xl-3 ">
          <div class="footer-col row">
            <div class="col-sm-12 col-xs-6 col-xxs-12 no-padding-lg">
              <div class="mobile-app-content">
                <h4 class="footer-title" style="margin-bottom:-20px;">Ikuti Kami</h4>
								<hr>
                <ul class="list-unstyled list-inline footer-nav social-list-footer social-list-color footer-nav-inline">
                  <li><a class="icon-color fb" title="Facebook" data-placement="top" data-toggle="tooltip" href="#"><i class="fa fa-facebook"></i> </a></li>
                  <li><a class="icon-color tw" title="Twitter" data-placement="top" data-toggle="tooltip" href="#"><i class="fa fa-twitter"></i> </a></li>
                  <li><a class="icon-color gp" title="Google+" data-placement="top" data-toggle="tooltip" href="#"><i class="fa fa-google-plus"></i> </a></li>
                  <li><a class="icon-color lin" title="Linkedin" data-placement="top" data-toggle="tooltip" href="#"><i class="fa fa-linkedin"></i> </a></li>
                  <li><a class="icon-color pin" title="Linkedin" data-placement="top" data-toggle="tooltip" href="#"><i class="fa fa-pinterest-p"></i> </a></li>
                </ul>
              </div>

            </div>
          </div>
        </div>
        <div style="clear: both"></div>

        <div class="col-xl-12">
          <div class=" text-center paymanet-method-logo">
            <img src="assets/images/site/payment/master_card.png" alt="img">
            <img alt="img" src="assets/images/site/payment/visa_card.png">
            <img alt="img" src="assets/images/site/payment/paypal.png">
            <img alt="img" src="assets/images/site/payment/american_express_card.png"> <img alt="img" src="assets/images/site/payment/discover_network_card.png">
            <img alt="img" src="assets/images/site/payment/google_wallet.png">
          </div>
          <div class="copy-info text-center">
            &copy; <?php echo date('Y'); ?> <?php echo $this->Mcrud->nama_app(); ?>. All Rights Reserved.
          </div>

        </div>

      </div>
    </div>
  </div>
</footer>

  </div>
  <!-- /.wrapper -->
  <!-- Placed at the end of the document so the pages load faster -->

  <script src="assets/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/fancybox/jquery.fancybox.js"></script>
  <script src="assets/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/vendors.min.js"></script>

  <!-- include custom script for site  -->
  <script src="assets/js/script.js"></script>

	<script src="assets/plugins/bxslider/jquery.bxslider.min.js"></script>
	<script>
	    $('.bxslider').bxSlider({
	        pagerCustom: '#bx-pager'
	    });

			function convertToSlug(Text)
			{
			    return Text
			        .toLowerCase()
			        .replace(/[^\w ]+/g,'')
			        .replace(/ +/g,'-')
			        ;
			}

	function cari_app() {
	  window.location.href='app?p='+convertToSlug($('[name="txtcari"]').val());
	}

	$(document).ready(function() {
		 //datatables
		 table = $('#myTable').DataTable({
			 	 "pageLength": 50,
				 "processing": true, //Feature control the processing indicator.
				 "serverSide": true, //Feature control DataTables' server-side processing mode.
				 "order": [], //Initial no order.

				 // Load data for the table's content from an Ajax source
				 "ajax": {
						 "url": "<?php echo site_url('member/ajax_list')?>",
						 "type": "POST"
				 },

				 //Set column definition initialisation properties.
				 "columnDefs": [
				 {
						 "targets": [ 0 ], //first column / numbering column
						 "orderable": false, //set not orderable
				 },
				 ],

		 });

	});
	</script>

</html>
