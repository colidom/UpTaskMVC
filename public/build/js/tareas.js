!function(){!async function(){try{const a="/api/tareas?id="+o(),n=await fetch(a),r=await n.json();e=r.tareas,t()}catch(e){console.log(e)}}();let e=[];function t(){if(function(){const e=document.querySelector("#listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}(),0===e.length){const e=document.querySelector("#listado-tareas"),t=document.createElement("LI");return t.textContent="No hay tareas",t.classList.add("no-tareas"),void e.appendChild(t)}const r={0:"Pendiente",1:"Completada"};e.forEach(c=>{const d=document.createElement("LI");d.dataset.tareaId=c.id,d.classList.add("tarea");const i=document.createElement("P");i.textContent=c.nombre,i.onclick=function(){a(!0,c)};const s=document.createElement("DIV");s.classList.add("opciones");const l=document.createElement("BUTTON");l.classList.add("estado-tarea"),l.classList.add(""+r[c.estado].toLowerCase()),l.textContent=r[c.estado],l.dataset.estadoTarea=c.estado,l.onclick=function(){!function(a){const r="1"===a.estado?"0":"1";a.estado=r,async function(a){const{estado:r,id:c,nombre:d,proyectoId:i}=a,s=new FormData;s.append("id",c),s.append("nombre",d),s.append("estado",r),s.append("proyectoId",o());try{const a="http://localhost:3000/api/tarea/actualizar",o=await fetch(a,{method:"POST",body:s}),i=await o.json();"exito"===i.respuesta.tipo&&(n(i.respuesta.mensaje,i.respuesta.tipo,document.querySelector(".contenedor-nueva-tarea")),e=e.map(e=>(e.id===c&&(e.estado=r,e.nombre=d),e)),t())}catch(e){console.log(e)}}(a)}({...c})};const u=document.createElement("BUTTON");u.classList.add("eliminar-tarea"),u.dataset.idTarea=c.id,u.textContent="Eliminar",u.onclick=function(){!function(a){Swal.fire({title:"¿Desea eliminar la tarea?",showCancelButton:!0,confirmButtonText:"Si",cancelButtonText:"No"}).then(r=>{r.isConfirmed&&async function(a){const{estado:r,id:c,nombre:d}=a,i=new FormData;i.append("id",c),i.append("nombre",d),i.append("estado",r),i.append("proyectoId",o());try{const o="http://localhost:3000/api/tarea/eliminar",r=await fetch(o,{method:"POST",body:i}),c=await r.json();c.resultado&&n(c.mensaje,c.tipo,document.querySelector(".contenedor-nueva-tarea")),Swal.fire("¡Eliminada!",c.mensaje,"success"),e=e.filter(e=>e.id!==a.id),t()}catch(e){}}(a)})}(c)},s.appendChild(l),s.appendChild(u),d.appendChild(i),d.appendChild(s);document.querySelector("#listado-tareas").appendChild(d)})}function a(a=!1,r={}){console.log(a);const c=document.createElement("DIV");c.classList.add("modal"),c.innerHTML=`\n        <form class="formulario nueva-tarea">\n            <legend>${a?"Editar tarea":"Añade una nueva tarea"}</legend>\n            <div class="campo">\n                <label>Nombre</label>\n                <input type="text" name="tarea" placeholder="Añadir tarea al proyecto actual"\n                id="tarea"\n                value="${r.nombre?r.nombre:""}"\n            >\n            </div>\n            <div class="opciones">\n                <input type="submit" class="submit-nueva-tarea" name="tarea" value="${a?"Guardar cambios":"Añadir tarea"}"/>\n            <button type="button" class="cerrar-modal">Cancelar</button>\n            </div>\n        </form>\n    `,setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),c.addEventListener("click",(function(a){if(a.preventDefault(),a.target.classList.contains("cerrar-modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{c.remove()},300)}a.target.classList.contains("submit-nueva-tarea")&&function(){const a=document.querySelector("#tarea").value.trim();if(""===a)return void n("Debe indicar un nombre a la tarea","error",document.querySelector(".formulario legend"));!async function(a){const r=new FormData;r.append("nombre",a),r.append("proyectoId",o());try{const o="http://localhost:3000/api/tarea",c=await fetch(o,{method:"POST",body:r}),d=await c.json();if(n(d.mensaje,d.tipo,document.querySelector(".formulario legend")),"exito"===d.tipo){const n=document.querySelector(".modal");setTimeout(()=>{n.remove()},2e3);const o={id:String(d.id),nombre:a,estado:"0",proyectoId:d.proyectoId};e=[...e,o],t(),console.log(o)}}catch(e){console.log(e)}}(a)}()})),document.querySelector(".dashboard").appendChild(c)}function n(e,t,a){const n=document.querySelector(".alerta");n&&n.remove();const o=document.createElement("DIV");o.classList.add("alerta",t),o.textContent=e,a.parentElement.insertBefore(o,a.nextElementSibling),setTimeout(()=>{o.remove()},5e3)}function o(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).id}document.querySelector("#agregar-tarea").addEventListener("click",(function(){a()}))}();