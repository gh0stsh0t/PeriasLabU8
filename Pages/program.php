<?php
session_start();
if (array_key_exists('uname', $_SESSION)) {
    include_once "connecter.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (array_key_exists('edit', $_POST)) {
            unset($_POST['edit']);
            edit($_POST);
        }
        else
            add($_POST, 'program');
    }
}
else {
    header('Location: login.php?login=false');
}
?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="3.3.7/js/bootstrap.min.js"></script>
    <title>
        Table magics
    </title>
    <link rel="stylesheet" href="3.3.7/css/rjstrap.css">
    <script type="text/javascript">
        function edit(index) {
            var x = document.getElementById("jokelg");
            for (i = 0; i < whoIs.length; i++) {
                document.getElementById(whoIs[i] + 'txT').value = document.getElementById(whoIs[i] + index).innerHTML;
            }
            $('#jobitSingsong').modal();
        }
        function editor(index) {
            for (i = 0; i < whoIs.length; i++) {
                document.getElementById(whoIs[i] + index).innerHTML = document.getElementById(whoIs[i] + 'txT').value;
            }
        }

    </script>
</head>
<body>
<nav class="navbar navbar-default" id="myPage">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="student.php">Experiments of a CS Student &lt;Daigler Edition&gt;</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <?php headerMaker('program'); ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid bg-1">
    <div class="container row">
        <?php addingPermissions('program'); ?>
        <table class="table table-striped table-hover table-condensed col-md-offset-1" id="mainTable">
            <tr>
                <th class="hide">
                    #
                </th>
                <th>
                    Subject Code
                </th>
                <th>
                    Title
                </th>
                <th>
                    Years
                </th>
                <th>
                    &nbsp;
                </th>
            </tr>
            <?php
            laziness('* FROM program ORDER BY title', 'program');
            ?>
        </table>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">New Course</h4>
            </div>

            <form action="program.php" method="post">
                <div class="modal-body">
                    <div class="row container-fluid">
                        <div class="col-md-3 col-md-offset-1 form-group">
                            <div class="form-inline">
                                <input type="text" class="form-control" name="code" placeholder="Course Code">
                                <input type="text" class="form-control" name="title" placeholder="Title">
                                <input type="text" class="form-control" name="year" placeholder="Year">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="jobitSingsong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Edit Course</h4>
            </div>
            <form action="program.php" method="post">
                <input type="hidden" name="id" id="idtxT">
                <div class="modal-body">
                    <div class="row container-fluid">
                        <div class="col-md-3 col-md-offset-1 form-group">
                            <div class="form-inline">
                                <input type="text" class="form-control" id="codetxT" name="code"
                                       placeholder="Course Code">
                                <input type="text" class="form-control" id="titletxT" name="title" placeholder="Title">
                                <input type="text" class="form-control" name="year" id="yeartxT" placeholder="Year">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="test" name="edit">Edit</button>
                    <button type="button" class="btn btn-danger" id="dilijoke" data-dismiss="modal">Cancel</button>

                </div>
            </form>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="text-muted">COPYRIGHT DOI 2017-2017© RAPHAEL JOHN S PERIAS.</p>
    </div>
</footer>
</body>
</html>