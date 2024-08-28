let currentWeekIndex = window.appData.currentWeekIndex;
const totalWeeks = window.appData.totalWeeks;

function showTable(date) {
    // すべてのテーブルを非表示にする
    document.querySelectorAll('.table-responsive').forEach(table => {
        table.style.display = 'none';
    });

    // 対応するテーブルを表示する
    document.getElementById('table-' + date).style.display = 'block';
}

function showPreviousWeek() {
    if (currentWeekIndex > 0) {
        document.getElementById(`week${currentWeekIndex}`).style.display = 'none';
        currentWeekIndex--;
        document.getElementById(`week${currentWeekIndex}`).style.display = 'block';
        updateButtonVisibility();
    }
}

function showNextWeek() {
    if (currentWeekIndex < totalWeeks - 1) {
        document.getElementById(`week${currentWeekIndex}`).style.display = 'none';
        currentWeekIndex++;
        document.getElementById(`week${currentWeekIndex}`).style.display = 'block';
        updateButtonVisibility();
    }
}



function updateButtonVisibility() {
    document.querySelector('.prev-btn').classList.toggle('invisible', currentWeekIndex === 0);
    document.querySelector('.next-btn').classList.toggle('invisible', currentWeekIndex === totalWeeks - 1);
}

// 初期表示で最初のテーブルを表示
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.table-responsive').style.display = 'block';
});

updateButtonVisibility();

function ReservationModal(cellId) {
    
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
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
    
}