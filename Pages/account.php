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
            add($_POST, 'account');
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
        function editValue(tae, asa, kinsa) {
            var x = document.getElementById(kinsa).value.split('');
            if (tae.checked)
                x[asa] = 1;
            else
                x[asa] = 0;
            document.getElementById(kinsa).value = x.join('');
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
                <?php headerMaker('account'); ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid bg-1">
    <div class="container row">
        <?php addingPermissions('account'); ?>
        <table class="table table-striped table-hover table-condensed col-md-offset-1" id="mainTable">
            <tr>
                <th class="hide">
                    #
                </th>
                <th>
                    Username
                </th>
                <th>
                    Description
                </th>
                <th>
                    Active
                </th>
                <th>
                    student permissions
                </th>
                <th>
                    Program permissions
                </th>
                <th>
                    Nationality permissions
                </th>
                <th>
                    Religion permissions
                </th>
                <th>
                    Grades permissions
                </th>
                <th>
                    Accounts permissions
                </th>
                <th>
                    Addedon
                </th>
                <th>
                    Added by
                </th>
                <th>
                    &nbsp;
                </th>

            </tr>
            <?php
            laziness('id,uname,pword,description,active,permitstudent,permitprogram,permitnationality,permitreligion,permitgrade,permitaccount,addedon,addedby_id FROM account WHERE NOT uname=\'' . $_SESSION['uname'] . '\' ORDER BY id', 'account');
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
            <form action="account.php" method="post">
                <div class="modal-body">
                    <div class="row container-fluid">
                        <div class="col-md-3 col-md-offset-1 form-group">
                            <div class="form-inline">
                                <input type="text" class="form-control" id="LNtxt" placeholder="Username" name="uname">
                                <input type="password" class="form-control" id="FNtxt" placeholder="password"
                                       name="pword">
                            </div>
                            <div class="form-inline">
                                <input type="text" class="form-control" id="LNtxt" placeholder="Description"
                                       name="description">
                            </div>

                            <input type="hidden" name="active" id="active" value="0">
                            <input type="hidden" name="permitstudent" id="permitStudent" value="0000">
                            <input type="hidden" name="permitprogram" id="permitProgram" value="000000">
                            <input type="hidden" name="permitsubject" id="permitSubject" value="000">
                            <input type="hidden" name="permitnationality" id="permitNationality" value="000">
                            <input type="hidden" name="permitreligion" id="permitReligion" value="000">
                            <input type="hidden" name="permitgrade" id="permitGrade" value="000">
                            <input type="hidden" name="permitaccount" id="permitAccount" value="000">
                            <div class="form-inline">
                                <label for="Birthday">&nbsp;Active Status</label>
                                <input type="checkbox" class="form-control" onchange="editValue(this,0,'active')">
                            </div>
                            <div class="form-inline">
                                <label for="Birthday">&nbsp;Permit Student</label>
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,0,'permitStudent')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,1,'permitStudent')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,2,'permitStudent')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,3,'permitStudent')">
                            </div>
                            <div class="form-inline">
                                <label for="Birthday">&nbsp;Permit Program</label>
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,0,'permitProgram')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,1,'permitProgram')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,2,'permitProgram')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,3,'permitProgram')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,4,'permitProgram')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,5,'permitProgram')">
                            </div>
                            <div class="form-inline">
                                <label for="Birthday">&nbsp;Permit Subject</label>
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,0,'permitSubject')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,1,'permitSubject')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,2,'permitSubject')">
                            </div>
                            <div class="form-inline">
                                <label for="Birthday">&nbsp;Permit Nationality</label>
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,0,'permitNationality')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,1,'permitNationality')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,2,'permitNationality')">
                            </div>
                            <div class="form-inline">
                                <label for="Birthday">&nbsp;Permit Religion</label>
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,0,'permitReligion')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,1,'permitReligion')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,2,'permitReligion')">
                            </div>
                            <div class="form-inline">
                                <label for="Birthday">&nbsp;Permit Grade</label>
                                <input type="checkbox" class="form-control" onchange="editValue(this,0,'permitGrade')">
                                <input type="checkbox" class="form-control" onchange="editValue(this,1,'permitGrade')">
                                <input type="checkbox" class="form-control" onchange="editValue(this,2,'permitGrade')">
                            </div>
                            <div class="form-inline">
                                <label for="Birthday">&nbsp;Permit Account</label>
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,0,'permitAccount')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,1,'permitAccount')">
                                <input type="checkbox" class="form-control"
                                       onchange="editValue(this,2,'permitAccount')">
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
            <div class="modal-body">
                <div class="row container-fluid">
                    <div class="col-md-3 col-md-offset-1 form-group">
                        <div class="form-inline">
                            <input type="text" class="form-control" id="LNtxt" placeholder="Username" name="uname">
                            <input type="password" class="form-control" id="FNtxt" placeholder="password" name="pword">
                        </div>
                        <div class="form-inline">
                            <input type="text" class="form-control" id="LNtxt" placeholder="Description"
                                   name="description">
                        </div>

                        <input type="hidden" name="active" id="active" value="0">
                        <input type="hidden" name="permitstudent" id="epermitStudent" value="0000">
                        <input type="hidden" name="permitprogram" id="epermitProgram" value="000000">
                        <input type="hidden" name="permitsubject" id="epermitSubject" value="000">
                        <input type="hidden" name="permitnationality" id="epermitNationality" value="000">
                        <input type="hidden" name="permitreligion" id="epermitReligion" value="000">
                        <input type="hidden" name="permitgrade" id="epermitGrade" value="000">
                        <input type="hidden" name="permitaccount" id="epermitAccount" value="000">
                        <div class="form-inline">
                            <label for="Birthday">&nbsp;Active Status</label>
                            <input type="checkbox" class="form-control" onchange="editValue(this,0,'active')">
                        </div>
                        <div class="form-inline">
                            <label for="Birthday">&nbsp;Permit Student</label>
                            <input type="checkbox" class="form-control" onchange="editValue(this,0,'epermitStudent')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,1,'epermitStudent')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,2,'epermitStudent')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,3,'epermitStudent')">
                        </div>
                        <div class="form-inline">
                            <label for="Birthday">&nbsp;Permit Program</label>
                            <input type="checkbox" class="form-control" onchange="editValue(this,0,'epermitProgram')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,1,'epermitProgram')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,2,'epermitProgram')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,3,'epermitProgram')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,4,'epermitProgram')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,5,'epermitProgram')">
                        </div>
                        <div class="form-inline">
                            <label for="Birthday">&nbsp;Permit Subject</label>
                            <input type="checkbox" class="form-control" onchange="editValue(this,0,'epermitSubject')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,1,'epermitSubject')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,2,'epermitSubject')">
                        </div>
                        <div class="form-inline">
                            <label for="Birthday">&nbsp;Permit Nationality</label>
                            <input type="checkbox" class="form-control"
                                   onchange="editValue(this,0,'epermitNationality')">
                            <input type="checkbox" class="form-control"
                                   onchange="editValue(this,1,'epermitNationality')">
                            <input type="checkbox" class="form-control"
                                   onchange="editValue(this,2,'epermitNationality')">
                        </div>
                        <div class="form-inline">
                            <label for="Birthday">&nbsp;Permit Religion</label>
                            <input type="checkbox" class="form-control" onchange="editValue(this,0,'epermitReligion')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,1,'epermitReligion')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,2,'epermitReligion')">
                        </div>
                        <div class="form-inline">
                            <label for="Birthday">&nbsp;Permit Grade</label>
                            <input type="checkbox" class="form-control" onchange="editValue(this,0,'epermitGrade')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,1,'epermitGrade')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,2,'epermitGrade')">
                        </div>
                        <div class="form-inline">
                            <label for="Birthday">&nbsp;Permit Account</label>
                            <input type="checkbox" class="form-control" onchange="editValue(this,0,'epermitAccount')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,1,'epermitAccount')">
                            <input type="checkbox" class="form-control" onchange="editValue(this,2,'epermitAccount')">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="test" name="edit">Edit</button>
                <button type="button" class="btn btn-danger" id="dilijoke" data-dismiss="modal">Cancel</button>
            </div>
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