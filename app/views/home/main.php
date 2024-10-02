<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - SnapPHP Framework</title>
    
    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="<?php echo $this->asset('css/styles.css'); ?>">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to SnapPHP</h1>
        <p>This is a lightweight PHP framework designed to help you build faster and simpler applications.</p>

        <button class="button link"><a href="https://github.com/dinzin-tech" target="_blank">Go To Repo</a></button>
        <button class="button link"><a href="<?=$this->route('about')?>">About</a></button>

        <footer>
            <p>Built with ❤️ by <a href="#">DinZin</a></p>
        </footer>
    </div>
</body>
</html>
