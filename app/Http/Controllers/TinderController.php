<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Interaction;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\PersonResource;
use App\Http\Resources\InteractionResource;

class TinderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tinder",
     *     summary="List recommended people",
     *     tags={"People"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     )
     * )
    */
    public function index()
    {
        $people = Person::paginate(10);

        return PersonResource::collection($people);
    }

    /**
     * @OA\Post(
     *     path="/api/tinder/interact",
     *     summary="Like or dislike a person",
     *     tags={"Interaction"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"person_id","type"},
     *             @OA\Property(property="person_id", type="integer", example=1),
     *             @OA\Property(property="type", type="string", enum={"like","dislike"}, example="like")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Interaction created"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Person already liked"
     *     )
     * )
    */
    public function interact(Request $request)
    {
        $data = $request->validate([
            'person_id' => 'required|exists:people,id',
            'type'      => 'required|in:like,dislike',
        ]);

        // Check if interaction already exists
        $existing = Interaction::where('person_id', $data['person_id'])
            ->where('type', 'like')
            ->first();

        if ($existing && $data['type'] === 'like') {
            return response()->json([
                'message' => 'This person has already been liked.'
            ], 422);
        }

        // Save interaction and load person data
        $interaction = Interaction::create($data)->load('person');

        // Count total likes
        $likesCount = Interaction::where('person_id', $data['person_id'])
            ->where('type', 'like')
            ->count();

        // Send email if likes count exceeds 50
        if ($likesCount > 50) {
            Mail::raw("{$interaction->person->name} has been liked more than 50 times!", function ($msg) {
                $msg->to('admin@tinder.com')->subject('Popularity Alert');
            });
        }

        return new InteractionResource($interaction);
    }

    /**
     * @OA\Get(
     *     path="/api/liked",
     *     summary="List of liked people",
     *     tags={"Interaction"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     )
     * )
    */
    public function liked()
    {
        $likedInteractions = Interaction::where('type', 'like')
            ->with('person')
            ->paginate(10);

        return InteractionResource::collection($likedInteractions);
    }
}
