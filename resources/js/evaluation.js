window.openModal = function() {
    document.getElementById('modal').classList.remove('hidden');
}

window.closeModal = function() {
    document.getElementById('modal').classList.add('hidden');
    document.getElementById('addEvaItem').reset();
}

window.showToast = function() {
    const toast = document.getElementById('toast');
    if (!toast) return;

    toast.classList.remove('opacity-0');
    toast.classList.add('opacity-100');

    setTimeout(() => {
        toast.classList.remove('opacity-100');
        toast.classList.add('opacity-0');
    }, 3000);
}

document.addEventListener('DOMContentLoaded', function() {
    if (document.body.dataset.showToast === "true") {
        showToast();
    }

    const subjectFilter = document.getElementById('subjectFilter');
    if (subjectFilter) {
        subjectFilter.addEventListener('change', function () {
            const selectedSubject = this.value;
            const headers = document.querySelectorAll('th[data-subject]');
            const cells = document.querySelectorAll('td[data-subject]');

            headers.forEach(header => {
                if (selectedSubject === "" || header.getAttribute('data-subject') === selectedSubject) {
                    header.style.display = '';
                } else {
                    header.style.display = 'none';
                }
            });

            cells.forEach(cell => {
                if (selectedSubject === "" || cell.getAttribute('data-subject') === selectedSubject) {
                    cell.style.display = '';
                } else {
                    cell.style.display = 'none';
                }
            });
        });
    }
});