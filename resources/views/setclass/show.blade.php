<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            クラス設定
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>{{ $selectedGrade }}年生の学生一覧</h2>
                    <a class="btn bg-info-subtle dropdown-toggle" href="{{ route('setclass.create',['grade' => $selectedGrade]) }}">クラス振り分け</a>
                    <table class="border-collapse border border-gray-400 w-full">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">学年</th>
                                <th class="py-2 px-4 border-b">名前</th>
                                <th class="py-2 px-4 border-b">所属クラス</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $selectedGrade }}</td>
                                    <td class="py-2 px-4 border-b">{{ $student->name }}</td>
                                    <td class="py-2 px-4 border-b">
                                        @foreach ($student->schoolClasses as $class)
                                            {{ $class->class_name }} <br>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

