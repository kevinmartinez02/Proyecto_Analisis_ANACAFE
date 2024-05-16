const form = document.querySelector('form');

// Agregar un event listener para el submit del formulario
form.addEventListener('submit', e => {
    e.preventDefault(); // Prevenir el comportamiento por defecto del submit

    // Crear un nuevo objeto FormData para enviar los datos del formulario
    const formData = new FormData(form);

    // Enviar los datos al backend utilizando Fetch API
    fetch(form.action, {
        method: form.method,
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Hubo un problema al enviar los datos.');
        }
        return response.json(); // Si el request es exitoso, convertir la respuesta a JSON
    })
    .then(data => {
        console.log(data); // Hacer algo con la respuesta del backend si es necesario
        // Por ejemplo, redireccionar a otra página
        window.location.href = "{{ route('ruta.de.redireccion') }}";
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
