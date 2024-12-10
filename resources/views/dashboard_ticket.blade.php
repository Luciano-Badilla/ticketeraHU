<style>
    a {
        text-decoration: none !important;
    }
</style>

<script src="https://cdn.tailwindcss.com"></script>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="sm:rounded-xl bg-white shadow-sm w-auto ">
                <x-status-alert :status="'success'"></x-status-alert>
                <div class="p-2">
                    <div class="mx-auto">
                        <div class="space-y-4">
                            <div class="flex flex-wrap gap-4">
                                @foreach ($dashboard_tickets as $dashboard_ticket)
                                    <x-a-ticket :dashboard_ticket="$dashboard_ticket"></x-a-ticket>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
