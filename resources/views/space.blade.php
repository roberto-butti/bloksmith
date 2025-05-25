<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="p-12   rounded-xl border border-neutral-200 dark:border-neutral-700">
        <flux:heading>Space</flux:heading>
        <flux:text class="mt-2">You can handle space with ID: {{$id}} </flux:text>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">

            <livewire:spaces.show :id="$id" ></livewire:spaces.show>

        </div>
    </div>
</x-layouts.app>
