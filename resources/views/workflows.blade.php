<x-layouts.app :title="__('Workflows')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="p-12   rounded-xl border border-neutral-200 dark:border-neutral-700">

<flux:heading>Workflows</flux:heading>
<flux:text class="mt-2">You can handle Workflows for the space {{$id}}.</flux:text>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <livewire:workflows.table :spaceid="$id" ></livewire:workflows.table>

        </div>
    </div>
</x-layouts.app>
