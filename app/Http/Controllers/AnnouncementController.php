<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    //
    public function __construct()
    {
    }

    public function showAnnouncementList()
    {
        return view('announcements.index')->with('announcements', Announcement::all()->orderByDesc('created_at')->get());
    }

    public function createAnnouncement(Request $request)
    {
        Announcement::query()->create($request->all());
    }
}
