let currentWeekIndex = window.appData.currentWeekIndex;
const totalWeeks = window.appData.totalWeeks;

window.showTable = function(date) {
    // すべてのテーブルを非表示にする
    document.querySelectorAll('.table-responsive').forEach(table => {
        table.style.display = 'none';
    });

    // 対応するテーブルを表示する
    document.getElementById('table-' + date).style.display = 'block';
};

window.showPreviousWeek = function() {
    if (currentWeekIndex > 0) {
        document.getElementById(`week${currentWeekIndex}`).style.display = 'none';
        currentWeekIndex--;
        document.getElementById(`week${currentWeekIndex}`).style.display = 'block';
        window.updateButtonVisibility();
    }
};

window.showNextWeek = function() {
    if (currentWeekIndex < totalWeeks - 1) {
        document.getElementById(`week${currentWeekIndex}`).style.display = 'none';
        currentWeekIndex++;
        document.getElementById(`week${currentWeekIndex}`).style.display = 'block';
        window.updateButtonVisibility();
    }
};

window.updateButtonVisibility = function() {
    document.querySelector('.prev-btn').classList.toggle('invisible', currentWeekIndex === 0);
    document.querySelector('.next-btn').classList.toggle('invisible', currentWeekIndex === totalWeeks - 1);
};

window.ReservationModal = function(cellId) {
    let parts = cellId.split('-');
    let year = parts[1];
    let month = parts[2];
    let day = parts[3];
    let period = parts[4];
    let facility = parts[5];

    let selectedDate = month + '月' + day + '日';

    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('modalTitle').textContent = selectedDate;
    document.getElementById('modalContent').textContent = period + 'の' + facility;
    document.getElementById('reservationCellId').value = cellId;
};

window.closeModal = function() {
    document.getElementById('modal').classList.add('hidden');
};

window.initializeTable = function() {
    document.querySelector('.table-responsive').style.display = 'block';
    window.updateButtonVisibility();
};

// 初期化
document.addEventListener('DOMContentLoaded', window.initializeTable);