<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\JournalLogRequest;
use App\Models\JournalLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Crypt;

class JournalLogController extends Controller
{
    public function store(JournalLogRequest $request): JsonResponse
    {
        $journalLog = new JournalLog();
        $journalLog->mood = $request->get('mood');
        $journalLog->weather = $request->get('weather');
        $journalLog->lat = $request->get('lat');
        $journalLog->lon = $request->get('lon');
        $journalLog->setEncryptedNote($request->get('note'));
        $journalLog->save();

        return new JsonResponse($journalLog);
    }
}
