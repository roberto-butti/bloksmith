<?php

use Livewire\Volt\Component;

use Storyblok\ManagementApi\Endpoints\WorkflowApi;
use Storyblok\ManagementApi\Endpoints\WorkflowStageApi;
use Storyblok\ManagementApi\ManagementApiClient;
use Storyblok\ManagementApi\QueryParameters\{AssetsParams,PaginationParams};


new class extends Component {
    public $spaceid;
    public function with(): array
    {



        $token = config("app.storyblok.mapi_access_token");
        $client = new ManagementApiClient($token);
        $workflowApi = new WorkflowApi($client, $this->spaceid);
        $response = $workflowApi->list();
        $workflows = $response->data();

        $workflowStageApi = new WorkflowStageApi($client, $this->spaceid);
        $response = $workflowStageApi->list();
        $workflowStages = $response->data();




        return [
            'workflows' => $workflows,
            'workflowStages' => $workflowStages,


        ];
    }
};
?>

<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Workflow name
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
            {{ $workflowStages->toJson()}}
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($workflows as $key => $workflow)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-neutral-100">

            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white ">

                {{ $workflow->name() }}

            </th>
            <td class="px-6 py-4">

            </td>
            <td class="px-6 py-4">
                {{ $workflow->id() }}

            </td>
            <td class="px-6 py-4">




            </td>



            <td class="px-6 py-4">
                <a href="{{ route('story', ["storyid" =>$workflow->id(), "spaceid"=>$spaceid]) }}">{{ $workflow->toJson() }}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
