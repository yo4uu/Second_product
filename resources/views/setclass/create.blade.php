<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('クラス振り分け') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>{{ $grade }}年生のクラス振り分け</h2>
                        <form action="{{ route('setclass.store') }}" method="POST">
                            @csrf
                            <table class="border-collapse border border-gray-400 w-full">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b">学年</th>
                                        <th class="py-2 px-4 border-b">名前</th>
                                        <th class="py-2 px-4 border-b">所属クラス</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td class="py-2 px-4 border-b"><input type="hidden" name="schoolgrade" value="{{ $grade }}">{{ $grade }}</td>
                                        <td class="py-2 px-4 border-b">{{ $student->name }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <select name="class_ids[{{ $student->id }}]" class="form-control">
                                                <option value="">クラスを選択</option> 
                                                @foreach($schoolClasses as $schoolclass)
                                                    <option value="{{ $schoolclass->id }}"{{ $student->schoolClasses->contains($schoolclass->id) ? 'selected' : '' }}>
                                                        {{ $schoolclass->class_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>