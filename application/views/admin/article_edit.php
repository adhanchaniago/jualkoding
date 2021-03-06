<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url() ?>panel_jualkoding" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
<div class="container-fluid">
  <div class="row-fluid">
    <?php
    echo $this->session->flashdata('msg');
    ?>
    <div class="widget-box">
      <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
        <h5>Input Article</h5>
      </div>
      <div class="widget-content nopadding">
        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="control-group">
            <label class="control-label">Judul :</label>
            <div class="controls">
              <input type="text" class="span11" name="judul" placeholder="Judul Article" value="<?php echo $article->judul; ?>" required/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Gambar :</label>
            <div class="controls">
              <input type="file" name="gambar" class="span11" placeholder="Gambar"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Isi :</label>
            <div class="controls">
              <textarea class="textarea_editor span11" name="isi" rows="6" placeholder="Isi ..." required><?php echo $article->isi; ?></textarea>
            </div>
          </div>
          <div class="form-actions">
            <a href="data_article" class="btn btn-default">Kembali</a>
            <button type="submit" name="btnsave" class="btn btn-success" style="float:right;">Update</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

<!--End-Action boxes-->


<!--end-main-container-part-->

<script type="text/javascript" src="assets/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
     tinymce.init({
          selector: ".textarea_editor",
          plugins: [
               "advlist autolink link image lists charmap print preview hr anchor pagebreak",
               "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking fullscreen",
               "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
         ],
         toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
         toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
         image_advtab: true ,
         
         external_filemanager_path:"assets/filemanager/",
         filemanager_title:"Responsive Filemanager" ,
         external_plugins: { "filemanager" : "<?php echo base_url() ?>assets/filemanager/plugin.min.js"}
     });

</script>