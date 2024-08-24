<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'

defineProps({
    urls: {
        type: Array
    },
    route_add: {
        type: String
    }
})

const columns = [
    
    { data: 'long_url' },
    { data: 'short_url' }
];

</script>



<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>

        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="p-6 text-gray-900">
                        <div class="grid justify-items-stretch">
                            <div class="justify-self-end">
                                <Link class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                    :href="route_add" as="button" type="button">Add</Link>
                            </div>
                        </div>
                        <DataTable :data="urls" :columns="columns">
                            <thead>
                                <tr>
                                    <th>Long Url</th>
                                    <th>Short Url</th>
                                </tr>
                            </thead>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
