// Datos de productos
const products = [
    {
        id: 1,
        name: "Mochila Urbana Minimal",
        price: 59.99,
        image: "assets/css/images/mochila_urbana_minimalista.png",
        description: "Perfecta para el día a día en la ciudad con estilo minimalista."
    },
    {
        id: 2,
        name: "Mochila Viajera Eco",
        price: 79.99,
        image: "assets/css/images/mochila_viaje.png",
        description: "Ideal para viajes cortos, hecha con materiales ecológicos."
    },
    {
        id: 3,
        name: "Mochila Laptop Segura",
        price: 89.99,
        image: "assets/css/images/mochila_laptop.png",
        description: "Protege tu laptop con nuestro diseño acolchado y seguro."
    },
    {
        id: 4,
        name: "Mochila Aventura Trek",
        price: 99.99,
        image: "assets/css/images/mochia_trek.png",
        description: "Diseñada para aventureros con múltiples compartimentos."
    }
];

// Mostrar productos destacados
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById("featured-products");
    
    // Limpiar contenedor primero
    container.innerHTML = '';
    
    products.forEach(product => {
        const productCard = document.createElement("div");
        productCard.classList.add("product-card"); // Cambié "product" por "product-card" para coincidir con el CSS
        
        productCard.innerHTML = `
            <img src="${product.image}" alt="${product.name}" class="product-image" onerror="this.src='assets/images/placeholder.jpg'">
            <div class="product-info">
                <h3>${product.name}</h3>
                <p>${product.description}</p>
                <span class="product-price">$${product.price.toFixed(2)}</span>
                <button class="add-to-cart" data-id="${product.id}">Añadir al carrito 🛍️</button>
            </div>
        `;
        
        container.appendChild(productCard);
    });
    
    // Manejar clic en botones "Añadir al carrito"
    container.addEventListener('click', (e) => {
        if (e.target.classList.contains('add-to-cart')) {
            const productId = parseInt(e.target.dataset.id);
            addToCart(productId);
        }
    });
    
    // Actualizar contador del carrito al cargar la página
    updateCartCount();
});

// Función para agregar al carrito
function addToCart(productId, quantity = 1) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cart.push({ id: productId, quantity: quantity });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    
    // Mostrar notificación
    const notification = document.createElement('div');
    notification.className = 'cart-notification';
    notification.innerHTML = `
        <p>Producto añadido al carrito 🛒</p>
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Función para actualizar el contador del carrito
function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const count = cart.reduce((total, item) => total + item.quantity, 0);
    document.getElementById('cart-count').textContent = count;
}