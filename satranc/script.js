document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.info-button');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const wrapper = this.parentElement;
            const url = wrapper.getAttribute('data-url');
            window.location.href = url;
        });
    });
});
