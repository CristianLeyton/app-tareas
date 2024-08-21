{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>App Tareas | CDL</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Fonts -->
    <!-- Styles -->
    @livewireStyles
</head> --}}

<x-guest-layout class="">

    <header class="bg-white shadow">

        <div class="container mx-auto py-3 sm:py-6 px-4">
            <div class="flex justify-between">
                
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('inicio') }}">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    </div>

                    <navbar
                    class="flex items-center bg-dots-darker bg-center selection:bg-indigo-500 selection:text-white">
                    @if (Route::has('login'))
                        <div class="">
                            @auth
                                <a href="{{ url('/inicio') }}"
                                    class="p-1 text-sm font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Inicio</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="p-1 text-sm font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Acceder</a>
            
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="p-1 text-sm ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Registrarse</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </navbar>
            </div>
        </div>
    </header>

    <section class="container mx-auto p-5 text-sm flex items-center justify-between w-full gap-8 text-pretty" id="alert"><span>Si no te registras, las tareas que crees, solo se guardaran de manera local en este dispositivo. <br> <span  class="font-semibold text-indigo-500" >Accede para poder utilizar todas las funciones.</span> </span> <button class="text-xs p-1 btnPrimary rounded">Entendido</button> </section>

    <main class="">
        <div class="bg-[#F3F4F6] p-0 pt-4 sm:p-4">
            <div class="dia49 container mx-auto">
                <header>
                    <button title="Crear nueva tarea" class="btnPrimary openModalNewTask font-semibold">
                        Nueva Tarea <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                style="fill: currentColor;transform: ;msFilter:;">
                                <path
                                    d="M5 21h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm2-10h4V7h2v4h4v2h-4v4h-2v-4H7v-2z">
                                </path>
                            </svg></span>
                    </button>
                    <div class="filters">
                        <label>
                            Etiquetas:
                            <select name="tags" id="filterTags">
                                <option value="">Todas</option>
                                <option value="importante">Importante</option>
                                <option value="opcional">Opcional</option>
                            </select>
                        </label>

                        <label>
                            Mostrar primero:
                            <select name="order" id="order">
                                <option id="firstOld" value="antigua">Más antigua</option>
                                <option id="firstNew" value="nueva">Más nueva</option>
                            </select>
                        </label>
                    </div>
                </header>

                <main class="py-4 bg-white">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col" class="">
                                    <span class="firstCol"> Completada </span>
                                    <span class="firstColMobile">
                                        <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                style="fill: currentColor;transform: ;msFilter:;">
                                                <path
                                                    d="M7 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H7zm4 10.414-2.707-2.707 1.414-1.414L11 12.586l3.793-3.793 1.414 1.414L11 15.414z">
                                                </path>
                                            </svg></i>
                                    </span>
                                </th>
                                <th scope="col"> Nombre </th>
                                <th scope="col etiquetasCol"> Etiquetas </th>
                                <th scope="col"> Acciones </th>
                            </tr>
                        </thead>
                        <tbody id="tableTasks">
                            <tr class="">
                                <th class="font-normal"> No hay ninguna tarea pendiente. </th>
                            </tr>
                        </tbody>
                    </table>
                </main>

                <!-- MODALES -->
                <dialog id="newTaskModal">
                    <div class="createNewTask">
                        <header>Nueva tarea:</header>
                        <form id="newTaskForm">
                            <label class="input">
                                Nombre:
                                <input required type="text" id="nameNewTask"
                                    placeholder="Ingrese el nombre de la tarea" />
                            </label>

                            <label class="input">
                                Detalles:
                                <textarea id="descriptionNewTask" placeholder="De ser necesario, puede agregar detalles..."></textarea>
                            </label>

                            <div class="inputTags">
                                Etiquetas:

                                <label class="inputCheckbox tagImportant">
                                    <input type="checkbox" id="tagImportantNewTask" />
                                    <span class=""><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24"
                                            style="fill: currentColor;transform: ;msFilter:;">
                                            <path
                                                d="M19 10.132v-6c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2V22l7-4.666L19 22V10.132z">
                                            </path>
                                        </svg>
                                    </span>Importante
                                </label>

                                <label class="inputCheckbox tagOpcional">
                                    <input type="checkbox" id="tagOpcionalNewTask" />
                                    <span class=""><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24"
                                            style="fill: currentColor;transform: ;msFilter:;">
                                            <path
                                                d="M19 10.132v-6c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2V22l7-4.666L19 22V10.132z">
                                            </path>
                                        </svg>
                                    </span>Opcional
                                </label>
                            </div>
                        </form>
                    </div>

                    <footer>
                        <button class="closeModalNewTask btnSecondary">Cancelar</button>
                        <button form="newTaskForm" type="submit" class="btnCreateNewTask btnPrimary">Guardar</button>
                    </footer>
                </dialog>

                <dialog id="viewDetailsModal">
                    <div class="viewTask">
                        <header>Resumen de la tarea:</header>
                        <p>
                            <span class="taskSpan">Nombre:</span>
                            <span class="viewNameTask"></span>
                        </p>
                        <p>
                            <span class="taskSpan">Detalles:</span>
                            <span class="viewDetailTask"></span>
                        </p>
                        <p>
                            <span class="taskSpan">Etiquetas:</span>
                            <span class="viewTagsTask"></span>
                        </p>
                    </div>
                    <footer>
                        <button class="closeModalViewTask btnSecondary">Cerrar</button>
                    </footer>
                </dialog>

                <dialog id="editTaskModal">
                    <div class="editTask">
                        <header>Editar tarea:</header>
                        <form id="editTaskForm">
                            <label class="input">
                                Nombre:
                                <input required type="text" id="nameEditTask" />
                            </label>

                            <label class="input">
                                Detalles:
                                <textarea id="descriptionEditTask"></textarea>
                            </label>

                            <div class="inputTags">
                                Etiquetas:

                                <label class="inputCheckbox tagImportant">
                                    <input type="checkbox" id="tagImportantEditTask" />
                                    <span class=""><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24"
                                            style="fill: currentColor;transform: ;msFilter:;">
                                            <path
                                                d="M19 10.132v-6c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2V22l7-4.666L19 22V10.132z">
                                            </path>
                                        </svg>
                                    </span>Importante
                                </label>

                                <label class="inputCheckbox tagOpcional">
                                    <input type="checkbox" id="tagOpcionalEditTask" />
                                    <span class=""><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24"
                                            style="fill: currentColor;transform: ;msFilter:;">
                                            <path
                                                d="M19 10.132v-6c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2V22l7-4.666L19 22V10.132z">
                                            </path>
                                        </svg>
                                    </span>Opcional
                                </label>
                            </div>
                        </form>
                    </div>

                    <footer>
                        <button class="closeModalEditTask btnSecondary">Cancelar</button>
                        <button form="editTaskForm" class="btnSaveEdit btnPrimary">Guardar</button>
                    </footer>
                </dialog>

                <dialog id="deleteTaskModal">
                    <div class="deleteTask">
                        <header>
                            <i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;">
                                    <path d="M11.001 10h2v5h-2zM11 16h2v2h-2z"></path>
                                    <path
                                        d="M13.768 4.2C13.42 3.545 12.742 3.138 12 3.138s-1.42.407-1.768 1.063L2.894 18.064a1.986 1.986 0 0 0 .054 1.968A1.984 1.984 0 0 0 4.661 21h14.678c.708 0 1.349-.362 1.714-.968a1.989 1.989 0 0 0 .054-1.968L13.768 4.2zM4.661 19 12 5.137 19.344 19H4.661z">
                                    </path>
                                </svg></i> ¿Eliminar tarea?
                        </header>
                        <p>¿Estás seguro? ¡Esta acción no se puede revertir!</p>
                    </div>
                    <footer>
                        <button class="btnDelete">Eliminar</button>
                        <button class="closeModalDeleteTask btnSecondary">Cerrar</button>
                    </footer>
                </dialog>
            </div>
        </div>
    </main>

    <script>
        const tableTasks = document.querySelector("#tableTasks");

        const importante = "Importante";
        const opcional = "Opcional";

        let tasks = [];

        function getTasks() {
            let localTasks = JSON.parse(localStorage.getItem("tasks"));
            if (localTasks != null && localTasks != 0) {
                tasks = localTasks; //Guarda todas las tareas del localstorage en este array
                tableTasks.innerHTML = "";

                localTasks.forEach((task) => {
                    const rowTask = document.createElement("tr"); //Creo una fila

                    if (task.completed) {
                        rowTask.classList.add("noteCompleted");
                    }

                    const tdTask1 = document.createElement("td"); //Primer columna
                    const btnCheckBox = document.createElement("button");
                    btnCheckBox.classList.add("checkboxCompleted");
                    btnCheckBox.innerHTML = `                  <i
                        ><svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 24 24"
                          style="fill: currentColor;transform: ;msFilter:;"
                          ><path
                            d="M7 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H7zm4 10.414-2.707-2.707 1.414-1.414L11 12.586l3.793-3.793 1.414 1.414L11 15.414z"
                          ></path></svg
                        ></i
                      >`; // Es el svg del boton del checkbox
                    btnCheckBox.addEventListener("click", () => {
                        taskCompleted(task);
                    }); //Marca como completada la tarea
                    btnCheckBox.title = "Completada";
                    tdTask1.appendChild(btnCheckBox);
                    rowTask.appendChild(tdTask1);

                    const tdTask2 = document.createElement("td"); //Segunda columna
                    tdTask2.classList.add("note");
                    tdTask2.textContent = task.name;
                    rowTask.appendChild(tdTask2);

                    const tdTask3 = document.createElement("td"); //Tercer columna

                    if (task.tags[0] == importante) {
                        const span1 = document.createElement("span");
                        span1.classList.add("tagImportant");
                        span1.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M19 10.132v-6c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2V22l7-4.666L19 22V10.132z"></path></svg>
                    ${importante}`;
                        tdTask3.appendChild(span1);
                    }

                    if (task.tags[1] == opcional) {
                        const span2 = document.createElement("span");
                        span2.classList.add("tagOpcional");
                        span2.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M19 10.132v-6c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2V22l7-4.666L19 22V10.132z"></path></svg>
                      Opcional`;
                        tdTask3.appendChild(span2);
                    }

                    rowTask.appendChild(tdTask3);

                    const tdTask4 = document.createElement("td"); //Cuarta columnda
                    const btnDetails = document.createElement("button");
                    btnDetails.classList.add("btnAction");
                    btnDetails.classList.add("details");
                    btnDetails.title = "Resumen";
                    btnDetails.innerHTML =
                        `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V5h16l.002 14H4z"></path><path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z"></path></svg>`;
                    btnDetails.addEventListener("click", () => {
                        viewDetailTaskModal(task);
                    }); //Envia los detalles de la tarea al modal
                    tdTask4.appendChild(btnDetails);

                    const btnEdit = document.createElement("button");
                    btnEdit.classList.add("btnAction");
                    btnEdit.classList.add("edit");
                    btnEdit.title = "Editar";
                    btnEdit.innerHTML =
                        `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path><path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path></svg>`;
                    btnEdit.addEventListener("click", () => {
                        editTaskModal(task);
                    }); //Envia la tarea a ser editada
                    tdTask4.appendChild(btnEdit);

                    const btnDelete = document.createElement("button");
                    btnDelete.classList.add("btnAction");
                    btnDelete.classList.add("delete");
                    btnDelete.title = "Eliminar";
                    btnDelete.innerHTML =
                        `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="fill: currentColor;transform: ;msFilter:;"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg>`;
                    btnDelete.addEventListener("click", () => {
                        deleteTaskModal(task);
                    }); //Envia la tarea a ser eliminada
                    tdTask4.appendChild(btnDelete);
                    rowTask.appendChild(tdTask4);

                    tableTasks.insertAdjacentElement("beforeend", rowTask);
                });
            } else {
                tableTasks.innerHTML = `            <tr class="">
                  <th class="font-normal"> No hay ninguna tarea pendiente. </th>
                </tr>`;
            }
        }

        function taskCompleted(task) {
            task.completed = !task.completed; //Cambia el estado de la tarea
            localStorage.setItem("tasks", JSON.stringify(tasks)); //Actualiza las tareas en el localstorage
            getTasks(); //Recarga las tareas
        }

        function setTask() {
            const btnSetTask = document.querySelector(".btnCreateNewTask");

            btnSetTask.addEventListener("click", () => {
                const modalNewTask = document.querySelector("#newTaskModal");
                const taskName = document.querySelector("#nameNewTask");
                const taskDescription = document.querySelector("#descriptionNewTask");
                const tagImportantNewTask = document.querySelector(
                    "#tagImportantNewTask"
                );
                const tagOpcionalNewTask = document.querySelector(
                    "#tagOpcionalNewTask"
                );

                const newTask = {
                    //@ts-ignore
                    name: taskName.value,
                    //@ts-ignore
                    description: taskDescription.value,
                    tags: [
                        //@ts-ignore
                        tagImportantNewTask.checked ? importante : "",
                        //@ts-ignore
                        tagOpcionalNewTask.checked ? opcional : "",
                    ],
                    completed: false,
                };

                if (newTask.name) {
                    let orderTasks = localStorage.getItem("orderTasks");
                    if (orderTasks == "firstOld") {
                        tasks.push(newTask);
                    } else {
                        tasks.unshift(newTask);
                    }
                    localStorage.setItem("tasks", JSON.stringify(tasks));
                    //@ts-ignore
                    modalNewTask.close();
                    getTasks(); //Recarga las tareas
                    //@ts-ignore
                    document.querySelector("#newTaskForm")
                        .reset(); //Reinicia todos los campos del formulario
                }
            });
        }

        /* Modales */
        function createNewTaskModal() {
            const modalNewTask = document.querySelector("#newTaskModal");
            const openModalNewTask = document.querySelector(".openModalNewTask");
            const closeModalNewTask = document.querySelector(".closeModalNewTask");

            openModalNewTask.addEventListener("click", () => {
                //@ts-ignore
                modalNewTask.showModal();
            });

            closeModalNewTask.addEventListener("click", () => {
                //@ts-ignore
                modalNewTask.close();
            });
            // Escuchar clicks en el modal
            modalNewTask.addEventListener("click", (event) => {
                // Si el objetivo del click es el modal (y no su contenido), lo cerramos
                if (event.target === modalNewTask) {
                    //@ts-ignore
                    modalNewTask.close();
                }
            });
        }

        function viewDetailTaskModal(task) {
            const modalDetailTask = document.querySelector("#viewDetailsModal");
            const closeModalDetailTask = document.querySelector(
                ".closeModalViewTask"
            );

            const viewNameTask = document.querySelector(".viewNameTask");
            const viewDetailTask = document.querySelector(".viewDetailTask");
            const viewTagsTask = document.querySelector(".viewTagsTask");

            viewNameTask.textContent = task.name;
            viewDetailTask.textContent = task.description;

            const tagImportant = `<span class="tagImportant"
                      ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        style="fill: currentColor;transform: ;msFilter:;"
                        ><path
                          d="M19 10.132v-6c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2V22l7-4.666L19 22V10.132z"
                        ></path></svg
                      >
                    </span><div class="tagImportant">${importante}</div>`;
            const tagOpcional = `<span class="tagOpcional"
                      ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        style="fill: currentColor;transform: ;msFilter:;"
                        ><path
                          d="M19 10.132v-6c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2V22l7-4.666L19 22V10.132z"
                        ></path></svg
                      >
                    </span><div class="tagOpcional">${opcional}</div>`;

            viewTagsTask.innerHTML = "";
            task.tags[0] == importante ?
                viewTagsTask.insertAdjacentHTML("beforeend", tagImportant) :
                "";
            task.tags[1] == opcional ?
                viewTagsTask.insertAdjacentHTML("beforeend", tagOpcional) :
                "";
            //@ts-ignore
            modalDetailTask.showModal();

            closeModalDetailTask.addEventListener("click", () => {
                //@ts-ignore
                modalDetailTask.close();
            });
            // Escuchar clicks en el modal
            modalDetailTask.addEventListener("click", (event) => {
                // Si el objetivo del click es el modal (y no su contenido), lo cerramos
                if (event.target === modalDetailTask) {
                    //@ts-ignore
                    modalDetailTask.close();
                }
            });
        }

        function editTaskModal(task) {
            const editTaskModal = document.querySelector("#editTaskModal");
            const closeModalEditTask = document.querySelector(
                ".closeModalEditTask"
            );
            const btnEditTask = document.querySelector(".btnSaveEdit");

            const nameEditTask = document.querySelector("#nameEditTask");
            const descriptionEditTask = document.querySelector(
                "#descriptionEditTask"
            );

            const tagImportantEditTask = document.querySelector(
                "#tagImportantEditTask"
            );
            const tagOpcionalEditTask = document.querySelector(
                "#tagOpcionalEditTask"
            );

            //@ts-ignore
            nameEditTask.value = task.name;
            //@ts-ignore
            descriptionEditTask.value = task.description;

            //Limpio los chechboxs
            //@ts-ignore
            tagImportantEditTask.checked = false;
            //@ts-ignore
            tagOpcionalEditTask.checked = false;

            //Marco los checkbox correctos
            task.tags[0] == importante ? //@ts-ignore
                (tagImportantEditTask.checked = true) :
                null;
            task.tags[1] == opcional ? //@ts-ignore
                (tagOpcionalEditTask.checked = true) :
                null;

            //@ts-ignore
            editTaskModal.showModal();

            closeModalEditTask.addEventListener("click", () => {
                //@ts-ignore
                editTaskModal.close();
            });
            // Escuchar clicks en el modal
            editTaskModal.addEventListener("click", (event) => {
                // Si el objetivo del click es el modal (y no su contenido), lo cerramos
                if (event.target === editTaskModal) {
                    //@ts-ignore
                    editTaskModal.close();
                }
            });

            // Remover cualquier listener previo antes de agregar uno nuevo
            const newBtnEditTask = btnEditTask.cloneNode(true);
            btnEditTask.replaceWith(newBtnEditTask);

            //Guardar cambios
            newBtnEditTask.addEventListener("click", (e) => {
                //@ts-ignore
                if (nameEditTask.value) {
                    e.preventDefault();

                    //@ts-ignore
                    task.name = nameEditTask.value;
                    //@ts-ignore
                    task.description = descriptionEditTask.value;

                    //Marco los checkbox correctos
                    //@ts-ignore
                    tagImportantEditTask.checked == true ? //@ts-ignore
                        (task.tags[0] = importante) :
                        (task.tags[0] = "");
                    //@ts-ignore
                    tagOpcionalEditTask.checked == true ? //@ts-ignore
                        (task.tags[1] = opcional) :
                        (task.tags[1] = "");

                    localStorage.setItem("tasks", JSON.stringify(
                        tasks)); //Actualiza las tareas en el localstorage
                    getTasks(); //Recarga las tareas*/

                    //@ts-ignore
                    editTaskModal.close(); // Cierra el modal después de editar
                }
            });
        }

        function deleteTaskModal(deleteTask) {
            const deleteTaskModal = document.querySelector("#deleteTaskModal");
            const closeModalDeleteTask = document.querySelector(
                ".closeModalDeleteTask"
            );
            const btnDelete = document.querySelector(".btnDelete");
            //@ts-ignore
            deleteTaskModal.showModal();

            closeModalDeleteTask.addEventListener("click", () => {
                //@ts-ignore
                deleteTaskModal.close();
            });
            // Escuchar clicks en el modal
            deleteTaskModal.addEventListener("click", (event) => {
                // Si el objetivo del click es el modal (y no su contenido), lo cerramos
                if (event.target === deleteTaskModal) {
                    //@ts-ignore
                    deleteTaskModal.close();
                }
            });

            // Remover cualquier listener previo antes de agregar uno nuevo
            const newBtnDelete = btnDelete.cloneNode(true);
            btnDelete.replaceWith(newBtnDelete);

            //Eliminar tarea si doy click al boton "Eliminar"
            newBtnDelete.addEventListener("click", () => {
                tasks.forEach((task, i) => {
                    if (task.name == deleteTask.name) {
                        tasks.splice(i, 1);
                    }
                });
                localStorage.setItem("tasks", JSON.stringify(
                    tasks)); //Actualiza las tareas en el localstorage
                getTasks(); //Recarga las tareas*/

                //@ts-ignore
                deleteTaskModal.close(); // Cierra el modal después de eliminar
            });
        }

        function orderTasks() {
            const orderSelect = document.querySelector("#order");
            let orderTasks = localStorage.getItem("orderTasks");

            if (!orderTasks) {
                localStorage.setItem("orderTasks", "firstOld");
                orderTasks = JSON.parse(localStorage.getItem("orderTasks"));
            }

            if (orderTasks != "firstOld") {
                document.querySelector("#firstNew").setAttribute("selected", "true");
            }

            orderSelect.addEventListener("change", (event) => {
                orderTasks = localStorage.getItem("orderTasks");

                if (orderTasks == "firstOld") {
                    tasks.reverse();
                    localStorage.setItem("orderTasks", "firstNew");
                } else {
                    tasks.reverse();
                    localStorage.setItem("orderTasks", "firstOld");
                    document
                        .querySelector("#firstNew")
                        .setAttribute("selected", "true");
                }

                localStorage.setItem("tasks", JSON.stringify(
                    tasks)); //Actualiza las tareas en el localstorage
                getTasks(); //Recarga las tareas*/
            });
        }

        function filterTasks() {
            const filter = document.querySelector("#filterTags");
            const tableTasks = document.querySelector("#tableTasks");

            filter.addEventListener("change", (event) => {
                //@ts-ignore
                switch (filter.value) {
                    case "importante":
                        getTasks(); //Recargo todas las tareas

                        tableTasks.childNodes.forEach((row) => {
                            // Quito las filas que no tengan el tag 'Importante'
                            //@ts-ignore
                            let tags = row.children[2]; // Usar children en lugar de childNodes

                            let tag = false;
                            if (tags && tags.hasChildNodes()) {
                                tags.childNodes.forEach((span) => {
                                    if (span.textContent.trim() === "Importante") {
                                        tag = true;
                                    }
                                });

                                if (!tag) {
                                    //@ts-ignore
                                    row.style.display =
                                        'none'; // Ocultar fila si no tiene 'Importante'
                                }
                            } else {
                                //@ts-ignore
                                row.style.display = 'none'; // Ocultar fila si no tiene hijos */
                            }
                        });

                        break;
                    case "opcional":
                        getTasks(); //Recargo todas las tareas

                        tableTasks.childNodes.forEach((row) => {
                            // Quito las filas que no tengan el tag 'Opcional'
                            //@ts-ignore
                            let tags = row.children[2]; // Usar children en lugar de childNodes

                            let tag = false;
                            if (tags && tags.hasChildNodes()) {
                                tags.childNodes.forEach((span) => {
                                    if (span.textContent.trim() === "Opcional") {
                                        tag = true;
                                    }
                                });

                                if (!tag) {
                                    //@ts-ignore
                                    row.style.display =
                                        'none'; // Ocultar fila si no tiene 'Importante'
                                }
                            } else {
                                //@ts-ignore
                                row.style.display = 'none'; // Ocultar fila si no tiene hijos */
                            }
                        });
                        break;
                    default:
                        getTasks(); //Recargo todas las tareas
                        break;
                }
            });
        }
        /* Llamo a las funciones */
        getTasks();
        setTask();
        createNewTaskModal();
        orderTasks();
        filterTasks();


        btnCloseAlert = document.querySelector('#alert button');
        alertRegister = document.querySelector('#alert');

        if (localStorage.getItem('cdlapptareas') == 'hideAlert') { //Oculta la tarea si ya se dio click en el boton "Entendido."
            alertRegister.classList.add('hidden');
        }

        btnCloseAlert.addEventListener('click', ()=> {
            alertRegister.classList.add('hidden');
            localStorage.setItem('cdlapptareas', 'hideAlert');
        })

    </script>
</x-guest-layout>

</html>
