<!--=================================
footer-->
<footer class="footer bg-light">
 
  
  <div class="footer-bottom bg-dark mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ">
          <div class="d-flex justify-content-md-start justify-content-center">
            <ul class="list-unstyled d-flex mb-0">
              <li><a href="<?= base_url() ?>assets/users/#">Privacy Policy</a></li>
              <li><a href="<?= base_url() ?>assets/users/about.html">About</a></li>
              <li><a href="<?= base_url() ?>assets/users/#">Team</a></li>
              <li><a href="<?= base_url() ?>assets/users/contact-us.html">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 text-center text-md-end mt-4 mt-md-0">
          <p class="mb-0"> &copy;Copyright <span id="copyright">
              <script>
                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
              </script>
            </span> <a href="<?= base_url() ?>assets/users/#"> Nexcode </a>-<?= APP_NAME ?> Admin portal . All Rights Reserved </p>

            <span> Page loaded in <?= page_speed() . ' seconds' ?> </span>


        </div>
      </div>
    </div>
  </div>
</footer>
<!--=================================
footer-->




<!--=================================
Back To Top-->
<div id="back-to-top" class="back-to-top">
  <i class="fas fa-angle-up"></i>
</div>
<!--=================================
Back To Top-->