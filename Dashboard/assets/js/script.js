function showSection(id) {
    document.querySelectorAll('.section').forEach(sec => {
        sec.classList.remove('active');
    });
    document.getElementById(id).classList.add('active');

    // Actualizar menú activo
    document.querySelectorAll('.sidebar a').forEach(a => {
        a.classList.remove('active');
        if (a.getAttribute('onclick').includes(id)) {
            a.classList.add('active');
        }
    });

    if (id === 'users') {
        loadUsers();
    }
}

// Cargar usuarios desde PHP
async function loadUsers() {
    try {
        const res = await fetch('api/users.php');
        const users = await res.json();
        const tbody = document.querySelector('#users-table tbody');
        tbody.innerHTML = '';

        users.forEach(user => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${user.id}</td>
                <td>${user.username}</td>
                <td>${new Date(user.created_at).toLocaleString()}</td>
            `;
            tbody.appendChild(tr);
        });
    } catch (err) {
        console.error("Error al cargar usuarios:", err);
    }
}

// Por defecto, mostrar inicio
document.addEventListener('DOMContentLoaded', () => {
    showSection('home');

    // Conteo de usuarios
    fetch('api/user_count.php')
        .then(res => res.json())
        .then(data => {
            document.getElementById('user-count').textContent = data.count + ' usuarios';
        });
});