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
                    クラス設定
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('setclass.show') }}">
                        @csrf
                        <label for="selectSchoolGrade" class="block text-sm font-medium text-gray-700">学年を選択</label>
                        <select id="selectSchoolGrade" name="selected_grade" class="w-32 mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            @foreach($selectOptions as $index => $label)
                                <option value="{{ $index + 1 }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <button>表示</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@push('scripts')
    @vite('resources/js/schoolGradeDropdown.js')
@endpush
</x-app-layout>

