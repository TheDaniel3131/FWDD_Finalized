<?php
include ("nav_afterlogin.php")
?>
<?php
    $db = mysqli_connect('localhost','root','','MathKids');
    $query = "SELECT LessonID, LessonName FROM lessons";
    $data = mysqli_query($db, $query);
    $rows = [];
    while ($row = $data->fetch_assoc()) {
        $rows[] = $row;
    }
    $num = 0;
?>
<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="Leaderboard.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        $(document).ready(function () {
            $(".lessonbutton").on("click", function () {
                var lessonID = $(this).data("lessonid");
                $.ajax({
                    type: "GET",
                    url: "fetch_leaderboard.php",
                    data: { 
                        lessonID: lessonID 
                    },
                    success: function (data) {
                        var leaderboardData = $.parseJSON(data);
                        $(".Top3Box").html(leaderboardData.topHTML);
                        $(".Others").html(leaderboardData.othersHTML);
                    }
                });
            });
        });
    </script>
    <title>Leaderboard | MathKids</title>
    </head>
    <body>
    <div class="Choose">
        <?php foreach ($rows as $row) { ?>
            <button class="lessonbutton" data-lessonid="<?php echo $row['LessonID'] ?>"><?php echo $row['LessonName'] ?></button>
        <?php } ?>
    </div>

    <div class="board">
        <div class="Top3Box"></div>
        <div class="Others"></div>
    </div>
    </body>
</html>