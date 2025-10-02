<?php

use Livewire\Volt\Component;
use Storyblok\ManagementApi\Endpoints\SpaceApi;
use Storyblok\ManagementApi\Endpoints\UserApi;
use Symfony\Component\Stopwatch\Stopwatch;
use Storyblok\ManagementApi\ManagementApiClient;
use Storyblok\ManagementApi\QueryParameters\{AssetsParams,PaginationParams};


new class extends Component {
    public $spaceid= '';
    public $status='';
    public function mount()
    {
        $this->status = "on Mount";
        $this->spaceid  = "";
    }
    public function hydrate()
    {
        $this->status = "on hydrate";
    }
    public function gotospace()
    {
        $this->validate([
            'spaceid' => 'required|min:5|numeric' // adjust rules as needed
        ]);

        return redirect()->to(route("space", $this->spaceid));
    }

};
?>



<flux:field>
    <flux:label>Space ID</flux:label>
    <flux:input wire:keydown.enter="gotospace" autofocus size="xl" placeholder="The Space ID" wire:model="spaceid" type="text" />
    <flux:error name="spaceid" />
    --{{ $status }}--
    <flux:button  wire:click="gotospace">Base</flux:button>
</flux:field>
