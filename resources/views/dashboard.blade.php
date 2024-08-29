<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ホーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row g-4">
            <!-- 左側のコンポーネント -->
            <div class="col-md-6">
                <div class="p-3 border bg-white rounded-md">
                    <div class="container">
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="p-3 border bg-white text-center rounded-md">
                                    <a href="{{ route('student.index') }}" class="d-block text-decoration-none text-dark">
                                        生徒一覧
                                    </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 border bg-white text-center rounded-md">
                                    <a href="{{ route('yearly.index') }}" class="d-block text-decoration-none text-dark">
                                        年度更新
                                    </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 border bg-white text-center rounded-md">
                                    <a href="{{ route('setclass.index') }}" class="d-block text-decoration-none text-dark">
                                        クラス設定
                                    </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 border bg-white text-center rounded-md">
                                    <a href="{{ route('facility.index') }}" class="d-block text-decoration-none text-dark">
                                        設備予約
                                    </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 border bg-white text-center rounded-md">
                                    <a href="https://manager.line.biz/account/@367vdpcf" class="d-block text-decoration-none text-dark">
                                        公式LINE（外部サイト）
                                    </a>
                                </div>
                            </div>
                            <div class="col-6" >
                                <div class="p-3 border bg-white text-center rounded-md">
                                    <a href="{{ route('grades.index') }}" class="d-block text-decoration-none text-dark">
                                        補助簿入力
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
    
            <!-- 右側のコンポーネント -->
            <div class="col-md-6">
                <div class="p-3 border bg-white rounded-md">
                    <div class="container">
                        <div class="row g-2">
                            <div class="flex flex-row px-4 mb-2">
                                <div class="basis-3/4 mr-2">
                                    <h2 class="flex items-center justify-center border rounded-md m-0 p-2 h-full">
                                        タスク
                                    </h2>
                                </div>
                                <div class="basis-1/4 flex items-center">
                                    <button id="addTask" class="border rounded-md m-0 p-2 w-full h-full" onclick="OpenModal()">追加</button>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div data-bs-spy="scroll" data-bs-smooth-scroll="true" class="scrollspy-task border rounded h-[300px] overflow-auto" tabindex="0">
                                            @foreach($tasks as $task)
                                                <div class="task-item p-2 border  rounded-md
                                                    @switch($task->priority)
                                                        @case('最優先')
                                                            bg-red-400
                                                            @break
                                                        @case('高')
                                                            bg-orange-300
                                                            @break
                                                        @case('中')
                                                            bg-yellow-300
                                                            @break
                                                        @case('低')
                                                            bg-lime-300
                                                            @break
                                                        @default
                                                            bg-slate-100
                                                    @endswitch" data-priority="{{ $task->priority }}">
                                                    <div class="flex justify-between items-center">
                                                        <div>
                                                            <h4 class="text-lg ">{{ $task->title }}</h4>
                                                            <p class="text-sm text-gray-600">{{ $task->comment }}</p>
                                                        </div>
                                                        <form action="{{ route('task.destroy', $task->id) }}" method='POST'>
                                                        @csrf
                                                        @method('DELETE')
                                                            <button type="submit"
                                                            class="inline-flex items-center px-2 py-1 bg-red-300 transition ease-in-out delay-75 hover:bg-red-600 text-white text-xs font-medium rounded-md hover:-translate-y-1 hover:scale-105"
                                                            >
                                                            <svg
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            class="h-4 w-4 "
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            >
                                                            <path
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                                stroke-width="2"
                                                                stroke-linejoin="round"
                                                                stroke-linecap="round"
                                                            ></path>
                                                            </svg>
                                                            </button>
                                                        </form>

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
            </div>
        </div>
    </div>
    {{-- モーダル --}}
    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 1000;">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 id="modalTitle" class="text-lg font-semibold"></h3>
            <p id="modalContent" class="mt-2"></p>
            <form id="task" action="{{ route('task.store') }}" method="POST">
                @csrf
                <div>
                    <label class="block " for="task-title">タイトル</label>
                    <input type="text" id="task-title" name="title" class="rounded-md">
                </div>
                <div>
                    <label class="block mt-2" for="task-priority">タスク優先度</label>
                    <select id="task-priority" name="priority" class="rounded-md">
                        <option value="">優先度を選んでください</option>
                        <option value="最優先">最優先</option>
                        <option value="高">高</option>
                        <option value="中">中</option>
                        <option value="低">低</option>
                    </select>
                </div>
                <div>
                    <label class="block mt-2" for="comment">備考</label>
                    <input type="text" id="comment" name="comment" class="rounded-md">
                </div>
            </form>
            <div class="modal-btn mt-4">
                <button type="submit" form="task" class="mr-4 cursor-pointer transition-all 
                    bg-gray-700 text-white px-6 py-2 rounded-lg
                    border-green-400
                    border-b-[4px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px]
                    active:border-b-[2px] active:brightness-90 active:translate-y-[2px] hover:shadow-xl hover:shadow-green-300 shadow-green-300 active:shadow-none">
                    追加
                </button>
                <button onclick="CloseModal()" class="cursor-pointer transition-all 
                    bg-gray-700 text-white px-6 py-2 rounded-lg
                    border-red-400
                    border-b-[4px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px]
                    active:border-b-[2px] active:brightness-90 active:translate-y-[2px] hover:shadow-xl hover:shadow-red-300 shadow-red-300 active:shadow-none">
                    閉じる
                </button>
            </div>
        </div>
    </div>
    <script>
        function OpenModal() {
            document.querySelector('#modal').classList.remove('hidden');
        }
    
        function CloseModal() {
            document.querySelector('#modal').classList.add('hidden');
            document.querySelector('#task').reset();
        }
    </script>  
</x-app-layout>
