<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Restablecer contraseña</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form method="POST" action="/olvide" class="formulario">
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu email" name="email">
            </div>

            <input type="submit" class="boton" value="Enviar instrucciones">
        </form>
        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Iniciar sesión</a>
            <a href="/crear">¿Aún no tienes una cuenta? Crear</a>
        </div>
    </div><!-- .contenedor-sm -->
</div>