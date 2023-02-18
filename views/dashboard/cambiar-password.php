<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/perfil" class="enlace-perfil">Volver al perfil</a>

    <form method="POST" class="formulario" action="/cambiar-password">

        <div class="campo">
            <label for="password">Contraseña actual</label>
            <input type="password" name="password_actual" placeholder="Contraseña actual">
        </div>
        <div class="campo">
            <label for="password">Contraseña nueva</label>
            <input type="password" name="password_nuevo" placeholder="Contraseña nueva">
        </div>

        <input type="submit" value="Guardar cambios">
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>