<div class="">
    <div class="flex justify-between">
    <x-primary-button>Nueva tarea</x-primary-button>
    <div class="flex gap-3">
        <x-label for="etiquetas">Filtar:
        <x-select name="etiquetas" id="" class="text-sm">
            <option value="">Etiqueta</option>
            <option value="">Etiqueta 1</option>
        </x-select>
        </x-label>
        <x-label for="fecha">Ordenar:
            <x-select name="fecha" id="" class="text-sm">
                <option value="">Fecha</option>
                <option value="">Etiqueta 1</option>
            </x-select>
            </x-label>
    </div>    
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 mt-2">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="p-4">
                        Completada
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre 
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Etiquetas
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b  hover:bg-gray-50  ">
                    <td class="w-4 p-4">
                        <div class="flex items-center justify-center">
                            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                        Tarea de ejemplo
                    </th>
                    <td class="px-6 py-4">
                        Casa, Importante
                    </td>
                    <td class="text-center">
                        <x-button>Editar</x-button>
                        <x-danger-button>Eliminar</x-danger-button>
                    </td>
                </tr>
                
            </tbody>
        </table>
        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-500  mb-4 md:mb-0 block w-full md:inline md:w-auto">Mostrando <span class="font-semibold text-gray-900 ">1</span> de <span class="font-semibold text-gray-900 ">1</span></span>
            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 ">Previous</a>
                </li>
                <li>
                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 ">1</a>
                </li>
                
            <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 ">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    

</div>
