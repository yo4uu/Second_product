<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            生徒登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    生徒登録フォーム
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex justify-center">
                    <form method="POST" action="{{ route('student.store') }}">
                        @csrf
                        <div class="block mb-4">
                            <label>生徒名</label>
                            <input type="text" name="name" class="block rounded-md">
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="block mb-4">
                            <label>性別</label>
                            <select name="sex" class="block rounded-md">
                                <option value="">選択してください</option>
                                <option value="男">男</option>
                                <option value="女">女</option>
                            </select>
                            @error('sex')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="block mb-4">
                            <label>生年月日</label>
                            <input type="date" name="date_of_birth" class="block rounded-md">
                            @error('date_of_birth')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="block mb-4">
                            <label>住所</label>
                            <input type="text" name="adress" class="block rounded-md">
                            @error('adress')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="block mb-4">
                            <label>入学年度</label>
                            <select name="admission_year" id="admission_year" class="block rounded-md">
                                <option value="">選択してください</option>
                                @for ($year = 2000; $year <= 2100; $year++)
                                    <option value="{{ $year }}">{{ $year }}年度</option>
                                @endfor
                            </select>
                            @error('admission_year')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="block mb-4">
                            <label>メールアドレス</label>
                            <input type="text" name="email" class="block rounded-md">
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="cursor-pointer transition-all 
                        bg-gray-700 text-white px-6 py-2 rounded-lg
                        border-green-400 mt-4 mr-4
                        border-b-[4px] hover:brightness-110 hover:-translate-y-[1px] hover:border-b-[6px]
                        active:border-b-[2px] active:brightness-90 active:translate-y-[2px] hover:shadow-xl hover:shadow-green-300 shadow-green-300 active:shadow-none">
                        登録
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    



    
    
</x-app-layout>