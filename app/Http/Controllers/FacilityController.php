<?php

namespace App\Http\Controllers;

use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use App\Models\Reservation;


class FacilityController extends Controller
{
    public function index()
    {

        $facilities = [
            '運動場',
            'プール',
            '体育館',
            '図書館',
            '多目的室',
            '図工室',
            '音楽室',
        ];

        $currentDate = CarbonImmutable::now(); //現在の日時を取得
        $startDate = $currentDate->startOfWeek(); //今週の月曜を取得

        $weeks = []; //４週間分の日付と曜日を保存するための配列

         // 日本語の曜日を定義
        $weekdays = [
            'Sunday' => '日',
            'Monday' => '月',
            'Tuesday' => '火',
            'Wednesday' => '水',
            'Thursday' => '木',
            'Friday' => '金',
            'Saturday' => '土'
        ];

        for($week = 0; $week < 4; $week++) {  //$weekを４回繰り返して、４週間分の日付と曜日を計算
            $dates = [];

            $weekStartDate = $startDate->addWeeks($week)->startOfWeek(); // 修正後

        for ($day = 0; $day < 5; $day++) {  // $dayを５回繰り返して月から金までの日付と曜日を計算し、$dates配列に保存
            $currentDate = $weekStartDate->addDays($day); // 各週の月曜日から$day日を計算
            $englishDay = $currentDate->format('l'); // 英語の曜日（例: 'Monday'）
            $dayOfWeekInJapanese = $weekdays[$englishDay]; // 日本語の曜日（例: '月曜日'）

            $dates[] = [
                'date' => $currentDate->toDateString(),
                'dayOfWeek' => $dayOfWeekInJapanese // 日本語の曜日を設定
            ];
        }

        $weeks[] = $dates; // 各週の$dates配列を$weeks配列に追加
        }

        $periods = ['1時間目', '2時間目', '3時間目', '4時間目', '5時間目', '6時間目'];
        $dayCount = 5;

        // 予約済みのcell_idを全て取得
        $reservedCellIds = Reservation::pluck('cell_id')->toArray();

        $reservations = Reservation::pluck('class', 'cell_id')->toArray();

        return view('facility.index',compact('weeks', 'periods', 'dayCount','facilities', 'reservedCellIds', 'reservations'));   
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cell_id' => 'required|string',
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
        ]);

        $reservation = new Reservation();
        $reservation->cell_id = $validatedData['cell_id'];
        $reservation->name = $validatedData['name'];
        $reservation->class = $validatedData['class'];
        $reservation->save();

        return redirect()->route('facility.index')->with('success', '予約が完了しました。');
    }
}
