<?php

use Livewire\Volt\Component;
use Storyblok\ManagementApi\Endpoints\SpaceApi;
use Storyblok\ManagementApi\Endpoints\StoryApi;
use Storyblok\ManagementApi\Endpoints\UserApi;

use Storyblok\ManagementApi\ManagementApiClient;
use Storyblok\ManagementApi\QueryParameters\{AssetsParams,PaginationParams};


new class extends Component {
    public $spaceid;
    public function with(): array
    {



        $token = config("app.storyblok.mapi_access_token");
        $client = new ManagementApiClient($token);
        $storyApi = new StoryApi($client, $this->spaceid);
        $response = $storyApi->page();
        $stories = $response->data();




        return [
            'stories' => $stories,


        ];
    }
};
?>

<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Story name
            </th>
            <th scope="col" class="px-6 py-3">
                Created at
            </th>
            <th scope="col" class="px-6 py-3">
             Plan
            </th>
            <th scope="col" class="px-6 py-3">
                Owner ID
            </th>
            <th scope="col" class="px-6 py-3">
                Last update
            </th>
            <th scope="col" class="px-6 py-3">
            Space ID
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($stories as $key => $story)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-neutral-100">

            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white ">

                {{ $story->name() }}

            </th>
            <td class="px-6 py-4">
                {{ $story->createdAt() }}
            </td>
            <td class="px-6 py-4">
                {{ $story->slug() }}<br />
                {{ $story->get("full_slug") }}
            </td>
            <td class="px-6 py-4">




            </td>



            <td class="px-6 py-4">
                <a href="{{ route('story', ["storyid" =>$story->id(), "spaceid"=>$spaceid]) }}">{{ $story->id() }}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
