// assets/js/shop.js

document.addEventListener('DOMContentLoaded', () => {
    const productsGrid = document.getElementById('products-grid');
    const categoryFilter = document.getElementById('category-filter');
    const priceFilter = document.getElementById('price-filter');
    
    // Datos extendidos de productos
    const products = [
        {
            id: 1,
            name: "Mochila Urbana Minimal",
            price: 59.99,
            image: "assets/css/images/mochila_urbana_minimalista.png",
            description: "Perfecta para el día a día en la ciudad con estilo minimalista.",
            category: "urbanas"
        },
        {
            id: 2,
            name: "Mochila Viajera Eco",
            price: 79.99,
            image: "assets/css/images/mochila_viaje.png",
            description: "Ideal para viajes cortos, hecha con materiales ecológicos.",
            category: "viaje"
        },
        {
            id: 3,
            name: "Mochila Laptop Segura",
            price: 89.99,
            image: "assets/css/images/mochila_laptop.png",
            description: "Protege tu laptop con nuestro diseño acolchado y seguro.",
            category: "laptop"
        },
        {
            id: 4,
            name: "Mochila Aventura Trek",
            price: 99.99,
            image: "assets/css/images/mochia_trek.png",
            description: "Diseñada para aventureros con múltiples compartimentos.",
            category: "aventura"
        },
        {
            id: 5,
            name: "Mochila Weekender",
            price: 69.99,
            image: "assets/css/images/mochila_weekender.png",
            description: "Espaciosa para escapadas de fin de semana.",
            category: "viaje"
        },
        {
            id: 6,
            name: "Mochila Estudiante",
            price: 49.99,
            image: "assets/css/images/mochila_estudiante.png",
            description: "Organizada para llevar todos tus útiles escolares.",
            category: "urbanas"
        }
    ];

    // Mostrar todos los productos inicialmente
    displayProducts(products);

    // Filtros
    categoryFilter.addEventListener('change', filterProducts);
    priceFilter.addEventListener('change', filterProducts);

    function filterProducts() {
        const category = categoryFilter.value;
        const priceRange = priceFilter.value;
        
        let filtered = [...products];
        
        // Filtrar por categoría
        if (category !== 'all') {
            filtered = filtered.filter(product => product.category === category);
        }
        
        // Filtrar por precio
        if (priceRange !== 'all') {
            const [min, max] = priceRange.split('-').map(Number);
            filtered = filtered.filter(product => product.price >= min && product.price <= max);
        }
        
        displayProducts(filtered);
    }

    function displayProducts(productsToDisplay) {
        productsGrid.innerHTML = '';
        
        if (productsToDisplay.length === 0) {
            productsGrid.innerHTML = '<p class="no-products">No se encontraron productos con estos filtros. <span class="emoji">😕</span></p>';
            return;
        }
        
        productsToDisplay.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'product-card';
            productCard.innerHTML = `
                <img src="${product.image}" alt="${product.name}" class="product-image">
                <div class="product-info">
                    <h3>${product.name}</h3>
                    <p class="product-price">$${product.price.toFixed(2)}</p>
                    <p>${product.description}</p>
                    <button class="add-to-cart" data-id="${product.id}">Añadir al carrito 🛍️</button>
                    <a href="product.html?id=${product.id}" class="view-details">Ver detalles</a>
                </div>
            `;
            productsGrid.appendChild(productCard);
        });
    }

    // Manejar clic en "Añadir al carrito"
    productsGrid.addEventListener('click', (e) => {
        if (e.target.classList.contains('add-to-cart')) {
            const productId = parseInt(e.target.dataset.id);
            addToCart(productId);
        }
    });
});