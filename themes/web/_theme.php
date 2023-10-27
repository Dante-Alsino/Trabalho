
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= CONF_SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?= url("assets/web/css/styles.css"); ?>" async>
    <link rel="stylesheet" href="<?= url("assets/web/"); ?>css/message.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/99d113a91a.js" crossorigin="anonymous"></script>
</head>
<body>
    <img src="<?= url("assets/web/img/banner.png");?>" id="img-banner">
    <nav>
        <a href="<?= url("/"); ?>">
            <i class="fa-solid fa-circle-info"></i>
            Sobre a agência
        </a>

        <a href="<?= url("pacotes"); ?>">
            <i class="fa-solid fa-graduation-cap"></i>
            Pacotes de intercâmbio
        </a>

        <a href="<?= url("instituicoes"); ?>">
            <i class="fa-solid fa-building-columns"></i>
            Universidades parceiras
        </a>

        <a href="<?= url("faq"); ?>">
            <i class="fa-sharp fa-solid fa-circle-question"></i>
            FAQ
        </a>
    </nav>

    <!-- REDES SOCIAIS -->
    <div class="home-container-socialmedia">
        <div class="socialmedia-float">
            <div class="home-socialmedia">
                <i class="fa-brands fa-instagram"></i>
            </div><br>
            <span><a href="https://www.instagram.com/" target="_blank">@igOnTheWay</a></span>
        </div>
        
        <div class="socialmedia-float">
            <div class="home-socialmedia">
                <i class="fa-brands fa-twitter"></i>
            </div><br>
            <span><a href="https://twitter.com/?lang=pt" target="_blank">@twtOnTheWay</a></span>
        </div>

        <div class="socialmedia-float">
            <div class="home-socialmedia">
                <i class="fa-brands fa-facebook-f"></i>
            </div><br>
            <span><a href="https://pt-br.facebook.com/" target="_blank">On The Way</a></span> 
        </div>           
    </div>

    <?= 
        $this->section("content");
    ?>

</body>
</html>