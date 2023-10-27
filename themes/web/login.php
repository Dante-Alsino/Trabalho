<?php
  $this->layout("_theme");
?>

<main>
    <!-- LOGIN -->
    <div class="user-login">
        <img src="<?= url("assets/web/img/logo.png");?>" id="form-img"><br>
        <br>
        <h2>Acesse sua conta</h2>

        <form class="user-login-form" id="form-login">
            <label for="email">E-mail:</label><br>
            <input type="email" name="email" id="email"><br>

            <label for="password">Senha:</label><br>
            <input type="password" name="password" id="senha" style="padding:2%"><br>

            <button type="submit"> Entrar </button><br>

            <div id="message">
                <!-- mensagem -->
            </div>

            <p>
                Ainda não possui uma conta?<br>
                <br>
                <a href="<?= url("cadastrar"); ?>">
                    Faça seu cadastro aqui.
                </a>
            </p>
              <p>
                <br>
                <a href="<?= url("recuperar"); ?>">
                   Recuperar senha.
                </a>
            </p>
        </form>
    </div>

    
</main>

<script type="text/javascript" async>
    const form = document.querySelector("#form-login");
    const message = document.querySelector("#message");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("login"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const user = await data.json();
        console.log(user);
        if(user) {
            if(user.message === "message"){
                message.innerHTML = user.message + ` Olá, ${user.name}!`;
            } else {
                message.innerHTML = user.message;
            }
            message.classList.add("message");
            message.classList.remove("success", "warning", "error");
            message.classList.add(`${user.type}`);
            if(user.type === "success"){
                    window.location.href='app';
            }
        }
    });
</script>