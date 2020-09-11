<!DOCTYPE html>
<html>
    <link href="https://fonts.googleapis.com/css2?family=Kufam:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Grandstander:wght@200&display=swap" rel="stylesheet">

    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <?php
        include ('header.html');
        ?>

        <style>
            #section1 {
                position: relative;
                size: 100% 100%;
                width: auto;
            }

            #section1 img {
                width: auto;
                height: auto;
                margin-bottom: -30px;
            }

            #section1 .btn {
                position: absolute;
                top: 65%;
                left: 50%;
                transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                color: #FFFFFF;
                font-size: 30px;
                display: inline-block;
                padding: 0.35em 1.2em;
                color: #FFFFFF;
                margin: 0 0.3em 0.3em 0;
                border-radius: 2em;
                box-sizing: border-box;
                cursor: pointer;
                text-decoration:none;
                font-family:'Roboto',sans-serif;
                text-align: center;
                transition: all 0.2s;
            }

            #section1 .btn:hover {
                background-color:#FFEE64;
            }

            #section2 {
                width: auto;
                height: 640px;
                position: relative;
                size: 100% 100%;
            }

            #section2 h2 {
                font-size: 5vw;
                position: absolute;
                font-family: 'Kufam', cursive;
                letter-spacing: 0.15em;
                color: black;
                left: 19%;
                size: 100% 100%;
            }

            div.gallery {
                border: 1px solid #ccc;
                float: left;
                max-width: 20%;
                margin: 35px;
            }

            div.gallery:hover {
                opacity: 60%;
            }

            div.gallery img {
                width: 100%;
                height: 300px;
            }

            div.desc {
                padding: 15px;
                text-align: center;
                font-family: 'Grandstander', cursive;
                font-size: 1.4vw;
                letter-spacing: 0.05em;
                position: absolute;
            }

            #section3 {
                position: relative;
                size: 100% 100%;
                width: auto;
            }

            #section3 img {
                width: auto;
                height: auto;
                margin-bottom: -23px;
            }

            #section3 h2 {
                position: absolute;
                top: 15%;
                left: 10%;
                font-size: 5vw;
                text-align: center;
                font-family: 'Dancing Script', cursive;
                letter-spacing: 0.15em;
                color: white;
                text-shadow: 2px 2px black;
            }

            #section3 .btn {
                position: absolute;
                top: 75%;
                left: 50%;
                transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                background-color: #FFEE64;
                color: #00045B;
                font-size: 35px;
                display: inline-block;
                padding: 0.35em 1.2em;
                border: 0.1em solid #00045B;
                margin: 0 0.3em 0.3em 0;
                border-radius: 0.12em;
                box-sizing: border-box;
                cursor: pointer;
                font-family: 'Roboto',sans-serif;
                text-align: center;
                transition: all 0.2s;
            }

            #section3 .btn:hover {
                color: yellow;
                background-color: #00045B;
            }
        </style>

    </head>
    <body>
        <div id="section1">
            <img src="images/bg1.jpg" style="width:100%; height:20%;">

            <button class="btn"><a href="about.php" style="text-decoration: none;">About Us</a></button>
        </div>

        <div id="section2">
            <h2>~ POPULAR ITEMS ~</h2>
            
            </br></br></br></br></br></br></br></br></br></br>

            <div class="gallery">
                <a href="product.php?id=1">
                    <img src="images/Faber Castell Grip X Pens.jpg" alt="Cinque Terre" width="30%" height="300px">
                </a>
                <div class="desc">Faber Castell Grip X Pens</div>
            </div>

            <div class="gallery">
                <a href="product.php?id=11">
                    <img src="images/Casio Scientific Calculator FX-570EX.jpg" alt="Cinque Terre" width="30%" height="300px">
                </a>
                <div class="desc">Casio Scientific Calculator </br> FX-570EX</div>
            </div>

            <div class="gallery">
                <a href="product.php?id=14">
                    <img src="images/Faster 509 Whiteboard Marker Pen.jpg" alt="Cinque Terre" width="30%" height="300px">
                </a>
                <div class="desc"> Faster 509 </br> Whiteboard Marker Pen</div>
            </div>

            <div class="gallery">
                <a href="product.php?id=18">
                    <img src="images/Write-On A4 Exercise Book 100pg 70gsm CW2509.jpg" alt="Cinque Terre" width="30%" height="300px">
                </a>
                <div class="desc">Write-On A4 Exercise Book</div>
            </div>

        </div>

        <div id="section3">
            <img src="images/img8.jpg" style="width:100%; max-height:25%; opacity: 70%;">
            <h2>NEED STATIONARY? </br></br> WE ARE YOUR BEST CHOICE</h2>
            <button class="btn"><a href="browse.php" style="text-decoration: none;">Shop Now</a></button>
        </div>

    </body>

    <?php
    include ('footer.html');
    ?>
</html>
