<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!" style="color: gray;"><i class="fas fa-bars"></i></button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
            
                <li class="nav-item dropdown">
                    <?php if(isset($_SESSION['name'])){?>
                        
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['name']?></a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                
                                <a class="dropdown-item" href="#!"><i class="fa fa-user" aria-hidden="true" style="margin-right: 0.5rem;"></i>Profile</a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../../logout.php"><i class="fas fa-sign-out-alt" style="margin-right: 0.5rem;"></i>Logout</a>
                            </div>
                    <?php }else {echo '<a class="nav-link" href="../../index.php">Sign in</a>';}?>
                </li>
            </ul>
        </div>
    </div>
</nav>