<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            学年・クラス設定
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container ">

                        <div class="form-group">
                            <label for="year_filter">年度フィルター:</label>
                            <select id="year_filter" class="form-control">
                                @for ($year = $currentYear - 3; $year <= $currentYear + 3; $year++)
                                    <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            
                        </div>
                

                        <div class="container mx-auto text-center">
                            <div class="flex flex-wrap justify-start gap-4">
                                @foreach(range(1, 6) as $grade)
                                    <div class="w-full md:w-1/2 lg:w-1/3 p-3">
                                        <h5 class="text-xl font-bold mb-2">
                                            {{ $grade }}年生
                                            <!-- クラス追加ボタン -->
                                            <button onclick="addClass({{ $grade }})" class="text-sm text-blue-500">クラスを追加</button>
                                        </h5>
                                        <div id="class_list_{{ $grade }}">
                                            @foreach($schoolclasses->where('school_grade', $grade) as $schoolclass)
                                                <div class="class-item" data-year="{{ $schoolclass->school_year }}" data-grade="{{ $schoolclass->school_grade }}">
                                                    {{ $schoolclass->school_grade }}年 {{ $schoolclass->class_name }}
                                                    <!-- クラス削除ボタン -->
                                                    <button onclick="deleteClass({{ $schoolclass->id }})" class="text-sm text-red-500">削除</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <script>
        document.getElementById('year_filter').addEventListener('change', function() {
            filterClasses();
        });

        function filterClasses() {
            const selectedYear = document.getElementById('year_filter').value;
            const classes = document.querySelectorAll('.class-item');

            classes.forEach(function(classItem) {
                const classYear = classItem.getAttribute('data-year');

                if (selectedYear === classYear) {
                    classItem.style.display = '';
                } else {
                    classItem.style.display = 'none';
                }
            });
        }

        // ページ読み込み時にフィルターを適用
        filterClasses();
        function deleteClass(classId) {
    if (confirm('本当にこのクラスを削除しますか？')) {
        fetch(`/classes/${classId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => {
            if (response.ok) {
                location.reload();  // ページをリロードして更新
            } else {
                alert('クラスの削除に失敗しました。');
            }
        });
    }
}
function addClass(grade) {
    const year = document.getElementById('year_filter').value;

    fetch(`/classes`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            school_grade: grade,
            school_year: year
        })
    }).then(response => {
        if (response.ok) {
            // 成功したら選択された年度を保持してリロード
            window.location.href = `?year=${year}`;
        } else {
            alert('クラスの追加に失敗しました。');
        }
    });
}


    </script>
</x-app-layout>
