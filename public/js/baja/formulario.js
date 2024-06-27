document.addEventListener('DOMContentLoaded', function() {
    const origenSelect = document.getElementById('origen');
    const otroOrigenContainer = document.getElementById('otroorigen-container');

    origenSelect.addEventListener('change', function() {
        if (origenSelect.value === '4') {
            otroOrigenContainer.style.display = 'block';
        } else {
            otroOrigenContainer.style.display = 'none';
        }
    });
});