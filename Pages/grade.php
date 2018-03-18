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
            add($_POST, 'student');
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
    <script>
        alert('MATAGAL TALAGA TO NAGA LOAD NA PAGE, IT HAS 4 QUERIES OF LARGE SIZES');
    </script>
    <script type="text/javascript">
        function edit(index) {
            var x = document.getElementById("jokelg");
            for (i = 0; i < whoIs.length; i++) {
                if (i === 2 || i === 5) {
                    var a = document.getElementById(whoIs[i] + 'txT');
                    for (var j = 0; j < a.length; j++)
                        if (document.getElementById(whoIs[i] + index).innerHTML === a.options[j].text)
                            document.getElementById(whoIs[i] + 'txT')
                    lkm.selectedIndex = j;
                }
                else
                    document.getElementById(whoIs[i] + 'txT').value = document.getElementById(whoIs[i] + index).innerHTML;
            }
            $('#jobitSingsong').modal();
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
                <?php headerMaker('grade'); ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid bg-1">
    <div class="container row">
        <?php addingPermissions('grade'); ?>
        <table class="table table-striped table-hover table-condensed col-md-offset-1" id="mainTable">
            <caption id="pangalan_doi">
                Student
            </caption>
            <tr>
                <th class="hide">
                    #
                </th>
                <th>
                    Student
                </th>
                <th>
                    Subject Code
                </th>
                <th>
                    School Year
                </th>
                <th>
                    Semester
                </th>
                <th>
                    Grade
                </th>
                <th>
                    ClassCode
                </th>
                <th>
                    &nbsp;
                </th>

            </tr>
            <?php
            laziness('CONCAT(s.lastname, \', \', s.firstname) as student, su.code,g.schoolyear,g.semester,g.id,g.grade,g.classcode FROM grade as g LEFT JOIN student AS s ON g.student_id=s.id LEFT JOIN subject AS su ON g.subject_id=su.id ORDER BY g.schoolyear,g.semester,su.code,student', 'grade');
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
                <h4 class="modal-title" id="exampleModalLabel">New Record</h4>
            </div>
            <form action="grade.php" method="post">
                <div class="modal-body">
                    <div class="row container-fluid">
                        <div class="col-md-3 col-md-offset-1 form-group">
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Student&nbsp;</label>
                                <select class="form-control" name="student_id" id="GDtxt">
                                    <?php selectMaker('student', 'student') ?>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="Birthday">&nbsp;Subject</label>
                                <select class="form-control" name="subject_id" id="GDtxt">
                                    <?php selectMaker('subject', 'code') ?>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">School Year</label>
                                <select class="form-control" name="schoolyear" id="YLtxt">
                                    <?php for ($x = 2003; $x <= date("Y"); $x++) echo '<option value= \'' . $x . '\'>' . $x . '</option>'; ?>
                                </select>
                            </div>

                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Semester</label>
                                <select class="form-control" name="semester" id="YLtxt">
                                    <option value='1'>1st</option>
                                    <option value='2'>2nd</option>
                                </select>
                                <input type="text" class="form-control" id="CCtxt" name="grade" placeholder="Grade">
                                <input type="text" class="form-control" id="NTtxt" name="classcode"
                                       placeholder="Classcode">
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
                <h4 class="modal-title" id="exampleModalLabel">Edit Record</h4>
            </div>
            <form action="grade.php" method="post">
                <input type="hidden" name="id" id="idtxT">
                <div class="modal-body">
                    <div class="row container-fluid">
                        <div class="col-md-3 col-md-offset-1 form-group">
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Student&nbsp;</label>
                                <select class="form-control" name="student_id" id="studenttxT">
                                    <?php selectMaker('student', 'student') ?>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="Birthday">&nbsp;Subject</label>
                                <select class="form-control" name="subject_id" id="codetxT">
                                    <?php selectMaker('subject', 'code') ?>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">School Year</label>
                                <select class="form-control" name="schoolyear" id="schoolyeartxT">
                                    <?php for ($x = 2003; $x <= date("Y"); $x++) echo '<option value= \'' . $x . '\'>' . $x . '</option>'; ?>
                                </select>
                            </div>

                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Semester</label>
                                <select class="form-control" name="semester" id="semestertxT">
                                    <option value='1'>1st</option>
                                    <option value='2'>2nd</option>
                                </select>
                                <input type="text" class="form-control" id="gradetxT" name="grade" placeholder="Grade">
                                <input type="text" class="form-control" id="classcodetxT" name="classcode"
                                       placeholder="Classcode">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="test" name="edit">Edit</button>
                    <button type="button" class="btn btn-danger" id="dilijoke" data-dismiss="modal">Cancel</button>

                </div>
            </form>
            <!-- toDO names-->
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