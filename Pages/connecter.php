<?php
/*
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);
$link = new mysqli($server, $username, $password, $db);
print('<script>alert("WELOME '.$server.$username.$password.$db.'");</script>');
/*/
$link = mysqli_connect('localhost', 'encoder', 'encoder', 'school');
$tableName = basename($_SERVER['SCRIPT_NAME'], ".php");
// */
function editJS($result)
{
    $result = "['" . implode("', '", array_keys($result)) . "']";
    echo '<script>
            var whoIs = ' . $result . ';
          </script>
            ';
    return false;
}

function arrayLaman($row)
{
    foreach (array_keys($row) as $paramName)
        echo $paramName . "<br>";
}

function checkEditPermissions($tableName, $switcher)
{
    $permissions = $_SESSION['permit' . $tableName];
    return (bool)$permissions[$switcher];
}

function addingPermissions($tableName)
{
    if (checkEditPermissions($tableName, 1))
        echo '<button type="button" class="btn-xs btn btn-link col-md-offset-1" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><img src="Images/add.png"></button>';
}

function laziness($table, $tableName)
{
    if (checkEditPermissions($tableName, 0)) {
        global $link;
        $flag = true;
        $query = 'SELECT ' . $table;
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            if ($flag)
                $flag = editJS($row);
            echo '<tr>';
            foreach (array_keys($row) as $paramName) {
                echo '<td id="' . $paramName . $row['id'] . '"';
                if ($paramName == 'id' || $paramName == 'pword')
                    echo ' class="hide"';
                echo '>' . $row[$paramName] . '</td>';
            }
            if (checkEditPermissions($tableName, 2))
                echo '<td><button class="btn-xs btn btn-link" onclick=edit(' . $row['id'] . ')><img src="Images/edit.png"></button></td>';
            echo '</tr>';
        }
    }
}

function edit($row)
{
    global $link, $tableName;
    $query = "SELECT * FROM $tableName WHERE" . andComma('AND', $row);
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) == 0) {
        $query = "UPDATE $tableName SET " . andComma(',', $row) . " WHERE id=" . $row['id'];
        mysqli_query($link, $query);

    }
}

function andComma($string, $row)
{
    $query = '';
    foreach (array_keys($row) as $paramNames)
        if ($paramNames != 'id') {
            $query .= (empty($query) ? ' ' : "$string ") . $paramNames . "=" . (is_numeric($row[$paramNames]) ? $row[$paramNames] : "'$row[$paramNames]' ");
        }
    return $query;
}

function add($values, $table)
{
    global $link;
    foreach (array_keys($values, "") as $valueT)
        unset($values[$valueT]);
    $valueT = implode("', '", $values);
    $valueK = implode(", ", array_keys($values));
    $SINGLEQIOT = "'";
    $query = 'INSERT INTO ' . $table . ' (' . $valueK . ') VALUES(' . $SINGLEQIOT . $valueT . $SINGLEQIOT . ')';
    echo "<script>alert(\"$query\");<script>";
    mysqli_query($link, $query);
}

function selectMaker($table, $name)
{
    global $link;
    if ($table === 'student')
        $query = 'SELECT CONCAT(lastname, \', \', firstname) AS student FROM ' . $table . ' ORDER BY ' . $name;
    else
        $query = 'SELECT * FROM ' . $table . ' ORDER BY ' . $name;
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC))
        echo '<option value= \'' . $row['id'] . '\'>' . $row[$name] . '</option>';
}

function headerMaker($page)
{
    foreach (array('student',
                 'program',
                 'subject',
                 'nationality',
                 'religion',
                 'grade',
                 'account') as $tables) {
        if (checkEditPermissions($tables, 0)) {
            echo '<li';
            if ($tables == $page)
                echo ' class="active"';
            echo '><a href="' . $tables . '">' . $tables . '</a></li>';
        }
    }
    echo '<li><a href="logout.php">logout</a></li>';
}
