<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Mata pelajaran
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar mapel</h3>

      <div class="box-tools pull-right">
        <?= anchor('mapel/add', '<i class="fa fa-plus-square"></i>', 'class="btn btn-box-tool" data-toggle="tooltip" title="Tambah Data"'); ?>
        <?= anchor('mapel/upl', '<i class="fa fa-upload"></i>', 'class="btn btn-box-tool" data-toggle="tooltip" title="Upload Data"'); ?>
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div> 
    <div class="box-body">
      <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th>No.</th>
              <th>KODE MAPEL</th>
              <th>NAMA MAPEL</th>
              <th>AKSI</th>
            </tr>
        </thead>
      </table>
    </div>
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.0/jquery.dataTables.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.js"></script>  -->

<script>
    $(document).ready(function() {
        var t = $('#mytable').DataTable( {
            "ajax": '<?php echo site_url('mapel/data'); ?>',
            "order": [[ 2, 'asc' ]],
            "columns": [
                { 
                  "data"     : null,
                  "width"    : "50px",
                  "sClass"   : "text-center",
                  "orderable": false
                },
                { 
                  "data"  : "kd_mapel",
                  "width" : "120px",
                  "sClass": "text-center"
                },
                { "data" : "nama_mapel" },
                { 
                  "data" : "aksi",
                  "width" : "120px",
                  "sClass": "text-center"
                }
            ]
        } );
            
        t.on( 'order.dt search.dt', function () {
            t.column(0, {search : 'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    } );
</script>
<!-- Custom Konfirmasi -->
<script src="<?php echo base_url(); ?>assets/bower_components/konfirmasi/js/konfirmasi_hapus.js"></script>