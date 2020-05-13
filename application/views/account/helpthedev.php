<link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo css_url("account/helpthedev/main.css")?>">
<div id="main">
        <div class="menu-bar" style="max-height: 78px;">
            <div class="openClose">
                <span style="font-size: 30px; cursor: pointer;" onclick="" class="fas fa-bars" id="menu-open"></span>
                <span style="font-size: 30px; cursor: pointer;" onclick="" class="fas fa-chevron-left"
                    id="menu-close"></span>
            </div>
            <div class="logos">
                <img src="<?php echo img_url("f+f-logo-no-border.png")?>" alt=""
                    style="max-height: 48px; margin-right: 16px; margin-top: 8px; cursor: pointer;" class="logo-short"
                    id="logo-short" />
                <div class="logo-long-div" id="logo-long-div">
                    <img src="<?php echo img_url("Logo_long.png")?>" alt=""
                        style="max-height: 48px; margin-right: 16px; margin-top: 8px; cursor: pointer;"
                        class="logo-long" id="logo-long" />
                </div>
            </div>
        </div>

        <div class="body-content">
            <div>

                <div class="alert alert-danger" id="not-open-alert" style="display: none;" role="alert">
                    Sajnos az oldal még nem nyitott a nyílvánosság felé. Nézz vissza pár hét múlva! </div>
                <span class="fas fa-info-circle nav-icon title-icon"></span>
                <h1 class="suggestion-h1"> Fejlesztési ötletek az F+F weboldalra</h1>

                <form class="suggestion-form" method="POST">
                    <label class="suggestion-form-lable" for="title_input">Rövid Tömör Cím</label><br>
                    <input name="title" id="title_input" type="text" placeholder="Rövid név az ötletnek..."
                        required maxlength="64"><br>
                    <label class="suggestion-form-lable" for="description_input">Leírás</label><br>
                    <textarea class="suggestion-form-description" name="description" id="description_input" required
                        cols="40" rows="5" type="text" placeholder="Fejtsd ki az ötleted..." rows></textarea><br>
                    <label class="suggestion-form-lable" for="username_input">Saját Név (Nem kötelező)</label><br>
                    <input name="username" class="suggestion-form-name" id="username_input" placeholder="Saját neved..."
                        required type="text"> <br>
                    <button type="submit" name="post" id="submit-form"><span>Beküldés</span></button>
                </form>
            </div>
        </div>


    </div>

    <script>
        $(document).ready(function () {
            document.getElementById("main").style.marginLeft = "0px";
            $("#menu-open").click(function () {
                $("#not-open-alert").fadeIn(500)
            });
        })
    </script>