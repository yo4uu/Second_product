<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                                        学年・クラス設定
                                    </a>
                                </div>
                            </div>
                            {{-- <div class="col-6">
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
                                        成績管理
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="border cursor-pointer uppercase bg-white px-4 py-2 active:translate-x-0.5 active:translate-y-0.5 hover:shadow-[0.5rem_0.5rem_#F44336,-0.5rem_-0.5rem_#00BCD4] transition">
                                Hover me!
                            </button>
                            <button class="relative px-8 py-2 rounded-md bg-white isolation-auto z-10 border-2 border-lime-500 before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0 before:rounded-full before:bg-lime-500 before:-z-10 before:aspect-square before:hover:scale-150 overflow-hidden before:hover:duration-700">
                                Hover Me
                            </button>
                        </div> --}}
                    </div>
                </div>
            </div>
    
            <!-- 右側のコンポーネント -->
            {{-- <div class="col-md-6">
                <div class="p-3 border bg-white rounded-md">
                    <div class="container">
                        <div class="row g-2">
                            <div class="flex flex-row px-4 mb-2">
                                <div class="basis-3/4 mr-2">
                                    <h2 class="flex items-center justify-center bg-gray-300 rounded-md m-0 p-2 h-full">
                                        タスク
                                    </h2>
                                </div>
                                <div class="basis-1/4 flex items-center">
                                    <button id="addTask" class="border bg-green-300 rounded-md m-0 p-2 w-full h-full" onclick="OpenModal()">追加</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div data-bs-spy="scroll" data-bs-smooth-scroll="true" class="scrollspy-task border" tabindex="0" style="height: 300px; overflow: auto;">
                                        @foreach($tasks as $task)
                                            <div class="task-item p-2 border bg-slate-100 rounded-md
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
            </div> --}}
        </div>
    </div>
</x-app-layout>
