<!DOCTYPE html>
<html lang="en">

<head>
    <title>Test tasks 1</title>
    <meta charset="utf-8"/>
</head>

<body>
<form method="GET" action="index.php">
    Enter a string with the coordinates of two points (separated by commas)
    <input name="coordinates" type="text" placeholder="3, 0, 0, 4"
           value="<?php $a = isset($_GET['coordinates']) ? $_GET['coordinates'] : null;
           echo $a ?>">
    <input type="submit" value="Send">
</form>

<a href="index.php">Refresh the page</a>
<br>

<?php
if (isset($_GET['coordinates'])) {

    #Input Validation
    $pieces = explode(",", $_GET['coordinates']);
    if (count($pieces) !== 4) {
        echo "Please enter 4 digits";
        return;
    }

    foreach ($pieces as $piece) {
        if (!is_numeric(trim($piece))) {
            echo "Please enter only numbers";
            return;
        }
    }

    #Formation of points on the chart
    $pointA = [trim($pieces[0]), trim($pieces[1])];
    $pointB = [trim($pieces[2]), trim($pieces[3])];
    $pointZero = [0, 0];

    #Checking the main condition of the problem
    printEcho($pointA, $pointZero);
    printEcho($pointB, $pointZero);
    printEcho($pointA, $pointB);

}

/**
 * Prints an output string that depends on the coordinates of the points.
 * @param array $point1
 * @param array $point2
 */
function printEcho($point1, $point2)
{
    echo "{" . $point1[0] . ", " . $point1[1] . "} to {" . $point2[0] . ", " . $point2[1] . "} ";
    $line = lineSegment($point1, $point2);
    if (isNumber($line)) {
        echo "is valid <br>";
    } else {
        echo "is invalid <br>";
    }
}

/**
 * Calculates the distance between two points.
 * @param array $a
 * @param array $b
 * @return float
 */
function lineSegment($a, $b)
{
    $x = $b[0] - $a[0];//вычисляем реальное расстояние
    $y = $b[1] - $a[1];
    $r = sqrt(($x ** 2) + ($y ** 2));//по теореме Пифагора определяем длину гипотенузы

    return $r;
}

/**
 * Checks if the type of a variable is integer.
 * @param float $g1
 * @return bool
 */
function isNumber($g1)
{
    return ($g1 - (int)$g1) == 0;
}


?>

</body>
</html>
