<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoStoreRequest;
use App\Models\Video;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $videos = Video::when($search, fn($q) => 
            $q->where('title', 'like', "%{$search}%")
        )->latest()->paginate(10);

        return view('admin.videos.index', compact('videos', 'search'));
    }

    public function store(VideoStoreRequest $request)
    {
        if (!$request->hasFile('video') && !$request->filled('video_url')) {
            return back()
                ->withInput()
                ->withErrors(['video' => 'آپلود فایل یا وارد کردن لینک ویدیو الزامی است.']);
        }

        $videoPath = $this->handleVideoUpload($request);

        Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'path' => $videoPath,
            'url' => $request->video_url,
        ]);

        return redirect()->route('videos.index')
            ->with('success', 'ویدیو با موفقیت اضافه شد.');
    }

    public function destroy(Video $video)
    {
        if ($video->path && File::exists(public_path($video->path))) {
            File::delete(public_path($video->path));
        }

        $video->delete();

        return redirect()->route('videos.index')
            ->with('success', 'ویدیو با موفقیت حذف شد.');
    }

    private function handleVideoUpload(Request $request): ?string
    {
        if (!$request->hasFile('video')) {
            return null;
        }

        $directory = 'uploads/videos';

        if (!File::exists(public_path($directory))) {
            File::makeDirectory(public_path($directory), 0755, true);
        }

        $file = $request->file('video');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path($directory), $filename);

        return "{$directory}/{$filename}";
    }
}
