 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1>
    Mapel
  </h1>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title"> Upload mapel</h3>

        <div class="box-tools pull-right">
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
                echo form_open('mapel/form', $atribut_form);
            ?>        
            <div class="form-group col-md-12">
              <div class="col-sm-4">
                  <input type="file" name="file">
              </div>
              <div class="col-sm-8">
                <button type="submit" name="preview" class="btn btn-info btn-xm" onclick="return konfirmasi_tambah();"><i class="fa fa-eye"></i> Preview</button>
                <?php 
                $back = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
                echo anchor($back,'<i class="fa fa-share"></i> KEMBALI',array('class'=>'btn btn-danger btn-xm'));
                ?>              
                </div>
            </div>
        </div>
    </div>
</section>