document.addEventListener('DOMContentLoaded', function() {
    // Verificar autenticación y rol
    const currentUser = JSON.parse(localStorage.getItem('currentUser'));
    
    if (!currentUser || currentUser.role !== 'admin') {
        window.location.href = '../../login.html';
        return;
    }
    
    // Cargar datos del dashboard
    loadDashboardData();
    
    // Configurar logout
    document.getElementById('logout').addEventListener('click', function(e) {
        e.preventDefault();
        localStorage.removeItem('currentUser');
        window.location.href = '../../index.html';
    });
});

function loadDashboardData() {
    // Simular carga de datos
    setTimeout(() => {
        document.getElementById('total-products').textContent = '125';
        document.getElementById('total-users').textContent = '84';
        document.getElementById('today-sales').textContent = '$3,450';
        document.getElementById('growth-rate').textContent = '12%';
        
        // Simular órdenes recientes
        const orders = [
            { id: 'ORD-1001', customer: 'Juan Pérez', date: '2023-11-15', total: '$120', status: 'Completado' },
            { id: 'ORD-1002', customer: 'María Gómez', date: '2023-11-15', total: '$85', status: 'En proceso' },
            { id: 'ORD-1003', customer: 'Carlos Ruiz', date: '2023-11-14', total: '$210', status: 'Completado' },
            { id: 'ORD-1004', customer: 'Ana López', date: '2023-11-14', total: '$65', status: 'Cancelado' },
            { id: 'ORD-1005', customer: 'Pedro Martínez', date: '2023-11-13', total: '$175', status: 'Completado' }
        ];
        
        const tbody = document.querySelector('#orders-table tbody');
        tbody.innerHTML = '';
        
        orders.forEach(order => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${order.id}</td>
                <td>${order.customer}</td>
                <td>${order.date}</td>
                <td>${order.total}</td>
                <td><span class="status-badge ${order.status.toLowerCase().replace(' ', '-')}">${order.status}</span></td>
                <td>
                    <button class="btn-action btn-view">Ver</button>
                    <button class="btn-action btn-edit">Editar</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }, 1000);
}