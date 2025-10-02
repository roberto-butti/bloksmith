<?php

use Livewire\Volt\Component;
use Storyblok\ManagementApi\Endpoints\StoryApi;
use Storyblok\ManagementApi\ManagementApiClient;
use Storyblok\ManagementApi\QueryParameters\{AssetsParams,PaginationParams};


new class extends Component {
    public $spaceid;
    public $storyid;




    function findComponents($data, &$componentNames) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if ($key === 'component' && is_string($value)) {
                    if (! in_array($value, $componentNames)) {
                        $componentNames[] = $value;
                    }

                } else {
                    $this->findComponents($value, $componentNames);
                }
            }
        }
    }
    public function with(): array
    {
        $token = config("app.storyblok.mapi_access_token");
        $client = new ManagementApiClient($token);
        $storyApi = new StoryApi($client, $this->spaceid);
        $response = $storyApi->get($this->storyid);


        $componentNames = [];
        //dd($response->data()->toArray());
        $this->findComponents($response->data()->toArray(), $componentNames);

        return [
            'story' => $response->data(),
            'componentNames' => $componentNames


        ];
    }
};
?>

<div>
    <div class=" bg-white shadow-lg rounded-lg p-6 ">
        <x-data-title value="Story" />
        <x-data-item label="ID" :value='$story->id()' />
        <x-data-item label="UUID" :value='$story->uuid()' />
        <x-data-item label="Name" :value='$story->name()' />
        <x-data-item label="Slug" :value='$story->slug()' />
        <x-data-item label="Component" :value='$story->get("content.component")' />
        <x-data-item label="Created At" :value='Carbon\Carbon::parse($story->createdAt())->diffForHumans(). " (" . $story->createdAt() . ")"' />
        <x-data-item label="Updated At" :value='Carbon\Carbon::parse($story->updatedAt())->diffForHumans(). " (" . $story->updatedAt() . ")"' />
        <x-data-item label="Published At" :value='Carbon\Carbon::parse($story->publishedAt())->diffForHumans(). " (" . $story->publishedAt() . ")"' />
        <x-data-item label="Folder/Story" :value='$story->getBoolean("is_folder") ? "Folder": "Story"' />
        <x-data-item label="Workflow ID" :value='$story->get("stage.workflow_id")' />
        <x-data-item label="Stage workflow ID" :value='$story->get("stage.workflow_stage_id")' />
    </div>
    <div class=" bg-white shadow-lg rounded-lg p-6 ">
        <x-data-title value="Components" />
        @foreach ($componentNames as $component)
        {{ $component }} -
        @endforeach
    </div>


    <pre>
    {{ $story->toJson() }}
    </pre>
</div>
