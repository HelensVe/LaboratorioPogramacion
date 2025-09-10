// assets/js/product.js

document.addEventListener('DOMContentLoaded', () => {
    // Obtener ID del producto de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id');
    
    // Datos de productos (en un proyecto real, esto vendría de una API)
    const products = [
        {
            id: 1,
            name: "Mochila Urbana Minimal",
            price: 59.99,
            images: [
                "assets/images/products/urbana-minimal.jpg",
                "assets/images/products/urbana-minimal-2.jpg",
                "assets/images/products/urbana-minimal-3.jpg"
            ],
            description: "Perfecta para el día a día en la ciudad con estilo minimalista. Fabricada con materiales resistentes y ligeros, con compartimento acolchado para laptop de hasta 15\".",
            details: {
                material: "Poliéster reciclado resistente al agua",
                capacity: "20L",
                dimensions: "30 x 45 x 15 cm",
                compartments: "Principal, laptop, bolsillo frontal, laterales"
            },
            category: "urbanas"
        },
        // ... otros productos
    ];
    
    // Cargar datos del producto
    const product = products.find(p => p.id === parseInt(productId)) || products[0];
    loadProductData(product);
    
    // Cargar productos relacionados
    loadRelatedProducts(product.category, product.id);
    
    // Manejar galería de imágenes
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('main-product-image');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', () => {
            // Remover clase active de todas las miniaturas
            thumbnails.forEach(t => t.classList.remove('active'));
            // Agregar clase active a la miniatura clickeada
            thumb.classList.add('active');
            // Cambiar imagen principal
            mainImage.src = thumb.dataset.image;
        });
    });
    
    // Manejar selector de cantidad
    const quantityInput = document.getElementById('product-quantity');
    document.getElementById('increase-qty').addEventListener('click', () => {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });
    
    document.getElementById('decrease-qty').addEventListener('click', () => {
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });
    
    // Manejar añadir al carrito
    document.getElementById('add-to-cart-btn').addEventListener('click', () => {
        const quantity = parseInt(quantityInput.value);
        addToCart(product.id, quantity);
    });
});

function loadProductData(product) {
    document.getElementById('product-name').textContent = product.name;
    document.getElementById('product-price').textContent = `$${product.price.toFixed(2)}`;
    document.getElementById('product-description').textContent = product.description;
    
    // Cargar primera imagen
    document.getElementById('main-product-image').src = product.images[0];
    
    // Cargar miniaturas
    const thumbnailContainer = document.querySelector('.thumbnail-container');
    thumbnailContainer.innerHTML = '';
    
    product.images.forEach((image, index) => {
        const thumbnail = document.createElement('img');
        thumbnail.src = image;
        thumbnail.alt = `Vista ${index + 1}`;
        thumbnail.className = `thumbnail ${index === 0 ? 'active' : ''}`;
        thumbnail.dataset.image = image;
        thumbnailContainer.appendChild(thumbnail);
    });
    
    // Cargar detalles
    const detailsList = document.querySelector('.product-details ul');
    detailsList.innerHTML = `
        <li><strong>Material:</strong> ${product.details.material}</li>
        <li><strong>Capacidad:</strong> ${product.details.capacity}</li>
        <li><strong>Dimensiones:</strong> ${product.details.dimensions}</li>
        <li><strong>Compartimentos:</strong> ${product.details.compartments}</li>
    `;
}

function loadRelatedProducts(category, currentProductId) {
    // Filtrar productos de la misma categoría (excepto el actual)
    const related = products.filter(p => p.category === category && p.id !== currentProductId);
    const relatedContainer = document.getElementById('related-products');
    
    if (related.length === 0) {
        relatedContainer.innerHTML = '<p>No hay productos relacionados disponibles.</p>';
        return;
    }
    
    // Mostrar máximo 4 productos relacionados
    related.slice(0, 4).forEach(product => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';
        productCard.innerHTML = `
            <img src="${product.images[0]}" alt="${product.name}" class="product-image">
            <div class="product-info">
                <h3>${product.name}</h3>
                <p class="product-price">$${product.price.toFixed(2)}</p>
                <a href="product.html?id=${product.id}" class="view-details">Ver detalles</a>
            </div>
        `;
        relatedContainer.appendChild(productCard);
    });
}