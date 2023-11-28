<?php
$db = mysqli_connect('localhost', 'root', '', 'MathKids');

if (isset($_GET['lessonID'])) {
    $lessonID = mysqli_real_escape_string($db, $_GET['lessonID']);

    $queryBoard = "SELECT users.Username, leaderboard.Score FROM leaderboard INNER JOIN users ON leaderboard.UserID=users.UserID WHERE LessonID = $lessonID ORDER BY Score DESC LIMIT 3";
    $Boarddata = mysqli_query($db, $queryBoard);
    $rowsBoard = [];
    while ($rowb = $Boarddata->fetch_assoc()) {
        $rowsBoard[] = $rowb;
    }

    $queryBoardBottom = "SELECT users.Username, leaderboard.Score FROM leaderboard INNER JOIN users ON leaderboard.UserID=users.UserID WHERE LessonID = $lessonID ORDER BY Score DESC LIMIT 3 OFFSET 3";
    $Boardingdata = mysqli_query($db, $queryBoardBottom);
    $rowsBoards = [];
    while ($rowbs = $Boardingdata->fetch_assoc()) {
        $rowsBoards[] = $rowbs;
    }

    // Create HTML for the Top section
    $topHTML = '';
    foreach ($rowsBoard as $indexs => $rowb) {
        $topHTML .= '<div class="Top">';
        $topHTML .= '<div class="Picture">' . '<img src="icon-5887113_640.png" class="image" alt="User-Logo">' . '</div>';
        $topHTML .= '<div class="Number">' . ($indexs + 1) . '</div>';
        $topHTML .= '<div class="Name"><b>' . $rowb['Username'] . '</b>' . $rowb['Score'] . '</div>';
        $topHTML .= '</div>';
    }

    // Create HTML for the Others section
    $othersHTML = '';
    foreach ($rowsBoards as $indexss => $rowbs) {
        $othersHTML .= '<div class="OthersBoard">';
        $othersHTML .= '<div class="Left">' . ($indexss + 4) . '</div>';
        $othersHTML .= '<div class="Middle"><b>' . $rowbs['Username'] . '</b></div>';
        $othersHTML .= '<div class="Right"><b>' . $rowbs['Score'] . '</b></div>';
        $othersHTML .= '</div>';
    }

    // Output the JSON-encoded result
    echo json_encode(['topHTML' => $topHTML, 'othersHTML' => $othersHTML]);
}
?>