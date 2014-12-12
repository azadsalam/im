<?php $this->load->view('segments/head')?>
<?php $this->load->view('segments/navigation')?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">SUCCESS</h1>
                        <p><?php if(isset($message))echo $message;?></p>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


<?php $this->load->view('segments/footer')?>
