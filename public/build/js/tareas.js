!function(){!async function(){try{const t="/api/tareas?id="+d(),a=await fetch(t),o=await a.json();e=o.tareas,n()}catch(e){console.log(e)}}();let e=[],t=[];document.querySelector("#agregar-tarea").addEventListener("click",(function(){o()}));function a(a){const o=a.target.value;t=""!==o?e.filter(e=>e.estado===o):[],n()}function n(){!function(){const e=document.querySelector("#listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}(),function(){const t=e.filter(e=>"0"===e.estado),a=document.querySelector("#pendientes");0==t.length?a.disabled=!0:a.disabled=!1}(),function(){const t=e.filter(e=>"1"===e.estado),a=document.querySelector("#completadas");0==t.length?a.disabled=!0:a.disabled=!1}();const a=t.length?t:e;if(0===a.length){const e=document.querySelector("#listado-tareas"),t=document.createElement("LI");return t.textContent="No hay tareas",t.classList.add("no-tareas"),void e.appendChild(t)}const s={0:"Pendiente",1:"Completada"};a.forEach(t=>{const a=document.createElement("LI");a.dataset.tareaId=t.id,a.classList.add("tarea");const i=document.createElement("P");i.textContent=t.nombre,i.onclick=function(){o(!0,{...t})};const l=document.createElement("DIV");l.classList.add("opciones");const u=document.createElement("BUTTON");u.classList.add("estado-tarea"),u.classList.add(""+s[t.estado].toLowerCase()),u.textContent=s[t.estado],u.dataset.estadoTarea=t.estado,u.onclick=function(){!function(e){const t="1"===e.estado?"0":"1";e.estado=t,c(e)}({...t})};const m=document.createElement("BUTTON");m.classList.add("eliminar-tarea"),m.dataset.idTarea=t.id,m.textContent="Eliminar",m.onclick=function(){!function(t){Swal.fire({title:"¿Desea eliminar la tarea?",showCancelButton:!0,confirmButtonText:"Si",cancelButtonText:"No"}).then(a=>{a.isConfirmed&&async function(t){const{estado:a,id:o,nombre:c}=t,s=new FormData;s.append("id",o),s.append("nombre",c),s.append("estado",a),s.append("proyectoId",d());try{const a="http://localhost:3000/api/tarea/eliminar",o=await fetch(a,{method:"POST",body:s}),c=await o.json();c.resultado&&r(c.mensaje,c.tipo,document.querySelector(".contenedor-nueva-tarea")),Swal.fire("¡Eliminada!",c.mensaje,"success"),e=e.filter(e=>e.id!==t.id),n()}catch(e){}}(t)})}(t)},l.appendChild(u),l.appendChild(m),a.appendChild(i),a.appendChild(l);document.querySelector("#listado-tareas").appendChild(a)})}function o(t=!1,a={}){const o=document.createElement("DIV");o.classList.add("modal"),o.innerHTML=`\n        <form class="formulario nueva-tarea">\n            <legend>${t?"Editar tarea":"Añade una nueva tarea"}</legend>\n            <div class="campo">\n                <label>Nombre</label>\n                <input \n                type="text" name="tarea" \n                placeholder="${a.nombre?"Nombre de la tarea":"Añadir tarea al proyecto actual"}"\n                id="tarea"\n                value="${a.nombre?a.nombre:""}"\n            >\n            </div>\n            <div class="opciones">\n                <input \n                    type="submit" \n                    class="submit-nueva-tarea" \n                    name="tarea" \n                    value="${t?"Guardar cambios":"Añadir tarea"}"\n                >\n                <button type="button" class="cerrar-modal">Cancelar</button>\n            </div>\n        </form>\n    `,setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),o.addEventListener("click",(function(s){if(s.preventDefault(),s.target.classList.contains("cerrar-modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{o.remove()},300)}if(s.target.classList.contains("submit-nueva-tarea")){const o=document.querySelector("#tarea").value.trim();if(""===o)return void r("Debe indicar un nombre a la tarea","error",document.querySelector(".formulario legend"));t?(a.nombre=o,c(a)):async function(t){const a=new FormData;a.append("nombre",t),a.append("proyectoId",d());try{const o="http://localhost:3000/api/tarea",c=await fetch(o,{method:"POST",body:a}),d=await c.json();if(r(d.mensaje,d.tipo,document.querySelector(".formulario legend")),"exito"===d.tipo){const a=document.querySelector(".modal");setTimeout(()=>{a.remove()},2e3);const o={id:String(d.id),nombre:t,estado:"0",proyectoId:d.proyectoId};e=[...e,o],n(),console.log(o)}}catch(e){console.log(e)}}(o)}})),document.querySelector(".dashboard").appendChild(o)}function r(e,t,a){const n=document.querySelector(".alerta");n&&n.remove();const o=document.createElement("DIV");o.classList.add("alerta",t),o.textContent=e,a.parentElement.insertBefore(o,a.nextElementSibling),setTimeout(()=>{o.remove()},5e3)}async function c(t){const{estado:a,id:o,nombre:r,proyectoId:c}=t,s=new FormData;s.append("id",o),s.append("nombre",r),s.append("estado",a),s.append("proyectoId",d());try{const t="http://localhost:3000/api/tarea/actualizar",c=await fetch(t,{method:"POST",body:s}),d=await c.json();if("exito"===d.respuesta.tipo){Swal.fire(d.respuesta.mensaje,d.respuesta.mensaje,"success");const t=document.querySelector(".modal");t&&t.remove(),e=e.map(e=>(e.id===o&&(e.estado=a,e.nombre=r),e)),n()}}catch(e){console.log(e)}}function d(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).id}document.querySelectorAll('#filtros input[type="radio"]').forEach(e=>{e.addEventListener("input",a)})}();