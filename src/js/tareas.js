// IIFE -> Inmediatelly Invoque Function Expression
(function () {
    // Botón para mostrar ventana modal para agregar tarea
    const nuevaTareaBtn = document.querySelector("#agregar-tarea");
    nuevaTareaBtn.addEventListener("click", mostrarFormulario);

    function mostrarFormulario() {
        const modal = document.createElement("DIV");
        modal.classList.add("modal");
        modal.innerHTML = `
        <form class="formulario nueva-tarea">
            <legend>Añade una nueva tarea</legend>
            <div class="campo">
                <label>Tarea</label>
                <input type="text" name="tarea" placeholder="Añadir tarea al proyecto actual"
                id="tarea"/>
            </div>
            <div class="opciones">
                <input type="submit" class="submit-nueva-tarea" name="tarea" value="Añadir tarea"/>
            <button type="button" class="cerrar-modal">Cancelar</button>
            </div>
        </form>
    `;
        setTimeout(() => {
            const formulario = document.querySelector(".formulario");
            formulario.classList.add("animar");
        }, 0);

        modal.addEventListener("click", function (e) {
            e.preventDefault();

            if (e.target.classList.contains("cerrar-modal")) {
                const formulario = document.querySelector(".formulario");
                formulario.classList.add("cerrar");
                setTimeout(() => {
                    modal.remove();
                }, 300);
            }
            if (e.target.classList.contains("submit-nueva-tarea")) {
                submitFormularioNuevaTarea();
            }
        });

        document.querySelector(".dashboard").appendChild(modal);
    }

    function submitFormularioNuevaTarea() {
        const tarea = document.querySelector("#tarea").value.trim();

        if (tarea === "") {
            // Mostrar una alerta de error
            mostrarAlerta(
                "Debe indicar un nombre a la tarea",
                "error",
                document.querySelector(".formulario legend")
            );
            return;
        }
    }

    // Mustra un mensaje en la interfaz
    function mostrarAlerta(mensaje, tipo, referencia) {
        // Previene creación de múltiples alertas
        const alertaPrevia = document.querySelector(".alerta");
        if (alertaPrevia) {
            alertaPrevia.remove();
        }
        const alerta = document.createElement("DIV");
        alerta.classList.add("alerta", tipo);
        alerta.textContent = mensaje;

        // Inserta la alerta antes del legend
        referencia.parentElement.insertBefore(
            alerta,
            referencia.nextElementSibling
        );

        // Eliminar la alerta tras 5 segundos
        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }
})();
