<?php

namespace App\Modules\Contents\Controller;

use App\Http\Controllers\Controller;
use App\Modules\Contents\Service\ContentService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ContentController extends Controller
{
    private $contentService;
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * @OA\Get(
     *     path="/api/user",
     *     summary="Get logged-in user details",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function getAllTopics()
    {
$sum=   $this->getWeightageSum();
        try {
            $topics = $this->contentService->getAllTopics();
            return response()->json([
                "status" => true,
                "count" => count($topics),
                "data" => $topics,
                "sum"=> $sum
            ]);
        } catch (\Exception $e) {

            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "error" => $e
            ]);
        }

    }
/**
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get logged-in user details",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function getTopicById(Request $request)
    {
        $id=$request->id;
        try {
            $topics = $this->contentService->getTopicById($id);
            return response()->json([
                "status" => true,
                "count" => count($topics),
                "data" => $topics
            ]);
        } catch (\Exception $e) {

            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "error" => $e
            ]);
        }

    }
/**
     * @OA\Get(
     *     path="/api/usered",
     *     summary="Get logged-in user details",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function deleteTopic(Request $request){
        $id=$request->id;
        try {
         $status=  $this->contentService->deleteTopic($id);
         if( $status ) {
            return response()->json([
                "status"=> $status,
                "message"=> "Topic deleted successfully",
             ]);
         } else{
            return response()->json([
                "status"=> false,
                "message"=> "Topic doesn't exist",
             ]);

             }
            }   catch (\Exception $e) {
                return response()->json([
                    "status"=> false,
                    "message"=> $e->getMessage()
                ]);
            }

    }

    public function updateTopic(Request $request, $id){

    }

    public function getWeightageSum(){
     return   $this->contentService->getWeightageSum();
    }


    public function dashboard(Request $request)
    {
        // Assuming the JSON file is stored in the 'json' directory within the storage/app directory
        $filePath = storage_path('samplejson/dashboard.json');

        // Check if the file exists
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Read the JSON file contents
        $jsonContent = file_get_contents($filePath);

        // Decode JSON content
        $data = json_decode($jsonContent, true);

        // Check if JSON decoding was successful
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Failed to parse JSON'], 500);
        }

        // Respond with JSON data
        return response()->json($data);
    }
    public function topicsreport(Request $request)
    {
        // Assuming the JSON file is stored in the 'json' directory within the storage/app directory
        $filePath = storage_path('samplejson/topicsreport.json');

        // Check if the file exists
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Read the JSON file contents
        $jsonContent = file_get_contents($filePath);

        // Decode JSON content
        $data = json_decode($jsonContent, true);

        // Check if JSON decoding was successful
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Failed to parse JSON'], 500);
        }

        // Respond with JSON data
        return response()->json($data);
    }
}