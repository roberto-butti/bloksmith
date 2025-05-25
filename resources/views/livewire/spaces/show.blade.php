<?php

use Livewire\Volt\Component;
use Storyblok\ManagementApi\Endpoints\SpaceApi;
use Storyblok\ManagementApi\Endpoints\UserApi;
use Symfony\Component\Stopwatch\Stopwatch;
use Storyblok\ManagementApi\ManagementApiClient;
use Storyblok\ManagementApi\QueryParameters\{AssetsParams,PaginationParams};


new class extends Component {
    public $id;

    public function with(): array
    {
        $token = config("app.storyblok.mapi_access_token");
        $client = new ManagementApiClient($token);
        $spaceApi = new SpaceApi($client);
        $response = $spaceApi->get($this->id);




        return [
            'space' => $response->data(),


        ];
    }
};
?>

<div>
    <div class=" bg-white shadow-lg rounded-lg p-6 ">
        <x-data-title value="Space" />
        <x-data-item label="Space id" :value='$space->get("id")' />
        <x-data-item label="Owner id" :value='$space->get("owner.id")' />
        <x-data-item label="Owner" :value='$space->get("owner.friendly_name")' />
        <x-data-item label="Plan" :value='$space->planDescription()' />
        <x-data-item label="Plan Level" :value='$space->get("plan_level")' />
        <x-data-item label="Created at" :value='$space->createdAt()' />
        <x-data-item label="Stories" :value='$space->get("stories_count")' />





    </div>
    <div class=" bg-white shadow-lg rounded-lg p-6">
        <x-data-title value="Collaborators" />
        @forelse($space->get("collaborators") as $key => $collaborator)
        <x-data-item :label='$collaborator->get("user.friendly_name")' :value='$collaborator->get("user.id")' />
        @empty
        No collaborators
        @endforelse
    </div>
    <div class=" bg-white shadow-lg rounded-lg p-6">
        <x-data-title value="Languages" />
        @forelse($space->get("languages") as $key => $language)
        <x-data-item :label='$language->get("code")' :value='$language->get("name")' />


        @empty
        No multi-languages, only default
        @endforelse
    </div>

    <div class=" bg-white shadow-lg rounded-lg p-6">
        <x-data-title value="Roles" />
        @forelse($space->get("space_roles") as $key => $role)

        <x-data-item :label='$role->get("role")' :value='$role->get("id")' />




        @empty
        No Custom roles defined
        @endforelse
    </div>

    <pre>
    {{ $space->toJson() }}
    </pre>
</div>
