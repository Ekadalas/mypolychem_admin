<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('cover/header'); ?>
<style type="text/css">
	 .form-label {
      color: black;
    }

    .contente {
    margin-left: 55px; /* Memberi jarak pada konten utama agar tidak menutupi sidebar */
    padding: 0px;
    
    }
</style>
</head>
<body class="page-top">
	<div id="wrapper">
		<?php $this->load->view('cover/sidebar'); ?>

		 <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            	<?php $this->load->view('cover/topbar'); ?>
               <div class="contente">
               <div class="container-fluid">	
               	
            </div>    	
          </div>     	
        </div>
      </div>         	
	</div>
</body>
<?php $this->load->view('cover/footer'); ?>
</html>
              