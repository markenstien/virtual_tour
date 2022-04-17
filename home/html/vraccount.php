<?php

    // SERVER 
    // ===================================================================================

    // include
    include("config/config.php");

    // START
    // ===================================================================================

    // check
    if (!isset($_SESSION['aUname']) || !isset($_SESSION['aPword'])) {
        // redirect
        header("Location: index.php");
        exit();
    }

    // check account
    $sql="select * FROM user_tbl where user_uname = '" . $_SESSION['aUname'] . "' and user_pword = '" . $_SESSION['aPword'] . "'"; 
    $rs=mysqli_query($connection,$sql);
    $rowAccount = array();
    while ($rows = mysqli_fetch_object($rs))
    {
        // flag
        $ctr = 1;
        
        // set
        $rowAccount[] = $rows;
    }
    if (count($rowAccount) <= 0) {

        // redirect
        header("Location: index.php");
        exit();
    }



    // fetch account
    $sql="select * FROM user_tbl where id = '" . $_GET['id'] . "'"; 
    $rs2=mysqli_query($connection,$sql);
    $rowAccount2 = array();
    while ($rows2 = mysqli_fetch_object($rs2))
    {
        // set
        $rowAccount2[] = $rows2;
    }


    // functions
    // ==================================
    function GetUserFullName($rowAccount)
    {
        return ucwords($rowAccount[0]->user_fname);
    }
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>SPCC Virtual Tour</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <link href="../assets/libs/morris.js/morris.css" rel="stylesheet">
    <!-- This page plugin CSS -->
    <link href="../assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <style>
        /* menu */
        .feather-icon {
            color: #86D8CA !important;
            font-weight: 700;
        }
        .hide-menu {
            font-size: 14px !important;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="index.html">
                            <b class="logo-icon">
                                
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                
                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="" alt="" class="rounded-circle"
                                    width="40">
                                <span class="ml-2 d-lg-inline-block"><span>Welcome back,</span> <span
                                        class="text-dark"><?php echo GetUserFullName($rowAccount); ?></span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="vraccount.php?id=<?php echo $rowAccount[0]->id; ?>"><i data-feather="settings"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a href="server/logout.php" class="dropdown-item" href="javascript:void(0)"><i data-feather="power"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Logout</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">

                        <li class="nav-small-cap"><span class="hide-menu">Menu</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="vrdashboard.php"
                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                class="hide-menu">Dashboard
                            </span></a>
                        </li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Content</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="vrpoi.php"
                            aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                class="hide-menu">POI Manager
                            </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="vrpoicategoryindex.php"
                            aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                class="hide-menu">POI Category Manager
                            </span></a>
                        </li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Manage Users</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="vruser.php"
                            aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span
                                class="hide-menu">Accounts
                            </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="vrlogs.php"
                            aria-expanded="false"><i data-feather="clipboard" class="feather-icon"></i><span
                                class="hide-menu">Logs
                            </span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link" href="vrreport.php"
                            aria-expanded="false"><i data-feather="file" class="feather-icon"></i><span
                                class="hide-menu">Report
                            </span></a>
                        </li>


                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="background-color: #EEF5F9 !important;">
            
        
            <form action="server/vruser2.php?id=<?php echo $rowAccount2[0]->id; ?>" method="POST" enctype="multipart/form-data">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-lg-6 align-self-center">
                            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">View / Modify User</h3>
                            <div class="d-flex align-items-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb m-0 p-0">
                                        <li class="breadcrumb-item"><a href="">View / Modify User</a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center">

                            <!-- mobile -->
                            <div class=".d-block .d-sm-block .d-md-none .d-lg-none d-xl-none text-center">
                                <br>
                                <div class="customize-input">
                                    <button type="submit" class="btn waves-effect waves-light btn-primary" name="eBUpdate"><i class="fas fa-save"></i> &nbsp Save  </button>
                                </div>
                            </div>

                            <!-- pc -->
                            <div class="d-none .d-md-block .d-lg-block d-xl-block float-right">
                                <br>
                                    <button type="submit" class="btn waves-effect waves-light btn-primary" name="eBUpdate"><i class="fas fa-save"></i> &nbsp Save  </button>
                            </div>

                        </div>
                    </div>
                </div>
                

                <div class="container-fluid">
                
                    <br>

                    <?php

                        // err
                        // ==================
                        if (isset($_GET['ok']))
                        {
                            echo '
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body bg-success text-light">
                                                <h2> Update Success. </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }

                        if (isset($_GET['err']))
                        {
                            echo '
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body bg-danger text-light">
                                                <h2> Update error. Check your inputs. </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }

                    ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <div class="row">
                                        <div class="col-lg-12 bg-white">
                                            <div class="p-3">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="text-dark" for="uname">Name</label>
                                                            <input class="form-control" id="uname" name="eName" type="text" value="<?php echo $rowAccount2[0]->user_fname; ?>" required
                                                                >
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="text-dark" for="uname">Login Username</label>
                                                            <input class="form-control" id="uname" name="eUname" type="text" value="<?php echo $rowAccount2[0]->user_uname; ?>" required
                                                            readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="text-dark" for="uname">Login Password</label>
                                                            <input class="form-control" id="uname" name="ePword" type="password" value="<?php echo $rowAccount2[0]->user_pword; ?>" required
                                                                >
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label class="text-dark" for="uname">Email</label>
                                                            <input class="form-control" id="uname" name="eEmail" type="email" value="<?php echo $rowAccount2[0]->user_email; ?>" required
                                                                >
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12" style="display: none;">
                                                        <div class="form-group">
                                                            <label class="text-dark" for="uname">Contact</label>
                                                            <input class="form-control" id="uname" name="eContact" type="tel" minlength="11" maxlength="11" value="<?php echo $rowAccount2[0]->user_contact; ?>" pattern="\d*" required
                                                                >
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            
            
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center text-muted">
                All Rights Reserved. Designed and Developed by <a
                    href="">iWeb Digital & IT Solution</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>

    <!--This page plugins -->
    <script src="../assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>

    <!--Morris JavaScript -->
    <script src="../assets/libs/raphael/raphael.min.js"></script>
    <script src="../assets/libs/morris.js/morris.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"></script>

    <script src="https://cdn.jsdelivr.net/npm/react@16.12/umd/react.production.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/react-dom@16.12/umd/react-dom.production.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prop-types@15.7.2/prop-types.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.34/browser.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/react-apexcharts@1.3.6/dist/react-apexcharts.iife.min.js"></script>

    <script>
        // Load - table
        $('#default_order').DataTable({
            "order": [
                [0, "desc"]
            ],
            "pageLength": 5,
        });
        
    </script>
</body>

</html>