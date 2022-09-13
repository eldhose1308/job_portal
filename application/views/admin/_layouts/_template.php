<!DOCTYPE html>
<html lang="en">

<head>

  <title><?= APP_NAME ?> | Dashboard</title>

  <!-- meta -->
  <?php echo @$_meta; ?>

  <!-- css -->
  <?php echo @$_css; ?>

  <constants data-base="<?= base_url() ?>">

    <div class="internet-connection-status" id="internetStatus" style="display: block;"></div>


    <script src="<?= base_url() ?>assets/admin/scripts/common.js"></script>


</head>

<body>


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