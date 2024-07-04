<?php

namespace App\Modules\Contents\Service;

use App\Modules\Contents\Repository\ContentRepository;

class ContentService 
{
    private $contentRepository;
    public function __construct(ContentRepository $contentRepository) {
        $this->contentRepository = $contentRepository;
    }
    public function getAllTopics(): array {
        $topics =[];
        $topics= $this->contentRepository->getAllTopics();
        return $topics;

    }
    
    public function getTopicById(int $id) : array {
        $topics =[];
        $topics= $this->contentRepository->getTopicById($id);
        return $topics;

    }
    public function deleteTopic(int $id) : bool {
        $topics = $this->contentRepository->deleteTopic($id); 
        $this->contentRepository->deleteTopic($id);
        return $topics;
    }

    public function getWeightageSum() : int {
        $topics = $this->contentRepository->getWeightageSum();
        return $topics;
    }

}