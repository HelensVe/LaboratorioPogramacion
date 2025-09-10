// assets/js/checkout.js

document.addEventListener('DOMContentLoaded', () => {
    // Cargar productos del carrito
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const products = [
        {
            id: 1,
            name: "Mochila Urbana Minimal",
            price: 59.99
        },
        {
            id: 2,
            name: "Mochila Viajera Eco",
            price: 79.99
        },
        {
            id: 3,
            name: "Mochila Laptop Segura",
            price: 89.99
        },
        {
            id: 4,
            name: "Mochila Aventura Trek",
            price: 99.99
        }
    ];
    
    // Elementos del DOM
    const checkoutItems = document.getElementById('checkout-items');
    const checkoutSubtotal = document.getElementById('checkout-subtotal');
    const checkoutShipping = document.getElementById('checkout-shipping');
    const checkoutTotal = document.getElementById('checkout-total');
    const shippingMethods = document.getElementsByName('shipping-method');
    
    // Variables
    let subtotal = 0;
    let shippingCost = 5.99; // Costo por defecto (envío estándar)
    
    // Mostrar items del carrito
    function displayCartItems() {
        checkoutItems.innerHTML = '';
        subtotal = 0;
        
        if (cart.length === 0) {
            checkoutItems.innerHTML = '<p>No hay productos en tu carrito</p>';
            return;
        }
        
        cart.forEach(item => {
            const product = products.find(p => p.id === item.id);
            if (product) {
                const itemTotal = product.price * item.quantity;
                subtotal += itemTotal;
                
                const itemElement = document.createElement('div');
                itemElement.className = 'checkout-item';
                itemElement.innerHTML = `
                    <span class="checkout-item-name">${product.name} x ${item.quantity}</span>
                    <span class="checkout-item-price">$${itemTotal.toFixed(2)}</span>
                `;
                checkoutItems.appendChild(itemElement);
            }
        });
        
        updateTotals();
    }
    
    // Actualizar totales
    function updateTotals() {
        checkoutSubtotal.textContent = `$${subtotal.toFixed(2)}`;
        checkoutShipping.textContent = `$${shippingCost.toFixed(2)}`;
        checkoutTotal.textContent = `$${(subtotal + shippingCost).toFixed(2)}`;
    }
    
    // Manejar cambio de método de envío
    shippingMethods.forEach(method => {
        method.addEventListener('change', () => {
            shippingCost = method.value === 'express' ? 12.99 : 5.99;
            updateTotals();
        });
    });
    
    // Navegación entre pasos
    const sections = document.querySelectorAll('.checkout-section');
    const steps = document.querySelectorAll('.step');
    
    function goToStep(stepId) {
        sections.forEach(section => {
            section.classList.remove('active');
            if (section.id === `${stepId}-section`) {
                section.classList.add('active');
            }
        });
        
        steps.forEach(step => {
            step.classList.remove('active');
            if (step.textContent.includes(stepId.split('-')[0])) {
                step.classList.add('active');
            }
        });
    }
    
    // Botones siguiente/anterior
    document.querySelectorAll('.btn-next').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const nextSection = button.dataset.next;
            goToStep(nextSection.split('-')[0]);
        });
    });
    
    document.querySelectorAll('.btn-prev').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const prevSection = button.dataset.prev;
            goToStep(prevSection.split('-')[0]);
        });
    });
    
    // Manejar envío del formulario
    const checkoutForm = document.getElementById('checkout-form');
    checkoutForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Validar formulario
        const email = document.getElementById('email').value;
        document.getElementById('confirmation-email').textContent = email;
        
        // Generar número de pedido aleatorio
        const orderId = Math.floor(Math.random() * 90000) + 10000;
        document.getElementById('order-id').textContent = orderId;
        
        // Ir a la sección de confirmación
        goToStep('confirmation');
        
        // Vaciar el carrito
        localStorage.removeItem('cart');
        updateCartCount();
    });
    
    // Inicializar
    displayCartItems();
    updateCartCount();
});