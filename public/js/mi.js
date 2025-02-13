
setTimeout(() => {
    let alertBox = document.querySelector('.alert');
    if (alertBox) {
        alertBox.style.transition = "opacity 1s ease-out"; // Transición suave
        alertBox.style.opacity = "0"; // Se desvanece
        setTimeout(() => {
            alertBox.remove(); // Elimina después de la animación
        }, 1000); // Espera que termine la animación (1s)
    }
}, 3000); // Inicia después de 3 segundos

