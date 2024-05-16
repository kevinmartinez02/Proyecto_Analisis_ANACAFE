// Constantes para el div contenedor de los inputs y el botón de agregar
const contenedor = document.querySelector('#dinamic');
const btnAgregar = document.querySelector('#agregar');

// Variable para el total de elementos agregados
let total = 1;

/**
 * Método que se ejecuta cuando se da clic al botón de agregar elementos
 */
btnAgregar.addEventListener('click', e => {
    let div = document.createElement('div');
    div.classList.add('container-lg', 'p-1', 'g-col-6', 'mb-3'); // Añadir clases de Bootstrap
    div.innerHTML = `
        <label>${total++}</label> - 
        <input type="text" name="nombreSubactividad[]" placeholder="Nombre" required> 
        <textarea name="descripcion[]" style="height: 50px; vertical-align: top;" placeholder="Descripción" required></textarea>  
        <button onclick="eliminar(this)" type="button" class="btn btn-danger">Eliminar</button>
    `;
    contenedor.appendChild(div);
})


/**
 * Método para eliminar el div contenedor del input
 * @param {this} e 
 */
const eliminar = (e) => {
    const divPadre = e.parentNode;
    contenedor.removeChild(divPadre);
    actualizarContador();
};

/**
 * Método para actualizar el contador de los elementos agregados
*/
const actualizarContador = () => {
    let divs = contenedor.children;
    total = 1;
    for (let i = 0; i < divs.length; i++) {
        divs[i].children[0].innerHTML = total++;
    }//end for
};