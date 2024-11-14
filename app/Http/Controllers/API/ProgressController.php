<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Progress;
use App\Models\Course;
use App\Traits\UserTrait;

class ProgressController extends Controller
{
    use UserTrait;

    public function updateProgress(Request $request, $videoId)
    {
        $user = $this->getUserFromRequest($request);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $progress = Progress::firstOrCreate([
            'user_id' => $user->id,
            'video_id' => $videoId,
        ], [
            'completed' => true,
            'last_viewed_at' => now(),
        ]);

        if (!$progress->wasRecentlyCreated) {
            $progress->update(['completed' => true, 'last_viewed_at' => now()]);
        }

        return response()->json(['message' => 'Video marked as completed']);
    }

    public function getCourseProgress(Request $request, $courseId)
    {
        $user = $this->getUserFromRequest($request);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $course = Course::findOrFail($courseId);

        $totalVideos = $course->videos()->count();
        $completedVideos = Progress::where('user_id', $user->id)
            ->whereIn('video_id', $course->videos()->pluck('id'))
            ->where('completed', true)
            ->count();

        $courseProgress = $totalVideos > 0 ? ($completedVideos / $totalVideos) * 100 : 0;

        return response()->json([
            'course_progress' => $courseProgress,
            'completed_videos' => $completedVideos,
            'total_videos' => $totalVideos,
        ]);
    }
}
