<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Siswa
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Siswa</h3>

      <div class="box-tools pull-right">
          <i class="fa fa-minus"></i></button>
      </div>
    </div> 
    <div class="box-body">
      <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th>No.</th>
              <th>NIS</th>
              <th>NAMA</th>
              <th>TEMPAT LAHIR</th>
              <th>TANGGAL LAHIR</th>
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
            "ajax": '<?php echo site_url('siswa/data_w'); ?>',
            "order": [[ 2, 'asc' ]],
            "columns": [
                { 
                  "data"     : null,
                  "width"    : "50px",
                  "sClass"   : "text-center",
                  "orderable": false
                },
                { 
                  "data"  : "nis",
                  "width" : "120px",
                  "sClass": "text-center"
                },
                { "data" : "nama" },
                { "data" : "temp_lahir" },
                { "data" : "tgl_lahir" },
                { "data" : "aksi" },
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