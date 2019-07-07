 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1>
    Nilai update
  </h1>
</section> 

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title"> Upload nilai</h3>

        <div class="box-tools pull-right">
            <?= anchor('nilai/result/'.$kd_mapel,'<i class="fa fa-list-ol"></i>',array('type'=>'button', 'class'=>'btn btn-box-tool', 'data-widget'=>'back', 'data-toggle'=>'tooltip', 'title'=>'Hasil' )); ?>
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
        </div>   
        <div class="box-body">
            
            <!-- form start -->
            <?php
            $atribut_form = array(
                'class' => 'form-horizontal form-label-left',
                'enctype' => 'multipart/form-data',
                'novalidate'=> '',  
                'data-parsley-validate'=>''
                );
                echo form_open('nilai/form_u', $atribut_form);
            ?>        
            <div class="form-group col-md-12">
              <div class="col-sm-4">
                  <input type="file" name="file">
              </div>
              <input type="hidden" value="<?= $kd_mapel ?>" name="kdmapel">
              <div class="col-sm-8">
                <button type="submit" name="preview" class="btn btn-info btn-xm" onclick="return konfirmasi_tambah();"><i class="fa fa-eye"></i> Preview</button>
                <a href="<?= base_url() ?>download/SAMPLE-NILAI.xlsx" class="btn btn-success btn-xm">Download Format</a>
                <a href="<?= base_url()."nilai/upd_m/".$kd_mapel ?>" class="btn btn-warning btn-xm">Edit manual</a>
                <?php 
                $back = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
                echo anchor($back,'<i class="fa fa-share"></i> KEMBALI',array('class'=>'btn btn-danger btn-xm'));
                ?>              
                </div>
            </div>
        </div>
    </div>
</section>