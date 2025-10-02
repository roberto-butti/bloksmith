<x-layouts.app :title="__('Story')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="p-12   rounded-xl border border-neutral-200 dark:border-neutral-700">
        <flux:heading>Space</flux:heading>
        <flux:text class="mt-2">You can handle Story with ID: {{ $storyid }} in the space id {{ $spaceid }} </flux:text>
        <flux:button.group>
            <flux:button
                href="https://app.storyblok.com/#/me/spaces/{{$spaceid}}/stories/0/0/{{$storyid}}"
                icon:trailing="arrow-up-right"
            >Edit on Storyblok</flux:button>

            <flux:button>Assets</flux:button>
        </flux:button.group>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

            <livewire:stories.show :spaceid="$spaceid" :storyid="$storyid" ></livewire:stories.show>

        </div>
    </div>

</x-layouts.app>
