<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Post;
use App\Models\Timeline;
use App\Models\User;
use Google\Service\StreetViewPublish\Resource\Photos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JsonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->json = [
                'state' => $user->state,
                'job' => $user->job,
                'bio' => $user->bio,
                'programming_lang' => $user->programming_lang,
                'frameworks' => $user->frameworks,
            ];
            $user->save();
        }
        $photos = Photo::all();
        foreach ($photos as $photo) {
            $photo->json = [
                'comment' => $photo->comment,
            ];
            $photo->save();
        }
        $timelines = Timeline::all();
        foreach ($timelines as $timeline) {
            $timeline->json = [
                'icon' => $timeline->icon,
                'icon_color' => $timeline->icon_color,
            ];
            $timeline->save();
        }
    }
}
