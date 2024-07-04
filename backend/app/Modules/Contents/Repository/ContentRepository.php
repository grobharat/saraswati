<?php

namespace App\Modules\Contents\Repository;


use Illuminate\Http\Request;
use App\Models\MasterTopic;


class ContentRepository
{

    public function getAllTopics(bool $status = true): array
    {
        $topics = MasterTopic::where("status", $status)->get();
        return $topics->toArray();

    }

    public function getAllTopicsPaginated(bool $status = true): array
    {
        $topics = MasterTopic::where("status", $status)->paginate(2);
        return $topics->toArray();

    }

    public function getTopicById(int $id): array
    {
        $topics = MasterTopic::where("id", $id)->where('status',1)->get();
        return $topics->toArray();
    }

    public function deleteTopic(int $id): bool
    {
        $topic = MasterTopic::find($id);  
        if(!empty($topic)){

            $topic->delete();
            return true;
        }      
        return false;
        
    }

    public function getWeightageSum(): int
    {
        $weightageSum=0;
        $weightageSum = MasterTopic::sum('weightage');  
        return $weightageSum;
        
    }
}