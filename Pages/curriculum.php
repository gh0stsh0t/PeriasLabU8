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
            add($_POST, 'curriculum');
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
            var x = document.getElementById("mainTable");
            var whoIs = ['yeartaken', 'semester', 'ismajor', 'program_id', 'subject_id'];
            for (i = 0; i < whoIs.length; i++) {
                if (i == 2 || i == 5) {
                    var a = document.getElementById(whoIs[i] + 'txT');
                    for (var j = 0; j < a.length; j++)
                        if (document.getElementById(whoIs[i] + index).innerHTML == a.options[j].text)
                            document.getElementById(whoIs[i] + 'txT').selectedIndex = j;
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
                    Yeartaken
                </th>
                <th>
                    Semester
                </th>
                <th>
                    Major
                </th>
                <th>
                    program_id
                </th>
                <th>
                    subject_id
                </th>
                <th>
                    &nbsp;
                </th>
            </tr>
            <?php
            laziness('c.yeartaken, c.semester, (CASE WHEN c.ismajor = 1 THEN \'Major\' ELSE \'Minor\' END) as ismajor, c.id,p.title,su.code FROM curriculum AS c LEFT JOIN program AS p ON p.id=c.program_id LEFT JOIN subject AS su ON c.subject_id=su.id ORDER BY c.program_id,c.yeartaken,c.semester', 'curriculum');
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
            <form action="curriculum.php" method="post">
                <div class="modal-body">
                    <div class="row container-fluid">
                        <div class="col-md-3 col-md-offset-1 form-group">
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Year Taken</label>
                                <select name="yeartaken" class="form-control" id="YLtxt">
                                    <option value='1'>1st</option>
                                    <option value='2'>2nd</option>
                                    <option value='3'>3rd</option>
                                    <option value='4'>4th</option>
                                    <option value='5'>5th</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Semester</label>
                                <select name="semester" class="form-control" id="YLtxt">
                                    <option value='1'>1st</option>
                                    <option value='2'>2nd</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Major</label>
                                <select name="ismajor" class="form-control" id="YLtxt">
                                    <option value='1'>Major</option>
                                    <option value='0'>Minor</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Program</label>
                                <select name="program_id" class="form-control" id="YLtxt">
                                    <?php
                                    selectMaker('program', 'title');
                                    ?>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Subject</label>
                                <select name="subject_id" class="form-control" id="YLtxt">
                                    <?php
                                    selectMaker('subject', 'code');
                                    ?>
                                </select>
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
            <form action="curriculum.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" id="idtxT">
                    <div class="row container-fluid">
                        <div class="col-md-3 col-md-offset-1 form-group">
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Year Taken</label>
                                <select name="yeartaken" class="form-control" id="yeartakentxT">
                                    <option value='1'>1st</option>
                                    <option value='2'>2nd</option>
                                    <option value='3'>3rd</option>
                                    <option value='4'>4th</option>
                                    <option value='5'>5th</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Semester</label>
                                <select name="semester" class="form-control" id="semestertxT">
                                    <option value='1'>1st</option>
                                    <option value='2'>2nd</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Major</label>
                                <select name="ismajor" class="form-control" id="ismajortxT">
                                    <option value='1'>Major</option>
                                    <option value='0'>Minor</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Program</label>
                                <select name="program_id" class="form-control" id="titletxT">
                                    <?php
                                    selectMaker('program', 'title');
                                    ?>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Subject</label>
                                <select name="subject_id" class="form-control" id="codetxT">
                                    <?php
                                    selectMaker('subject', 'code');
                                    ?>
                                </select>
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