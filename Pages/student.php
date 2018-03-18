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
    <script type="text/javascript">
        function edit(index) {
            var x = document.getElementById("jokelg");
            for (i = 0; i < whoIs.length; i++) {
                //alert(whoIs[i]+'txT');
                if (i == 4 || i > 5) {
                    var a = document.getElementById(whoIs[i] + 'txT');
                    for (var j = 0; j < a.length; j++)
                        try {
                            if (document.getElementById(whoIs[i] + index).innerHTML === a.options[j].text)
                                document.getElementById(whoIs[i] + 'txT').selectedIndex = j;
                            //alert(document.getElementById(whoIs[i] + index).innerHTML+" "+j);
                        }
                        catch (ex) {
                            document.getElementById(whoIs[i] + 'txT').selectedIndex = null;
                        }
                }
                else
                    document.getElementById(whoIs[i] + 'txT').value = document.getElementById(whoIs[i] + index).innerHTML;
                //alert(document.getElementById(whoIs[i] + index).innerHTML + " " + whoIs[i] + index + " " + document.getElementById(whoIs[i] + 'txT').value + " " + whoIs[i] + 'txT');
            }
            //alert('txT');
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
                <?php headerMaker('student'); ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid bg-1">
    <div class="container row">
        <?php addingPermissions('student'); ?>
        <table class="table table-striped table-hover table-condensed col-md-offset-1" id="mainTable">
            <tr>
                <th class="hide">
                    #
                </th>
                <th>
                    Last Name
                </th>
                <th>
                    First Name
                </th>
                <th>
                    Middle Name
                </th>
                <th>
                    Gender
                </th>
                <th>
                    Birthdate
                </th>
                <th>
                    Program
                </th>
                <th>
                    Religion
                </th>
                <th>
                    Nationality
                </th>
                <th>
                    Regular Status
                </th>
                <th>
                    Year level
                </th>
                <th>
                    &nbsp;
                </th>
            </tr>
            <?php
            laziness('s.id, s.lastname, s.firstname, s.middlename, (CASE WHEN s.gender = 1 THEN \'Male\' ELSE \'Female\' END) as gender, s.birthdate, p.title, r.name as Rname, n.name, (CASE WHEN s.regular = 1 THEN \'Regular\' ELSE \'Irregular\' END) as regular, s.yearstatus FROM student AS s LEFT JOIN program AS p ON s.program_id=p.id LEFT JOIN religion AS r ON s.religion_id=r.id LEFT JOIN nationality AS n ON s.nationality_id=n.id ORDER BY s.program_id,s.lastname,s.firstname', 'student');
            ?>
        </table>
    </div>
</div>

<div class="modal fade" id="jobitSingsong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel1">Edit Record</h4>
            </div>
            <form action="student.php" method="post">
                <div class="modal-body">
                    <div class="row container-fluid">
                        <div class="col-md-3 col-md-offset-1 form-group">
                            <input type="hidden" name="id" id="idtxT">
                            <div class="form-inline">
                                <input type="text" class="form-control" name="lastname" id="lastnametxT"
                                       placeholder="Last Name">
                                <input type="text" class="form-control" id="firstnametxT" placeholder="First Name"
                                       name="firstname">
                                <input type="text" class="form-control" id="middlenametxT" placeholder="Middle Name"
                                       name="middlename">
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Gender&nbsp;</label>
                                <select name="gender" class="form-control" id="gendertxT">
                                    <option value='1'>Male</option>
                                    <option value='0'>Female</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="Birthday">&nbsp;Birth Date</label>
                                <input type="date" name="birthdate" class="form-control" id="birthdatetxT">
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Year Level</label>
                                <select name="yearstatus" class="form-control" id="yearstatustxT">
                                    <option value='1'>1st</option>
                                    <option value='2'>2nd</option>
                                    <option value='3'>3rd</option>
                                    <option value='4'>4th</option>
                                    <option value='5'>5th</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Regular Status</label>
                                <select name="regular" class="form-control" id="regulartxT">
                                    <option value='1'>Regular</option>
                                    <option value='0'>Irregular</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <div class="form-inline">
                                    <label for="YRlvl">&nbsp;Religion</label>
                                    <select name="religion_id" class="form-control" id="RnametxT">
                                        <?php
                                        selectMaker('religion', 'name');
                                        ?>
                                        <option value=null></option>
                                    </select>
                                </div>
                                <div class="form-inline">
                                    <label for="YRlvl">&nbsp;Course</label>
                                    <select name="program_id" class="form-control" id="titletxT">
                                        <?php
                                        selectMaker('program', 'title');
                                        ?>
                                    </select>
                                </div>
                                <div class="form-inline">
                                    <label for="YRlvl">&nbsp;Nationality</label>
                                    <select name="nationality_id" class="form-control" id="nametxT">
                                        <?php
                                        selectMaker('nationality', 'name');
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="test" name="edit">Edit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
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
            <form action="student.php" method="post">
                <div class="modal-body">
                    <div class="row container-fluid">
                        <div class="col-md-3 col-md-offset-1 form-group">
                            <div class="form-inline">
                                <input type="text" class="form-control" name="lastname" id="LNtxt"
                                       placeholder="Last Name">
                                <input type="text" class="form-control" id="FNtxt" placeholder="First Name"
                                       name="firstname">
                                <input type="text" class="form-control" id="FNtxt" placeholder="Middle Name"
                                       name="middlename">
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Gender&nbsp;</label>
                                <select name="gender" class="form-control" id="GDtxt">
                                    <option value='1'>Male</option>
                                    <option value='0'>Female</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="Birthday">&nbsp;Birth Date</label>
                                <input type="date" name="birthdate" class="form-control" id="BDtxt">
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Year Level</label>
                                <select name="yearstatus" class="form-control" id="YLtxt">
                                    <option value='1'>1st</option>
                                    <option value='2'>2nd</option>
                                    <option value='3'>3rd</option>
                                    <option value='4'>4th</option>
                                    <option value='5'>5th</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <label for="YRlvl">&nbsp;Year Level</label>
                                <select name="regular" class="form-control" id="YLtxt">
                                    <option value='1'>Yes</option>
                                    <option value='0'>No</option>
                                </select>
                            </div>
                            <div class="form-inline">
                                <div class="form-inline">
                                    <label for="YRlvl">&nbsp;Religion</label>
                                    <select name="religion_id" class="form-control" id="YLtxt">
                                        <?php
                                        selectMaker('religion', 'name');
                                        ?>
                                        <option value=''>&nbsp;</option>
                                    </select>
                                </div>
                                <div class="form-inline">
                                    <label for="YRlvl">&nbsp;Course</label>
                                    <select name="program_id" class="form-control" id="course">
                                        <?php
                                        selectMaker('program', 'title');
                                        ?>
                                    </select>
                                </div>
                                <div class="form-inline">
                                    <label for="YRlvl">&nbsp;Nationality</label>
                                    <select name="nationality_id" class="form-control" id="nationality">
                                        <?php
                                        selectMaker('nationality', 'name');
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

<footer class="footer">
    <div class="container">
        <p class="text-muted">COPYRIGHT DOI 2017-2017© RAPHAEL JOHN S PERIAS.</p>
    </div>
</footer>
</body>
</html>