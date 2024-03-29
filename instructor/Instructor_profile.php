<?php $page_name = "Profile"; ?>
<?php include 'layout/ins_header.php'; ?>
<?php
    $instructor_pk = $_SESSION['pk'];
    $sql = "SELECT users.email FROM users WHERE users.pk = '$instructor_pk'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $instructor_email = $row["email"];
?>
        <div class="d-flex main-content" id="wrapper">
            <!-- Sidebar-->
            <?php include 'layout/ins_sidebar.php'; ?>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <?php include 'layout/ins_navbar.php'; ?>
                <!-- Page content-->
                <div class="container-fluid">
                    <span class="mt-2 baslik">PROFILE</span>
                    <div class="container bg-white">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?= $_SESSION['name']?></span><span class="text-black-50"><?= $instructor_email ?></span><span> </span></div>
                            </div>
                            <div class="col-md-5">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right">Profile Settings</h4>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" name="name" placeholder="first name" value=""></div>
                                        <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" name="mobilnumber" placeholder="enter phone number" value=""></div>
                                        <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" class="form-control" name="address" placeholder="enter address line 1" value=""></div>
                                        <div class="col-md-12"><label class="labels">Postcode</label><input type="text" class="form-control" name="postcode" placeholder="enter postcode" value=""></div>
                                        <div class="col-md-12"><label class="labels">State</label><input type="text" class="form-control" name="state" placeholder="enter state" value=""></div>
                                        <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" name="email" placeholder="enter email " value=""></div>
                                        <div class="col-md-12"><label class="labels">Country</label><input type="text" class="form-control" name="country" placeholder="country" value=""></div>
                                    </div>
                                    <div class="mt-5 text-center"><button class="btn btn-dark" name="save_profile" type="submit">Save Profile</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

<?php include 'layout/ins_footer.php'; ?>
