<?php 
$host = "localhost";
$username = "root";
$password = "";
$database = "visitorstatistics";

try{
    $con1 = mysqli_connect($host, $username, $password, $database);
    $con = new PDO('mysql:host='. $host . ';database=' . $database, $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected Successfully";
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="shortcut icon" type="image/x-icon" href="/Assets/icon/favicon.ico">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="styles.css"/>
    <title>Visita Admin Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i class="fas fa-user-secret me-2"></i>Visita</div>
            <div class="list-group list-group-flush my-3">
                <a href="index.html" class="list-group-item list-group-item-action bg-transparent second-text active">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>

                <a href="UserInformation.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-solid fa-user me-2"></i>User
                </a>

                <a href="VisitorPage.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-solid fa-id-badge me-2"></i>Visitors
                </a>

                <a href="Watchlist.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-solid fa-bell me-2"></i>Watchlist
                </a>

                <a href="AuditTrail.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-solid fa-shoe-prints me-2"></i>Audit Trail
                </a>

                <a href="settings.html" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-cog me-2"></i>Settings
                </a>


                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class=" fas fa-sign-out-alt me-2 "></i>Logout
                </a>

                <!-- Modal for logout -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="text-center">
                                    <img src="Assets/image/shutdown.png " class="w-50 ">
                                </div>
                                <h5 class="fw-bold mt-3">Are you sure you want to log-out?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <button type="button" class="btn btn-danger" onclick="location.href='login.html'">Yes,Logout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>John Doe
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5">Total Visitors Entered</p>
                                    <?php
                                    $dash_category_query = "SELECT * FROM totalvisitorperday";
                                    $dash_category_query_run = mysqli_query($con1, $dash_category_query);
                                    if($totalVisitors = mysqli_num_rows($dash_category_query_run))
                                    {
                                        echo '<h3 class="fs-2">'.$totalVisitors.'</h3>';
                                    } else {
                                        echo '<h3 class="fs-2">No Data</h3>';
                                    }
                                    ?>
                            </div>
                            <i class="fas fa-solid fa-user fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                            <p class="fs-5">Total Visitors per Week</p>
                            <?php
                                    $dash_category_query = "SELECT * FROM totalvisitorperday";
                                    $dash_category_query_run = mysqli_query($con1, $dash_category_query);
                                    if($totalVisitors = mysqli_num_rows($dash_category_query_run))
                                    {
                                        echo '<h3 class="fs-2">'.$totalVisitors.'</h3>';
                                    } else {
                                        echo '<h3 class="fs-2">No Data</h3>';
                                    }
                                    ?>
                            </div>
                            <i class="fas fa-thermometer fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5">Total Checked Out Visitors</p>
                                <?php
                                    $dash_category_query = "SELECT * FROM checkoutvisitor";
                                    $dash_category_query_run = mysqli_query($con1, $dash_category_query);
                                    if($totalCheckout = mysqli_num_rows($dash_category_query_run))
                                    {
                                        echo '<h3 class="fs-2">'.$totalCheckout.'</h3>';
                                    } else {
                                        echo '<h3 class="fs-2">No Data</h3>';
                                    }
                                    ?>
                            </div>
                            <i class="fas fa-hourglass-end fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <p class="fs-5">Total Walk in Visitors</p>
                                <?php
                                    $dash_category_query = "SELECT * FROM totalvisitorperday";
                                    $dash_category_query_run = mysqli_query($con1, $dash_category_query);
                                    if($totalVisitors = mysqli_num_rows($dash_category_query_run))
                                    {
                                        echo '<h3 class="fs-2">'.$totalVisitors.'</h3>';
                                    } else {
                                        echo '<h3 class="fs-2">No Data</h3>';
                                    }
                                    ?>
                            </div>
                            <i class="fas fa-list fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Statistics</h3>
                    <div class="col">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <canvas id="chart1" class="h-75 w-100"></canvas>
                            </div>

                        </div>
                    </div>
                    <div class=" col ">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded ">
                            <div>
                                <canvas id="chart2" class="h-75 w-100"></canvas>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- /#page-content-wrapper -->
            </div>

        </div>
    </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <?php 
// Attempt select query execution
            try{
                $dash_category_query = "SELECT MONTHNAME(date) FROM visitorstatistics.totalvisitorperday";
                $dash_category_query_run = mysqli_query($con1, $dash_category_query);

                $result = $con->query($dash_category_query);
                if($result->rowCount() > 0) {
                $totalVisitors = array();
                $date = array();

            unset($result);
            } else {
                echo "No records matching your query were found.";
            }
            } catch(PDOException $e){
            die("ERROR: Could not able to execute $dash_category_query. " . $e->getMessage());
            }

            // Close connection
            unset($con);
            ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

//setup
const date = <?php echo json_encode($date);?>;
const totalVisitors = <?php echo json_encode($totalVisitors);?>;
const data = {
labels: ['January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July ',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December',
                ],
        datasets: [{
            label: 'Total Visitors per Month',
            data: date,
            backgroundColor: [
                        'green',
                        'blue',
                        'red',
                        'yellow',
                        'darkblue',
                        'pink',
                        'orange',
                        'lightgreen',
                        'lightblue',
                        'violet',
                        'black',
                        '#B09B71'
            ],
        }]
    };
//config
const config1 = {
type: 'bar',
    data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};
//render
const chart1 = new Chart(
    document.getElementById('chart1'),
    config1
);
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    //chart 2
<?php
try{
    $con = new PDO("mysql:host=$host;database=$database", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>

    <?php 
// Attempt select query execution
        try{
            $sql = "SELECT AVG (averageVisitors) FROM visitorstatistics.averagevisitor";
            $result = $con->query($sql);
        if($result->rowCount() > 0) {
            $averageVisitors = array();
            
            while($row = $result->fetch()) {
                // $averageVisitors[] = $row["averageVisitors"];
            }

        unset($result);
        } else {
            echo "No records matching your query were found.";
        }
        } catch(PDOException $e){
        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        
        // Close connection
        unset($con);
        ?>

        //setup
        const averageVisitors = <?php echo json_encode($averageVisitors);?>;
        const data2 = {
        labels: [   'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July ',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December',
                ],
        datasets: [{
            label: 'Average Visitors per Month',
            data: averageVisitors,
            backgroundColor: [
                        'green',
                        'blue',
                        'red',
                        'yellow',
                        'darkblue',
                        'pink',
                        'orange',
                        'lightgreen',
                        'lightblue',
                        'violet',
                        'black',
                        '#B09B71'
            ],
        }]
    };
        //config
        const config3 = {
        type: 'bar',
            data: data2,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };
        //render
        const chart2 = new Chart(
    document.getElementById('chart2'),
    config3
);
</script>
</body>
</html>