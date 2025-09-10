// Manejo del carrito de compras
document.addEventListener('DOMContentLoaded', () => {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartContainer = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const checkoutForm = document.getElementById('checkout-form');

    // Mostrar items del carrito
    function displayCartItems() {
        cartContainer.innerHTML = '';
        
        if (cart.length === 0) {
            cartContainer.innerHTML = '<p>Tu carrito está vacío. <span class="emoji">😢</span></p>';
            return;
        }

        cart.forEach((item, index) => {
            const product = getProductById(item.id);
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.innerHTML = `
                <img src="${product.image}" alt="${product.name}">
                <div class="cart-item-details">
                    <h3>${product.name}</h3>
                    <p>$${product.price.toFixed(2)} x ${item.quantity}</p>
                    <p>Subtotal: $${(product.price * item.quantity).toFixed(2)}</p>
                </div>
                <div class="cart-item-actions">
                    <button class="quantity-btn" data-index="${index}" data-action="decrease">-</button>
                    <span>${item.quantity}</span>
                    <button class="quantity-btn" data-index="${index}" data-action="increase">+</button>
                    <button class="remove-btn" data-index="${index}">🗑️</button>
                </div>
            `;
            cartContainer.appendChild(cartItem);
        });

        // Calcular total
        const total = cart.reduce((sum, item) => {
            const product = getProductById(item.id);
            return sum + (product.price * item.quantity);
        }, 0);
        
        cartTotal.textContent = total.toFixed(2);
    }

    // Obtener producto por ID
    function getProductById(id) {
        return products.find(product => product.id === id);
    }

    // Manejar cambios de cantidad
    cartContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('quantity-btn')) {
            const index = e.target.dataset.index;
            const action = e.target.dataset.action;
            
            if (action === 'increase') {
                cart[index].quantity += 1;
            } else if (action === 'decrease' && cart[index].quantity > 1) {
                cart[index].quantity -= 1;
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            displayCartItems();
            updateCartCount();
        }
        
        if (e.target.classList.contains('remove-btn')) {
            const index = e.target.dataset.index;
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            displayCartItems();
            updateCartCount();
        }
    });

    // Manejar checkout
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Simular procesamiento de pago
            alert('¡Gracias por tu compra! Tu pedido ha sido procesado. 🎉');
            localStorage.removeItem('cart');
            updateCartCount();
            window.location.href = 'index.html';
        });
    }

    displayCartItems();
});

// Función para agregar al carrito (usada en product.js)
function addToCart(productId) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id: productId, quantity: 1 });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    alert('Producto añadido al carrito 🛒');
}