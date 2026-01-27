<!DOCTYPE html>
<html lang="en">
     
      <?php include_once('connection.php'); ?>
       <?php include('Front/head.php');?>
    
    <body class="loading" data-layout-mode="horizontal">
        <div id="wrapper">
            <?php include('front/header.php');?>
            <?php include('front/sidebar.php');?>
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Extras Pages</a></li>
                                            <li class="breadcrumb-item active">Starter</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Starter</h4>
                                </div>
                            </div>
                        </div>                          
                    </div> 
                </div> 
            </div>
            <?php include('front/footer.php');?>
        </div>
         <?php include('front/script.php');?>
    </body>
</html>