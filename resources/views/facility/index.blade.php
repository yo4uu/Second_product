<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            施設予約
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    施設予約
                </div>
            </div>
        </div>
    </div>


                    {{-- //s以下入力用モーダル --}}
                    {{-- <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 1000;">
                        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                            <h3 id="modalTitle" class="text-lg font-semibold"></h3>
                            <p id="modalContent" class="mt-2"></p>
                            <form id="reservationForm" action="{{ route('reservation.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="period" id="reservationPeriod">
                                <input type="hidden" name="facility" id="reservationFacility">
                                <div>
                                    <label for="reservationName">名前</label><br>
                                    <input type="text" id="reservationName" name="name" required class="w-full border rounded px-2 py-1">
                                </div>
                                <div class="mt-2">
                                    <label for="reservationClass">クラス</label><br>
                                    <input type="text" id="reservationClass" name="class"required class="w-full border rounded px-2 py-1">
                                </div>
                                <div class="mt-4 flex justify-between">
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        予約する
                                    </button>
                                    <button type="button" onclick="closeModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        閉じる
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div> --}}

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="btn-wrapper flex justify-between items-center">
                    <button class="prev-btn border p-2" onclick="showPreviousWeek()">前の週</button>
                    <div id="weeks-container" class="flex-grow text-center">
                        @foreach($weeks as $weekIndex => $week)
                            <div class="week-group" id="week{{ $weekIndex }}" style="{{ $weekIndex !== 0 ? 'display:none;' : '' }}">
                                <div class="btn-group" role="group" aria-label="Date selection radio group">
                                    @foreach($week as $index => $day)
                                        <input type="radio" class="btn-check" name="date-selection-week{{ $weekIndex }}" id="btnradio{{ $weekIndex }}-{{ $index }}" autocomplete="off" {{ $index === 0 ? 'checked' : '' }} onclick="showTable('{{ $day['date'] }}')">
                                        <label class="btn btn-outline-primary" for="btnradio{{ $weekIndex }}-{{ $index }}">
                                            {{ \Carbon\Carbon::parse($day['date'])->format('n月j日') }} 
                                            ({{ $day['dayOfWeek'] }})
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="next-btn border p-2" onclick="showNextWeek()">次の週</button>
                </div>
                
                <div id="tables-container" class="reservationTable flex justify-center mt-4">
                    @foreach($weeks as $week)
                        @foreach($week as $day)
                            <!-- 各日付に対する表 -->
                            <div class="table-responsive" id="table-{{ $day['date'] }}" style="display: none;">
                                <h3>{{ $day['date'] }} - {{ $day['dayOfWeek'] }}</h3>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>時間\施設名</th> 
                                            @foreach($facilities as $facility)
                                                <th>{{ $facility }}</th> 
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($periods as $period)
                                            <tr>
                                                <td>{{ $period }}</td> 
                                                @foreach($facilities as $facility)
                                                    @php
                                                    $cellId = "cell-{$day['date']}-{$period}-{$facility}";
                                                    $isReserved = in_array($cellId, $reservedCellIds);
                                                    @endphp
                                                    <td id="{{ $cellId }}" 
                                                    style="{{ $isReserved ? 'background-color: red; color: white;' : '' }}"
                                                    class="cursor-pointer" 
                                                    onclick="ReservationModal('{{ $cellId }}')">
                                                    {{ $isReserved ? '予約済' : '' }}
                                                </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
{{-- 以下モーダル --}}
<div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 1000;">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <h3 id="modalTitle" class="text-lg font-semibold"></h3>
        <p id="modalContent" class="mt-2"></p>
        <form action="{{ route('reservation.store') }}" id="reservationForm" class="" method="POST">
            @csrf
            <input type="hidden" name="cell_id" id="reservationCellId">
            <label for="reservationName">名前</label><br>
            <input type="text" name="name" class="rounded" id="reservationName"><br>
            <label for="reservationClass">クラス</label><br>
            <input type="text" name="class" class="rounded" id="reservationClass"><br>
        </form>
        <button   form="reservationForm"  class="cursor-pointer transition-all 
                    bg-gray-700 text-white px-6 py-2 rounded-lg
                    border-green-400
                    border-b-[4px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px]
                    active:border-b-[2px] active:brightness-90 active:translate-y-[2px] hover:shadow-xl hover:shadow-green-300 shadow-green-300 active:shadow-none">
                    予約
        </button>
        <button onclick="closeModal()" class="cursor-pointer transition-all 
                    bg-gray-700 text-white px-6 py-2 rounded-lg
                    border-red-400
                    border-b-[4px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px]
                    active:border-b-[2px] active:brightness-90 active:translate-y-[2px] hover:shadow-xl hover:shadow-red-300 shadow-red-300 active:shadow-none">
                    閉じる
        </button>
    </div>
</div> 
<script>
    // JavaScriptで表示切り替え
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

    let currentWeekIndex = 0;
    const totalWeeks = {{ count($weeks) }};

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

</script>

    @push('scripts')
        @vite(['resources/js/changeDate.js'])
    @endpush
</x-app-layout>