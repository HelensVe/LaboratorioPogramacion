// assets/js/admin.js

document.addEventListener('DOMContentLoaded', () => {
    // Manejar logout
    document.getElementById('logout-btn').addEventListener('click', () => {
        // Simular logout
        if (confirm('¿Estás seguro que deseas cerrar sesión?')) {
            alert('Sesión cerrada correctamente');
            window.location.href = '../index.html';
        }
    });
    
    // Hacer filas de la tabla clickeables
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.classList.add('clickable');
        row.addEventListener('click', () => {
            // Simular ver detalles del pedido
            const orderId = row.cells[0].textContent;
            alert(`Mostrando detalles del pedido ${orderId}`);
            // En un caso real, redirigiría a una página de detalles
            // window.location.href = `orders.html?id=${orderId}`;
        });
    });
    
    // Alternar entre páginas del admin
    const navLinks = document.querySelectorAll('.admin-nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            if (link.getAttribute('href').startsWith('http')) return;
            
            e.preventDefault();
            navLinks.forEach(l => l.parentNode.classList.remove('active'));
            link.parentNode.classList.add('active');
            
            // Simular cambio de página (en un proyecto real sería una navegación normal)
            const page = link.getAttribute('href').replace('.html', '');
            document.querySelector('.admin-main').innerHTML = getPageContent(page);
        });
    });
});

// Función simulada para cambiar contenido (en un proyecto real serían páginas separadas)
function getPageContent(page) {
    if (page === 'products') {
        return `
            <header class="admin-header">
                <h1>Productos</h1>
                <div class="admin-user">
                    <span>👤 Admin</span>
                    <button id="logout-btn">Cerrar sesión</button>
                </div>
            </header>
            
            <section class="admin-actions">
                <button class="btn">+ Añadir Producto</button>
                <div class="search-bar">
                    <input type="text" placeholder="Buscar productos...">
                    <button>🔍</button>
                </div>
            </section>
            
            <section class="admin-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#1001</td>
                            <td>Mochila Urbana Minimal</td>
                            <td>$59.99</td>
                            <td>24</td>
                            <td>
                                <button class="action-btn">Editar</button>
                                <button class="action-btn danger">Eliminar</button>
                            </td>
                        </tr>
                        <!-- Más filas... -->
                    </tbody>
                </table>
            </section>
        `;
    }
    
    // Contenido por defecto (dashboard)
    return `
        <header class="admin-header">
            <h1>Dashboard</h1>
            <div class="admin-user">
                <span>👤 Admin</span>
                <button id="logout-btn">Cerrar sesión</button>
            </div>
        </header>

        <section class="admin-stats">
            <div class="stat-card">
                <h3>Ventas Hoy</h3>
                <p>$1,245.00</p>
                <span class="stat-trend up">↑ 12%</span>
            </div>
            <div class="stat-card">
                <h3>Pedidos Nuevos</h3>
                <p>8</p>
                <span class="stat-trend up">↑ 5%</span>
            </div>
            <div class="stat-card">
                <h3>Productos</h3>
                <p>24</p>
                <span class="stat-trend down">↓ 2%</span>
            </div>
            <div class="stat-card">
                <h3>Clientes</h3>
                <p>143</p>
                <span class="stat-trend up">↑ 8%</span>
            </div>
        </section>

        <section class="admin-recent">
            <h2>Pedidos Recientes</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1001</td>
                        <td>Juan Pérez</td>
                        <td>2023-06-15</td>
                        <td>$189.98</td>
                        <td><span class="status shipped">Enviado</span></td>
                        <td><button class="action-btn">Ver</button></td>
                    </tr>
                    <tr>
                        <td>#1000</td>
                        <td>María Gómez</td>
                        <td>2023-06-14</td>
                        <td>$79.99</td>
                        <td><span class="status delivered">Entregado</span></td>
                        <td><button class="action-btn">Ver</button></td>
                    </tr>
                </tbody>
            </table>
        </section>
    `;
}