<?php

use Livewire\Volt\Component;
use Storyblok\ManagementApi\Endpoints\SpaceApi;
use Storyblok\ManagementApi\Endpoints\UserApi;
use Symfony\Component\Stopwatch\Stopwatch;
use Storyblok\ManagementApi\ManagementApiClient;
use Storyblok\ManagementApi\QueryParameters\{AssetsParams,PaginationParams};


new class extends Component {
    public function with(): array
    {
        $seconds = 60*5;

        $user = cache()->remember('user', $seconds, function () {
        $token = config("app.storyblok.mapi_access_token");
        $client = new ManagementApiClient($token);
        $userApi = new UserApi($client);
        $response = $userApi->me();
        return $response->data();
        });

        $spaces =  cache()->remember('spaces', $seconds, function () {
            $token = config("app.storyblok.mapi_access_token");
            $client = new ManagementApiClient($token);
            $spaceApi = new SpaceApi($client);
            $response = $spaceApi->all();
            return $response->data();
        });


        return [
            'spaces' => $spaces,
            'user' => $user,

        ];
    }
};
?>

<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Space name
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
        @foreach($spaces as $key => $space)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-neutral-100">

            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white ">

                {{ $space->name() }}
            </th>
            <td class="px-6 py-4">
                {{ $space->createdAt() }}
            </td>
            <td class="px-6 py-4">
                {{ $space->planDescription() }}
            </td>
            <td class="px-6 py-4">
                {{ $space->get("owner_id") }}
                @if ($user->get("id") === $space->get("owner_id"))
                ✅
                @endif
                {{ $space->toJson() }}


            </td>
            <td class="px-6 py-4">
                {{
                Carbon\Carbon::createFromFormat("Y-m-d",
                $space->getFormattedDateTime('updated_at', "", format: "Y-m-d")
                )->diffForHumans()
                 }}<p class="text-xs">{{ $space->getFormattedDateTime('updated_at', "", format: "Y-m-d") }}</p>

            </td>


            <td class="px-6 py-4">
                <a href="{{ route('space', $space->get("id")) }}">{{ $space->get("id") }}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
