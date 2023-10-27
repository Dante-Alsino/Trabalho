<?php
  $this->layout("_theme");
?>

<main>
    <!-- CADASTRO -->
    <div class="user-cadastro">
        <img src="<?= url("assets/web/img/logo.png");?>" id="form-img"><br>
        
        <form class="user-cadastro-form" id="form_cadastro">
            <p>
                Vamos começar a preparar seus estudos!<br>
                <b style="color: #dd6d26">Faça seu cadastro:<b>
            </p>
            <label for="name">Informe seu nome:</label><br>
            <input name="name" type="text" id="name"><br>

            <label for="lastname">Informe seu sobrenome:</label><br>
            <input name="lastname" type="text" id="lastname"><br>

            <label for="email">Informe seu e-mail:</label><br>
            <input name="email" type="email" id="emailCad"><br>

            <label for="password">Defina uma senha:</label><br>
            <input name="password" type="password" id="password"><br>


            <button type="submit" id="btnCadastrar">Cadastrar</button><br>

            <div id="message">
                <!-- mensagem -->
            </div>

            <p>
                <a href="<?= url("login"); ?>">
                    Fazer login
                </a>
            </p>
        </form>
        
    </div>
</main>

<script type="text/javascript" async>
    const form = document.querySelector("#form_cadastro");
    const message = document.querySelector("#message");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("cadastrar"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const user = await data.json();
        if(user) {
            message.innerHTML = user.message;
            message.classList.remove("success", "warning", "error");
            message.classList.add("message");
            message.classList.add(`${user.type}`);
        }
    });
</script>
