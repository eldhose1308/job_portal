<!DOCTYPE html>
<html lang="en">

<head>

  <title><?= APP_NAME ?> | Home</title>

  <!-- meta -->
  <?php echo @$_meta; ?>

  <!-- css -->
  <?php echo @$_css; ?>

  <constants data-base="<?= base_url() ?>" />

  <div class="internet-connection-status" id="internetStatus" style="display: block;"></div>


  <script src="<?= base_url() ?>assets/users/scripts/common.js"></script>


</head>

<body>

  <div class="bs-canvas-overlay bs-canvas-anim bg-dark position-fixed w-100 h-100"></div>

  <div id="loader-overlay">
    <center>
      <div id="circular-progressbar" class="progress-circle over50 p100">
        <span id="circular-progress-value">100%</span>
        <div class="left-half-clipper">
          <div class="first50-bar"></div>
          <div class="value-bar"></div>
        </div>
      </div>
    </center>
  </div>

  <!-- preloader -->
  <?php echo @$_preloader;
  ?>


  <div class="screen-overlay"></div>


  <!-- sidebar -->
  <?php echo @$_sidebar;
  ?>



  <main class="main-wrap">

    <!-- navbar -->
    <?php echo @$_navbar;
    ?>

    <!-- message -->
    <?php echo @$_message; ?>

    <!-- content -->
    <?php echo @$_content; ?>
    <!-- mainContent -->




    <!-- footer -->
    <?php echo @$_footer;
    ?>
  </main>


  <!-- js -->
  <?php echo @$_js; ?>



</body>

</html>