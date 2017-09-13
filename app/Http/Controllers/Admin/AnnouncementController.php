<?php

namespace App\Http\Controllers\Admin;

use App\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
	//
	public function __construct()
	{
	}

	public function showForm()
	{
		return view('admin.addAnnouncement');
	}

	public function addAnnouncement(Request $request)
	{
		$announcement = new Announcement();
		$announcement->title = $request->title;
		$announcement->content = $request->content;
		$announcement->save();

		return view('success')->with('message', '添加成功');
	}
}
