<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            施設予約
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h2>学生データCSVインポート</h2>
                        <h2 class="text-rose-400">（⚠️csvファイルの先頭の行、タイムスタンプは削除してからアップロードしてください。）</h2><br>
                        <h2 class="text-rose-400">（⚠️Formsでアンケートを取ってCSVファイルを作成するときは、質問事項を名前、生年月日、性別、住所、メールアドレスにしてください。）</h2><br>
                        
                        <form action="{{  route('student.import')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="csv_file">CSVファイルを選択:</label>
                                <input type="file" name="csv_file" id="csv_file" class="form-control-file">
                            </div>
                            <button type="submit" class="btn btn-primary border rounded bg-gray-100 text-cyan-950">アップロード</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>