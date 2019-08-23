<style>
#box_bawah{width: 100%;}
@media (min-width: 768px) {
  #box_bawah{width: 220px;}
}
</style>

<div style="clear: both"></div>
<div class="container">

<div class="col-xl-12 content-box ">
    <div class="row row-featured">

                <?php
                $this->db->order_by('id', 'RANDOM');
                $this->db->limit(10);
                $v_data = $this->db->get('tbl_app');
                foreach ($v_data->result() as $key => $baris):
                  $link_kat = 'd/'.$baris->url;
                  $toko = '';
                  $jml_foto = '';?>
                  <div id="box_bawah">
                    <div class="item-list">
                      <div class="cornerRibbons topAds">
                          <!-- <a href="#"> Top Ads</a> -->
                      </div>
                      <div class="row">
                          <div class="col-md-12 no-padding photobox">
                              <div class="add-image"><span class="photo-count"><i class="fa fa-camera"></i> <?php echo $jml_foto; ?> </span>
                                <a href="<?php echo $link_kat; ?>"><img class="thumbnail no-margin" src="images/app/<?php echo $baris->img; ?>" title="<?php echo ucwords($baris->nama_app); ?>" alt="<?php echo ucwords($baris->nama_app); ?>" width="50" height="100"></a>
                              </div>
                          </div>
                      <!--/.photobox-->
                          <div class="col-sm-12 add-desc-box">
                              <div class="ads-details">
                                  <h5 class="add-title" style="height:60px;">
                                    <a href="<?php echo $link_kat; ?>"> <?php echo substr($baris->nama_app,0,46); ?> </a>
                                  </h5>
                                  <span class="info-row">
                                    <!-- <span class="add-type business-ads tooltipHere" data-toggle="tooltip" data-placement="right" title="Business Ads"> </span> -->
                                    <span class="date"><i class=" icon-clock"> </i> <?php echo date('d/m/Y', strtotime($baris->tanggal)); ?> </span> -
                                    <span class="category"><?php echo substr($baris->kode_app,0,46); ?> </span>-
                                    <span class="item-location"><i class="fa fa-map-marker"></i> <?php echo substr($toko,0,46); ?> </span> </span></div>
                          </div>
                      <!--/.add-desc-box-->
                          <div class="col-md-12 text-right  price-box">
                              <h2 class="item-price"> Rp. <?php echo number_format($baris->harga,0,",","."); ?> </h2>
                              <!-- <a class="btn btn-danger  btn-sm make-favorite"> <i class="fa fa-certificate"></i> <span>Top Ads</span> </a>  -->
                              <a href="<?php echo $link_kat; ?>" class="btn btn-default  btn-sm make-favorite"> <i class="fa fa-heart"></i> <b>Beli</b> </a>
                          </div>
                      <!--/.add-desc-box-->
                        </div>
                    </div>
                  </div>
                <?php endforeach; ?>

    </div>
</div>

</div>
