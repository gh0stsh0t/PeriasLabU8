<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="3.3.7/js/bootstrap.min.js"></script>
    <title>Login</title>
    <style>
        body {
            width: 100px;
            height: 100px;
            background: -webkit-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Chrome 10+, Saf5.1+ */
            background: -moz-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* FF3.6+ */
            background: -ms-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* IE10 */
            background: -o-linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* Opera 11.10+ */
            background: linear-gradient(90deg, #16222A 10%, #3A6073 90%); /* W3C */
            font-family: "Raleway", sans-serif;
        }

        p {
            color: #CCC;
        }

        .spacing {
            padding-top: 7px;
            padding-bottom: 7px;
        }

        .middlePage {
            width: 400px;
            height: 500px;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

        .logo {
            color: #CCC;
        }
    </style>
</head>
<body>
<link href=\"http://fonts.googleapis.com/css?family=Raleway:500\" rel=\"stylesheet\" type=\"text/css\">

<body>
<div class="middlePage">
    <div class="page-header">
        <h1 class="logo">Kabuhayan
            <small>Welcome to rj.sis!</small>
        </h1>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title" id="tester">Please Sign In</h3>
        </div>
        <div class="panel-body">

            <div class="row">

                <div style="border-left:1px solid #ccc;height:160px; padding: 2px 8px">
                    <form class="form-horizontal" action="login.php" method="POST">
                        <fieldset>
                            <input id="textinput" name="uname" type="text" placeholder="Enter User Name"
                                   class="form-control input-md">
                            <input id="textinput" name="pword" type="password" placeholder="Enter Password"
                                   class="form-control input-md">
                            <button id="singlebutton" name="singlebutton" class="btn btn-info btn-sm pull-right">Sign
                                In
                            </button>
                        </fieldset>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once "connecter.php";
    $query = 'SELECT * FROM ACCOUNT WHERE uname = "' . $_POST['uname'] . '" AND pword = "' . $_POST['pword'] . '"';
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 1) {
        session_start();
        $row = mysqli_fetch_array($result, MYSQL_ASSOC);
        foreach (array_keys($row) as $binuang) {
            $_SESSION[$binuang] = $row[$binuang];
        }
        print('<script>alert("WELOME ' . $_SESSION['uname'] . '");</script>');
        print('<script>alert("this website assumes your tables are named \'student\',\'program\',\'subject\',\'nationality\', \'religion\',\'grades\',\'account\' and permissions named likewise, save for \'permit\' leading the names");</script>');
        header('REFRESH: 0; student.php');
    }
    else {
        echo '<script>document.getElementById("tester").innerHTML="<font color=red>INVALID CREDENTIALS</font>"</script>';
    }
}
else {
    if (array_key_exists('login', $_REQUEST)) {
        print('<script>alert("Please Login");</script>');
    }
    else {
    }
}
?>
<footer class="footer">
    <div class="container">
        <p class="text-muted">COPYRIGHT DOI 2017-2017© RAPHAEL JOHN S PERIAS.</p>
    </div>
</footer>
</body>
</html>



