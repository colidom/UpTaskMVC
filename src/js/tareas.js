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
    }, 3000);
    document.querySelector("body").appendChild(modal);
  }
})();
