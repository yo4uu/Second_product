<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            補助簿入力
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="form-group text-right hidden">
                            <select id="year_filter" class="form-control w-24 ml-auto" >
                                @for ($year = $currentYear; $year <= $currentYear; $year++)
                                    <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <h3 class="text-center text-xl">{{ $currentYear }}年度</h4>
                        <div class="container mx-auto text-center">
                            <div class="flex flex-wrap justify-center gap-4 my-4">
                                @foreach(range(1, 6) as $grade)
                                    <div class="w-full md:w-1/2 lg:w-1/3 p-3 border rounded ">
                                        <h5 class="text-xl font-bold mb-2">
                                            {{ $grade }}年生
                                        </h5>
                                        <div id="class_list_{{ $grade }}">
                                            @foreach($schoolclasses->where('school_grade', $grade) as $schoolclass)
                                                <div class="class-item" data-year="{{ $schoolclass->school_year }}" data-grade="{{ $schoolclass->school_grade }}">
                                                    <a href="{{ route('grades.show', ['grade' => $schoolclass->school_grade, 'class' => $schoolclass->class_name]) }}">
                                                        {{ $schoolclass->school_grade }}年 {{ $schoolclass->class_name }}
                                                    </a>
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
        



    </script>

</x-app-layout>

