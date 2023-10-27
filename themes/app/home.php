<?php
  $this->layout("_theme");
?>

<main>
    <div class="content">
        <div class="home-icon">
            <i class="fa-solid fa-user-graduate"></i>
        </div>
        <a href="<?= url("app/perfil"); ?>" class="home-link">
            Perfil
            <i class="fa-solid fa-circle-arrow-right"></i>
        </a>
    </div>

    <div class="content">
        <div class="home-icon">
            <i class="fa-solid fa-file-import"></i>
        </div>
        <a class="home-link">
            Documentos
            <i class="fa-solid fa-circle-arrow-right"></i>
        </a>
    </div>

    <div class="content">
        <div class="home-icon">
            <i class="fa-solid fa-bars-progress"></i>
        </div>
        <a class="home-link">
            Processos
            <i class="fa-solid fa-circle-arrow-right"></i>
        </a>
    </div>

    <div class="content">
        <div class="home-icon">
            <i class="fa-solid fa-heart"></i>
        </div>
        <a class="home-link">
            Interesses
            <i class="fa-solid fa-circle-arrow-right"></i>
        </a>
    </div>
</main>