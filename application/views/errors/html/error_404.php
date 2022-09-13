<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?= APP_NAME ?> Dashboard</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_URL ?>assets/admin/imgs/theme/favicon.svg" />
        <!-- Template CSS -->
        <link href="<?= BASE_URL ?>assets/admin/css/main.css?v=1.1" rel="stylesheet" type="text/css" />
    </head>

    <body>
      
        <main class="">
            
            <section class="content-main">
                <div class="row mt-60">
                    <div class="col-sm-12">
                        <div class="w-50 mx-auto text-center">
                            <img src="<?= BASE_URL ?>assets/admin/imgs/theme/404.png" width="350" alt="Page Not Found" />
                            <h3 class="mt-40 mb-15">Oops! Page not found</h3>
                            <p>It's looking like you may have taken a wrong turn. Don't worry... it happens to the best of us. Here's a little tip that might help you get back on track.</p>
                            <a href="<?= BASE_URL ?>" class="btn btn-primary mt-4"><i class="material-icons md-keyboard_return"></i> Back to main</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- content-main end// -->
            <footer class="main-footer font-xs">
                <div class="row pb-30 pt-15">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                              &copy; <a target="_blank" href="https://nexcode.in/" class="link">Nexcode</a> -<?= APP_NAME ?> Admin portal .

                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end">All rights reserved</div>
                    </div>
                </div>
            </footer>
        </main>

        <script src="<?= BASE_URL ?>assets/admin/js/vendors/jquery-3.6.0.min.js"></script>
        <script src="<?= BASE_URL ?>assets/admin/js/vendors/bootstrap.bundle.min.js"></script>
        <script src="<?= BASE_URL ?>assets/admin/js/vendors/select2.min.js"></script>
        <script src="<?= BASE_URL ?>assets/admin/js/vendors/perfect-scrollbar.js"></script>
        <script src="<?= BASE_URL ?>assets/admin/js/vendors/jquery.fullscreen.min.js"></script>
        <!-- Main Script -->
        <script src="<?= BASE_URL ?>assets/admin/js/main.js?v=1.1" type="text/javascript"></script>
    </body>
</html>
