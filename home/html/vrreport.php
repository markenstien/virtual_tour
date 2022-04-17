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

    
    // Define Date Filter
    $dateFilterResultTo = $date->format(date('Y-m-d', strtotime($dateOnlyResult . " + 7 days")));
    $dateFilterResultFrom = $dateOnlyResult;
    if (isset($_GET['fdt'])) {
        $dateFilterResultTo = $_GET['fdt'];
        $dateFilterResultFrom = $_GET['fdf'];
    }

    
    
    //  dashboard
    // -------------------------------------------------------
    $dashTotalVisitor = 0;
    $dashTotalVisitor2 = 0;
    $dashMostViewed = "None";


    // total
    $sql = "select count(distinct(visit_ip)) as result from visitor_tbl";
    $rsDash1=mysqli_query($connection, $sql);
    while ($rowsDash1 = mysqli_fetch_object($rsDash1))
    {
        $dashTotalVisitor = $rowsDash1->result;
    }

    // total
    for ($x = 0; $x < 7; $x++)
    {
        // get date
        $dateResultWeek = $date->format(date('Y-m-d', strtotime("this week + " . $x . " days")));
        $jsonArr["date"][] = $dateResultWeek;

        // get report 
        $sql="select count(DISTINCT(visit_ip)) as results FROM visitor_tbl where visit_date like '%" . $dateResultWeek . "%'"; 
        $rsDash2=mysqli_query($connection,$sql);
        while ($rowsDash2 = mysqli_fetch_object($rsDash2))
        {
            $dashTotalVisitor2 += $rowsDash2->results;
        }
    }

    // total
    $sql = "select * from pic_tbl order by pic_counter desc limit 1";
    $rsDash3=mysqli_query($connection, $sql);
    while ($rowsDash3 = mysqli_fetch_object($rsDash3))
    {
        $dashMostViewed = $rowsDash3->pic_name;
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

        @media print
        {    
            .no-print, .no-print *
            {
                display: none !important;
            }

            .no-print2, .no-print2 *
            {
                display: block !important;
            }

            .fix, .fix *
            {
                margin-left: 0px !important;
            }

            .headerfix, .headerfix *
            {
                margin-top: -25px !important;
            }

            .chartfix, .chartfix *
            {
                width: 1000px !important;
            }
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    
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
        <aside class="left-sidebar no-print" data-sidebarbg="skin6">
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
        <div class="page-wrapper fix" style="background-color: #EEF5F9 !important;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- *************************************************************** -->
                <!-- Start First Cards -->
                <!-- *************************************************************** -->
                <div class="row no-print">
                    <div class="col-lg-3">
                        <br>
                        <b>From:</b> <input class="form-control custom-shadow custom-radius border-0 bg-white" type="date" value="<?php if (isset($_GET['fdt'])) { echo $dateFilterResultFrom; } else { echo $dateOnlyResult; } ?>" id="inputDateFrom" name="inputDateFrom" onchange="handler(event);">
                        <b>To:</b> <input class="form-control custom-shadow custom-radius border-0 bg-white" type="date" value="<?php if (isset($_GET['fdt'])) { echo $dateFilterResultTo; } else { echo $dateOnlyResult; } ?>" id="inputDateTo" name="inputDateTo" onchange="handler(event);">
                        <br>
                    </div>
                    <div class="col-lg-9 text-right">
                        <button type="button" class="btn waves-effect waves-light btn-primary mt-5" name="eBUpdate" onclick="generate();"><i class="fas fa-file"></i> &nbsp Generate Report  </button>
                        <Br><Br>
                    </div>
                </div>

                <div class="row no-print2" style="display: none;">
                    <div class="col-lg-12 text-center headerfix">
                        <div class="card">
                            <div class="card-body">
                                <img src="../assets/images/bgimg.png" width="686px" height="127px">
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">SPCC Virtual Tour Report</h3>
                        <div class="">
                            <b>From:</b> <?php echo $dateFilterResultFrom; ?> <br>
                            <b>To:</b> <?php echo $dateFilterResultTo; ?>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12 chartfix">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <h4 class="card-title mb-0">No. of Visitors</h4>
                                    <div class="ml-auto">
                                        
                                    </div>
                                </div>
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 chartfix">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <h4 class="card-title mb-0">Most Visited Facilities</h4>
                                    <div class="ml-auto">
                                        
                                    </div>
                                </div>
                                <div id="chart2"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 chartfix">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <h4 class="card-title mb-0">Top Visitor Cities</h4>
                                    <div class="ml-auto">
                                        
                                    </div>
                                </div>
                                <div id="chart3"></div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <!-- *************************************************************** -->
                <!-- End Top Leader Table -->
                <!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            
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

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        // Load - table
        $('#default_order').DataTable({
            "order": [
                [0, "desc"]
            ],
            "pageLength": 5,
        });

        // Load - Chart
        $(document).ready(function () {
            Load();
            async function Load() {
                try {
                    let res = await fetch("server/api.php?mode=20&dateFrom=<?php echo $dateFilterResultFrom; ?>&dateTo=<?php echo $dateFilterResultTo; ?>");
                    let dat = await res.json();

                    // check
                    if (!dat || Object.keys(dat).length === 0) {
                        return;
                    }

                    // display chart
                    var options = {
                        series: [{
                            name: 'Visitors',
                            type: 'line',
                            data: dat.value
                            }],
                        chart: {
                            height: 200,
                            width: 900,
                            type: 'line',
                            stacked: false,
                            toolbar: {
                                show: false
                                },
                            },
                        dataLabels: {
                            enabled: false
                            },
                        stroke: {
                            width: [1, 1, 4]
                            },
                        title: {
                        text: '',
                        align: 'left',
                        offsetX: 110
                        },
                        xaxis: {
                            categories: dat.date,
                            },
                        yaxis: [
                            {
                                seriesName: 'Visitors',
                                axisTicks: {
                                show: true,
                                },
                                axisBorder: {
                                show: true,
                                color: '#008FFB'
                                },
                                labels: {
                                    style: {
                                        colors: '#008FFB',
                                    },
                                    formatter: function(val) {
                                        return val.toFixed(0);
                                    },
                                },
                                title: {
                                text: "",
                                style: {
                                    color: '#008FFB',
                                }
                                },
                                tooltip: {
                                enabled: true
                                },
                            },
                            {
                                seriesName: 'Target Sales',
                                show: false,
                                
                            },
                            ],
                        tooltip: {
                                fixed: {
                                    enabled: true,
                                    position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                                    offsetY: 30,
                                    offsetX: 60
                                },
                            },
                            legend: {
    show: false
  }
                        
                        };

                        var chart = new ApexCharts(document.querySelector("#chart"), options);
                        chart.render();
                }
                catch(error) {
                    console.log(" vc says: " + error);
                }
            }
        });

        // Load - Chart 
        $(document).ready(function () {
            Load();
            async function Load() {
                try {
                    let res = await fetch("server/api.php?mode=21&dateFrom=<?php echo $dateFilterResultFrom; ?>&dateTo=<?php echo $dateFilterResultTo; ?>");
                    let dat = await res.json();

                    // check
                    if (!dat || Object.keys(dat).length === 0) {
                        return;
                    }

                    // display chart
                    var options = {
                        series: [{
                            data: dat.value
                        }],
                        chart: {
                            type: 'bar',
                            height: 200,
                            width: 900,
                            toolbar: {
                                show: false
                                },
                            
                        },
                        legend: {
    show: false
  },
                        plotOptions: {
                            bar: {
                                barHeight: '100%',
                                distributed: true,
                                horizontal: true,
                                dataLabels: {
                                    position: 'bottom'
                                },
                            }
                        },
                        colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e',
                            '#f48024', '#69d2e7'
                        ],
                        dataLabels: {
                            enabled: true,
                            textAnchor: 'start',
                            style: {
                                colors: ['#fff']
                            },
                            formatter: function(val, opt) {
                                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                            },
                            offsetX: 0,
                            dropShadow: {
                                enabled: true
                            }
                        },
                        stroke: {
                            width: 1,
                            colors: ['#fff']
                        },
                        xaxis: {
                            categories: dat.text,
                            labels: {
                                formatter: function(val) {
                                    return val.toFixed(0);
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                show: false
                            }
                        },
                        title: {
                            text: '',
                            align: 'center',
                            floating: true
                        },
                        subtitle: {
                            text: '',
                            align: 'center',
                        },
                        tooltip: {
                            theme: 'dark',
                            x: {
                                show: false
                            },
                            y: {
                                title: {
                                    formatter: function() {
                                        return ''
                                    }
                                }
                            }
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#chart2"), options);
                    chart.render();
                }
                catch(error) {
                    console.log(" vc says: " + error);
                }
            }
        });

        // Load - Chart 
        $(document).ready(function () {
            Load();
            async function Load() {
                try {
                    let res = await fetch("server/api.php?mode=22&dateFrom=<?php echo $dateFilterResultFrom; ?>&dateTo=<?php echo $dateFilterResultTo; ?>");
                    let dat = await res.json();

                    // check
                    if (!dat || Object.keys(dat).length === 0) {
                        return;
                    }

                    // display chart
                    var options = {
                        series: [{
                            data: dat.value
                        }],
                        chart: {
                            type: 'bar',
                            height: 200,
                            width: 900,
                            toolbar: {
                                show: false
                                },
                        },
                        legend: {
    show: false
  },
                        plotOptions: {
                            bar: {
                                barHeight: '100%',
                                distributed: true,
                                horizontal: true,
                                dataLabels: {
                                    position: 'bottom'
                                },
                            }
                        },
                        colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e',
                            '#f48024', '#69d2e7'
                        ],
                        dataLabels: {
                            enabled: true,
                            textAnchor: 'start',
                            style: {
                                colors: ['#fff']
                            },
                            formatter: function(val, opt) {
                                return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                            },
                            offsetX: 0,
                            dropShadow: {
                                enabled: true
                            }
                        },
                        stroke: {
                            width: 1,
                            colors: ['#fff']
                        },
                        xaxis: {
                            categories: dat.text,
                            labels: {
                                formatter: function(val) {
                                    return val.toFixed(0);
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                show: false
                            }
                        },
                        title: {
                            text: '',
                            align: 'center',
                            floating: true
                        },
                        subtitle: {
                            text: '',
                            align: 'center',
                        },
                    };

                    var chart = new ApexCharts(document.querySelector("#chart3"), options);
                    chart.render();
                }
                catch(error) {
                    console.log(" vc says: " + error);
                }
            }
        });    

        function generate()
        {
            window.print();
        }

        window.onload = function() {
            showChangeDate();
        }

        function showChangeDate(){
            document.getElementById("inputDateTo").value = "<?php echo $dateFilterResultTo; ?>";
            document.getElementById("inputDateFrom").value = "<?php echo $dateFilterResultFrom; ?>";
        }

        function handler(e){
            input1 = document.getElementById('inputDateTo');
            input2 = document.getElementById('inputDateFrom');

            date1 = input1.valueAsDate;
            date2 = input2.valueAsDate;

            if (date2 <= date1) {
                window.location = "vrreport.php?fdt=" + document.getElementById("inputDateTo").value + "&fdf=" + document.getElementById("inputDateFrom").value;
            }
            else
            {
                alert("Invalid Date!");
            }
        }
        
    </script>
</body>

</html>