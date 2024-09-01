<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            補助簿入力
        </h2>
    </x-slot>

    <div id="toast" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg opacity-0 transition-opacity duration-500 z-50">
        {{ session('success') }}
    </div>
    <div class="py-12">
        <div class="max-w-7l mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button  onclick="openModal()"  class="cursor-pointer transition-all bg-gray-700 text-white px-6 py-2 rounded-lg border-green-400 border-b-[4px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px] active:border-b-[2px] active:brightness-90 active:translate-y-[2px] hover:shadow-xl hover:shadow-green-300 shadow-green-300 active:shadow-none">
                    評価項目追加
                    </button>
                    <!-- 教科フィルタ用のドロップダウンメニュー -->
                        <label for="subjectFilter" class="block mb-2 text-sm font-medium text-gray-700">教科でフィルタ:</label>
                        <select id="subjectFilter" class="mb-4 p-2 border border-gray-300 rounded">
                            <option value="">すべて</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject }}">{{ $subject }}</option>
                            @endforeach
                        </select>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto max-w-full">
                        <!-- フォームの開始 -->
                        <form action="{{ route('grades.store') }}" method="POST">
                            @csrf 
    
                            <table class="w-full border-collapse border border-gray-400">
                                <h2>{{ $grade }}年 {{ $class }}</h2>
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 border-b whitespace-nowrap">生徒名</th> 
                                        @foreach($evaluationItems as $item)
                                            <th data-subject="{{ $item->subject }}" class="py-2 px-4 border-b whitespace-nowrap">{{ $item->item_name }}<br>{{ $item->item_type }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schoolClasses as $schoolClass)
                                        @foreach ($schoolClass->students as $student)
                                            <tr>
                                                <td class="py-2 px-4 border-b whitespace-nowrap">{{ $student->name }}</td>
                                                @foreach($evaluationItems as $item)
                                                <td class="py-2 px-4 border-b whitespace-nowrap" data-subject="{{ $item->subject }}">
                                                    <select name="evaluations[{{ $student->id }}][{{ $item->id }}]" class="rounded border-gray-300 w-full">
                                                        @for ($i = 0; $i <= 100; $i += 10)
                                                            <option value="{{ $i }}" {{ $item->evaluations->where('student_id', $student->id)->first()?->score == $i ? 'selected' : '' }}>
                                                                {{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </td>                                                
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">保存</button>
                        </form> 
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
            <form action="{{ route('grades.addEvaItem') }}" id="addEvaItem" class="mb-4" method="POST">
                @csrf
                <input type="hidden" value="{{ $grade }}" name="grade">
                <input type="hidden" value="{{ $class }}" name="class">
                <label for="subject">教科</label><br>
                <select name="subject" class="rounded" id="subject">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject }}">{{ $subject }}</option>
                    @endforeach
                </select><br>
                
                <label for="item_name">項目名</label><br>
                <input type="text" name="item_name" class="rounded" id="item_name"><br>
                
                <label for="type">評価項目</label><br>
                <select name="item_type" class="rounded" id="type">
                    @foreach ($item_types as $item_type)
                        <option value="{{ $item_type }}">{{ $item_type }}</option>
                    @endforeach
                </select><br>
            </form>
            
            <button   form="addEvaItem"  class="p cursor-pointer transition-all 
                        bg-gray-700 text-white px-6 py-2 rounded-lg
                        border-green-400
                        border-b-[4px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px]
                        active:border-b-[2px] active:brightness-90 active:translate-y-[2px] hover:shadow-xl hover:shadow-green-300 shadow-green-300 active:shadow-none">
                        追加
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
    document.body.dataset.showToast = "{{ session('showToast') ? 'true' : 'false' }}";
    </script>
    @push('scripts')
            @vite(['resources/js/evaluation.js'])
    @endpush
</x-app-layout>

