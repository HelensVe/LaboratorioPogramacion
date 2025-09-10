// assets/js/contact.js

document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contact-form');
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    // Manejar envío del formulario
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Simular envío del formulario
            alert('¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto. 📩');
            contactForm.reset();
        });
    }
    
    // Acordeón de preguntas frecuentes
    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            const isOpen = answer.style.maxHeight;
            
            // Cerrar todas las respuestas primero
            document.querySelectorAll('.faq-answer').forEach(item => {
                item.style.maxHeight = null;
                item.previousElementSibling.classList.remove('active');
            });
            
            // Abrir la respuesta clickeada si no estaba abierta
            if (!isOpen) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                question.classList.add('active');
            }
        });
    });
});