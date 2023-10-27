<?php
  $this->layout("_theme");
?>

<main>
    <!-- Recuperar senha -->
    <div class="user-login">
        <img src="<?= url("assets/web/img/logo.png");?>" id="form-img"><br>
        <br>
        <h2>Recupere sua senha</h2>

        <form class="user-login-form" id="form-login">
            <label for="email">E-mail:</label><br>
            <input type="email" name="email" id="email"><br>

            <button type="submit"> Enviar </button><br>

            <div id="message">
                <!-- mensagem -->
            </div>

            <p>
                <a href="<?= url("login"); ?>">
                    Volte para o login
                </a>
            </p>
        </form>
    </div>
</main>
