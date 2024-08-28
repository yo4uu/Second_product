<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            生徒一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    生徒一覧
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto"> 
                        <a href="{{ route('student.create') }}">生徒登録</a>
                        <a href="{{ route('student.importForm') }}">生徒登録（CSV）</a>
                        <table class="min-w-full border-collapse border border-gray-400">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">名前</th>
                                    <th class="py-2 px-4 border-b">生年月日</th>
                                    <th class="py-2 px-4 border-b">性別</th>
                                    <th class="py-2 px-4 border-b">住所</th>
                                    <th class="py-2 px-4 border-b">年組</th>
                                    <th class="py-2 px-4 border-b">入学年度</th>
                                    <th class="py-2 px-4 border-b bg-white sticky right-0">編集</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $student->name }}</td>
                                    <td class="py-2 px-4 border-b">{{ $student->date_of_birth }}</td>
                                    <td class="py-2 px-4 border-b">{{ $student->sex }}</td>
                                    <td class="py-2 px-4 border-b">{{ $student->adress }}</td>
                                    <td class="py-2 px-4 border-b">
                                        @foreach ($student->schoolClasses as $class)
                                        {{ $class->school_grade }}年
                                        {{ $class->class_name }} 
                                        @endforeach
                                    </td>
                                    <td class="py-2 px-4 border-b">{{ $student->admission_year }}</td>
                                    <td class="py-2 px-4 border-b bg-white sticky right-0"> 
                                        <a href="{{ route('student.edit', $student) }}" class="text-blue-500">編集</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    
</x-app-layout>