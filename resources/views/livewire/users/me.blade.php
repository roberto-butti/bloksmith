<?php

use Illuminate\Contracts\Container\BindingResolutionException;
use Livewire\Volt\Component;

use Storyblok\ManagementApi\ManagementApiClient;
use Storyblok\ManagementApi\Endpoints\UserApi;

use Storyblok\ManagementApi\QueryParameters\{AssetsParams,PaginationParams};


new class extends Component {
    /**
     * @return array
     * @throws BindingResolutionException
     */
    public function with(): array
    {
        $token = config("app.storyblok.mapi_access_token");
        $client = new ManagementApiClient($token);
        $userApi = new UserApi($client);
        $response = $userApi->me();
        if ($response->getResponseStatusCode() === 401) {
            return [
                'error' => "Not authetnicated"
            ];
        }
        $user = $response->data();
        return [
            'user' => $user,
            'error' =>false
        ];
    }
};
?>


<div class=" p-4">

    @if ($error)
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
    <x-data-title value="API call failed due to an invalid access token." />
    Please ensure your application is using a valid access token.
    Check the .env file and verify the value of the APP_STORYBLOK_MAPI_ACCESS_TOKEN parameter.

    For more details on how to obtain and use a Personal Access Token, see the Storyblok documentation:<br/>
    <a href="https://www.storyblok.com/docs/api/management/getting-started/authentication">🔗 Storyblok Authentication Guide</a>
    </div>
    @else
        <x-data-title value="Storyblok User" />
        <x-data-item label="ID" :value='$user->id()' />
        <x-data-item label="User ID" :value='$user->userId()' />
        <x-data-item label="Email" :value='$user->email()' />
        <x-data-item label="User name" :value='$user->username()' />
        <x-data-item label="Created At" :value='$user->createdAt("F j, Y")' />
        <x-data-item label="Has Partner" :value='$user->hasPartner() ? "✅" : "🚫"' />
        <x-data-item label="Has Organization" :value='$user->hasOrganization() ? "✅" : "🚫"' />
        <x-data-item label="User" :value='$user->get("friendly_name")' />
        <x-data-item label="Org" :value='$user->orgName()' />
    @endif
</div>
