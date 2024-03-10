<?php $page_name = "Contact"; ?>
<?php include 'layout/st_header.php'; ?>

        <div class="d-flex main-content" id="wrapper">
            <!-- Sidebar-->
            <?php include 'layout/st_sidebar.php'; ?>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <?php include 'layout/st_navbar.php'; ?>
                <!-- Page content-->
                <div class="container-fluid">
                    <span class="baslik">CONTACT</span>
                    <br><br>
                    <div class="row justify-content-lg-center">
                        <div class="col-12 col-lg-9">
                            <div class="bg-white border rounded shadow-sm overflow-hidden">
                  
                                <form action="#!">
                                    <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                                        <div class="col-12">
                                            <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="subject" name="subject" value="" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-secondary btn-lg" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                  
                            </div>
                        </div>
                    </div>
            
                
                </div>  
            </div>
        </div>
<?php include 'layout/st_footer.php'; ?>
