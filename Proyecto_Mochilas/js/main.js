document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const role = document.getElementById('role').value;
            
            // Validación básica
            if (!email || !password || !role) {
                alert('Por favor complete todos los campos');
                return;
            }
            
            // Simulación de autenticación
            authenticateUser(email, password, role);
        });
    }
});

function authenticateUser(email, password, role) {
    // En una aplicación real, aquí iría una llamada al servidor
    console.log(`Autenticando: ${email} con rol ${role}`);
    
    // Simulamos un retraso de red
    setTimeout(() => {
        // Guardamos el rol en localStorage para simular la sesión
        localStorage.setItem('currentUser', JSON.stringify({
            email: email,
            role: role
        }));
        
        // Redirigimos según el rol
        switch(role) {
            case 'admin':
                window.location.href = '../admin/panel.html';
                break;
            case 'vendedor':
                window.location.href = '../vendedor/ventas.html';
                break;
            case 'cliente':
                window.location.href = '../cliente/perfil.html';
                break;
            default:
                window.location.href = '../../index.html';
        }
    }, 1000);
}

// Función para verificar si hay un usuario logueado al cargar la página
function checkAuth() {
    const currentUser = JSON.parse(localStorage.getItem('currentUser'));
    
    if (currentUser) {
        // Si el usuario está logueado, redirigir según su rol
        switch(currentUser.role) {
            case 'admin':
                if (!window.location.pathname.includes('/admin/')) {
                    window.location.href = 'pages/admin/panel.html';
                }
                break;
            case 'vendedor':
                if (!window.location.pathname.includes('/vendedor/')) {
                    window.location.href = 'pages/vendedor/ventas.html';
                }
                break;
            case 'cliente':
                if (!window.location.pathname.includes('/cliente/')) {
                    window.location.href = 'pages/cliente/perfil.html';
                }
                break;
        }
    } else {
        // Si no está logueado y está en una página protegida, redirigir a login
        if (window.location.pathname.includes('/admin/') || 
            window.location.pathname.includes('/vendedor/') || 
            window.location.pathname.includes('/cliente/')) {
            window.location.href = 'pages/login.html';
        }
    }
}

// Ejecutar la verificación al cargar
checkAuth();