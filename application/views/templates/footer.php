 <!-- Footer -->
 <footer class="sticky-footer bg-white">
     <div class="container my-auto">
         <div class="copyright text-center my-auto">
             <span>Copyright &copy; SIAP-<em>bayar </em><?= date('Y'); ?> <em class="badge badge-info"> beta</em> | Build by Salahul Bain</span>
         </div>
     </div>
 </footer>
 <!-- End of Footer -->

 </div>
 <!-- End of Content Wrapper -->

 </div>
 <!-- End of Page Wrapper -->

 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
     <i class="fas fa-angle-up"></i>
 </a>

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>
                 <a class="btn btn-danger" href="<?= base_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
             </div>
         </div>
     </div>
 </div>


 <!-- Bootstrap core JavaScript-->
 <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
 <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

 <!-- Page level plugins -->
 <script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>
 <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
 <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

 <!-- Page level custom scripts -->
 <script src="<?= base_url('assets/'); ?>js/demo/chart-area-demo.js"></script>
 <script src="<?= base_url('assets/'); ?>js/demo/chart-pie-demo.js"></script>
 <script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>

 <!-- api key untuk map -->
 <script src="https://maps.googleapis.com/maps/api/js?key=Your_API_Key&language=id&region=ID"></script>

 <script>
     $('.custom-file-input').on('change', function() {
         let fileName = $(this).val().split('\\').pop();
         $(this).next('.custom-file-label').addClass("selected").html(fileName);
     });
 </script>

 <script>
     $(document).ready(function() {
         $('#detailModal').on('show.bs.modal', function(e) {
             var nik = $(e.relatedTarget).data('id');
             $.ajax({
                 url: "<?= base_url('siswa/detail'); ?>",
                 type: 'post',
                 data: {
                     nik: nik
                 },
                 success: function(data) {
                     $('.fetched-data').html(data);
                 }
             });
         });
     });
 </script>

 <script>
     $(document).ready(function() {
         $('#hapusModal').on('show.bs.modal', function(e) {
             var nik = $(e.relatedTarget).data('id');
             $.ajax({
                 url: "<?= base_url('siswa/hapussiswa'); ?>",
                 type: 'post',
                 data: {
                     nik: nik
                 },
                 success: function(data) {
                     $('.fetched-data').html(data);
                 }
             });
         });
     });
 </script>


 <!-- script tampilkan map -->
 <script>
     function tampilDekat() {
         //  getCurLocation();

         map_dekat = new google.maps.Map(document.getElementById('map'), {
             zoom: <?= $map['zoom']; ?>,
             center: {
                 lat: <?= $map['default_lat']; ?>,
                 lng: <?= $map['default_lng']; ?>
             }
         });
     }

     $(function() {
         tampilDekat();
     })
 </script>
 <!-- ./script tampilkan map -->



 </body>

 </html>
