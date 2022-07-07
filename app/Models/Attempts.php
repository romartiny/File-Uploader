<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attempts extends Model
{
    use HasFactory;

    public function index()
    {
        return view('user.index', ['users' => $users]);
    }

    public static function addIpAttempts($ip, $email)
    {
        $currentDate = date("Y-m-d H:i:s");
        $endDate = date('Y-m-d H:i:s', strtotime($currentDate . ' +1 minute'));
        $addAttempt = self::findIpAttempts($ip) + 1;
        return DB::insert("INSERT INTO attempts (ip, email, attempts_count, created_at, ended_at) VALUES ('$ip', '$email', '$addAttempt', '$currentDate', '$endDate')");
    }

    public static function findIpAttempts($ip)
    {
        return DB::delete("SELECT * FROM attempts WHERE ip = '$ip'");
    }

    public static function deleteUsersAttempts()
    {
        return DB::delete("DELETE FROM attempts WHERE ended_at < NOW()");
    }
}
