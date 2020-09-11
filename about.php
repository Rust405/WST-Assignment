<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="scripts/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Anton&family=Indie+Flower&family=Share+Tech&display=swap" rel="stylesheet">

        <title>About</title>

        <style>
            body {
                box-sizing: border-box;
            }

            body .columnL {
                float: left;
                width: 25%;
                padding: 10px;
                height: 800px;
                margin-bottom: -23px;
            }

            body .columnC {
                float: left;
                width: 45%;
                padding: 10px;
                height: 800px;
                margin-bottom: -23px;
            }

            body .columnR {
                float: left;
                width: 26%;
                padding: 10px;
                height: 800px;
                margin-bottom: -23px;
            }

            body .row:after {
                content: "";
                display: table;
                clear: both;
            }

            .hidden {
                display: none;
            }

            .columnC .map{
                position: absolute;
                top: 40%;
            }

            @media screen and (max-width: 1000px) {
                .column, map {
                    width: 100%;
                }
            }

        </style>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#toggle1").click(function () {
                    $('p#toggle1').removeClass('hidden');
                });

                $("#toggle2").click(function () {
                    $('p#toggle2').removeClass('hidden');
                });

            });

        </script>
        <?php
        include ('header.html');
        ?>

    </head>
    <body>

        <div class="row">
            <div class="columnL" style="background-color:#DAAD86;">

                <h2 style="font-family: 'Anton', sans-serif; letter-spacing: 0.15em; font-size: 3.3vw; text-align: center;">
                    Who Are We...
                </h2>

                <a id="toggle1" style="padding-left: 11%; font-family: 'Share Tech', sans-serif; letter-spacing: 0.15em; font-size: 2.5vw;">
                    - Click ME! -
                </a> 

                </br></br>

                <p id="toggle1" class="hidden" style="font-family: 'Indie Flower', cursive; letter-spacing: 0.15em; font-size: 2vw; text-align: center">
                    We are a local SME Stationery Business that caters all kinds of stationary to the community.
                    </br></br>
                    Est. 2005, Our Services can be reached throughout Sabah and West Malaysia!
                </p>
            </div>

            <div class="columnC" style="background-color:#FFE400;">

                <h2 style="font-family: 'Anton', sans-serif; letter-spacing: 0.15em; font-size: 3.3vw; text-align: center;">
                    Our Locations
                </h2>
                
                </br></br>

                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d63492.65074936294!2d116.06890054203117!3d5.954630745742213!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1saa%20stationery!5e0!3m2!1sen!2smy!4v1599740361784!5m2!1sen!2smy"
                            width="680" height="600" frameborder="0" style="border:0;"
                            allowfullscreen="" aria-hidden="false" tabindex="0">
                    </iframe>
                </div>
            </div>

            <div class="columnR" style="background-color:#8EEA4F;">

                <h2 style="font-family: 'Anton', sans-serif; letter-spacing: 0.15em; font-size: 3.3vw; text-align: center;">
                    Contact Info
                </h2>

                <a id="toggle2" style="padding-left: 18%; font-family: 'Share Tech', sans-serif; letter-spacing: 0.15em; font-size: 2.5vw;">
                    - Click ME! -
                </a>

                </br></br>

                <p id="toggle2" class="hidden" style="font-family: 'Indie Flower', cursive; letter-spacing: 0.15em; font-size: 1.3vw;">
                    <b>AA Stationery Sdn.Bhd 390168-U</b>
                    </br>
                    Lot 5, 6, and 7, Blok 34A, Tkt Bawah & 1, Kedai Pekan Koidupan, 88300 Penampang, Sabah
                    </br>
                    ----------------------------------
                    </br>
                    <b>Email:</b> aastationeryweb@gmail.com
                    </br>
                    <b>Messenger:</b> m.me/aastationery
                    </br>
                    <b>Whatsapp:</b> +6019-822 8215
                    </br>
                    <b>Wholesale Mart (Donggongon):</b> 088-728 635
                    </br>
                    <b>Penampang :</b> 088-727 092 / 710 092
                    </br>
                    <b>Karamunsing Capital :</b> 088-204 935
                    </br>
                    <b>Damai :</b> 088-252 718
                    </br>
                    <b>Metro Town :</b> 088-380 063
                    </br>
                    <b>Lintas :</b> 088-301 063
                    </br>
                    <b>Tuaran :</b> 088-785 269
                    </br>
                    <b>Inanam :</b> 088-396 166
                    </br>
                </p>
            </div>
        </div>

    </body>

    <?php
    include ('footer.html');
    ?>
</html>
