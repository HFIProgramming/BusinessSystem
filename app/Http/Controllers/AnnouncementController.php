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
        return view('announcements.index')->with('announcements', Announcement::all());
    }

    public function createAnnouncement(Request $request)
    {
        Announcement::create($request->all());
    }
}
