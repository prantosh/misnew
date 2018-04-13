<!doctype html>
<html>
    <head>
        <title>Dynamically show data in the Tooltip using AJAX</title>
        <link href='style.css' rel='stylesheet' type='text/css'>
        <link href='jquery-ui.css' rel='stylesheet' type='text/css'>
        <script src='jquery-1.12.0.min.js' type='text/javascript'></script>
        <script src='jquery-ui.js' type='text/javascript'></script>
        <script src='script.js' type='text/javascript'></script>
        
    </head>
    <body>
        <div class='container'>
            
            <div class='content'>
                <span title='Please wait..' id='<?php echo $row["PART_NO"] ;?>'>Yogesh Singh</span>
            </div>
            
            <div class='content'>
                <span title='Please wait..' id='user_2'>Sonarika Bhadoria</span>
            </div>

            <div class='content'>
                <span title='Please wait..' id='user_3'>Vishal Sahu</span>
            </div>

            <div class='content'>
                <span title='Please wait..' id='user_4'>Sunil</span>
            </div>
        </div>
    </body>
</html>