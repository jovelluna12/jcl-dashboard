<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Users',
        href: '#',
    },
];

// Dummy users data (replace with backend data or props)
const users = ref([
    { id: 1, name: 'Alice Johnson', email: 'alice@example.com' },
    { id: 2, name: 'Bob Smith', email: 'bob@example.com' },
    { id: 3, name: 'Charlie Brown', email: 'charlie@example.com' },
]);
</script>

<template>
    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-md rounded-xl bg-white p-4 shadow"
        >
            <h2 class="mb-4 text-xl font-semibold">Users List</h2>

            <table
                class="min-w-full table-auto border-collapse border border-gray-200"
            >
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">
                            ID
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left">
                            Name
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left">
                            Email
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="user in users"
                        :key="user.id"
                        class="hover:bg-gray-50"
                    >
                        <td class="border border-gray-300 px-4 py-2">
                            {{ user.id }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ user.name }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ user.email }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div
                v-if="users.length === 0"
                class="py-10 text-center text-gray-500"
            >
                No users available.
            </div>
        </div>
    </AppLayout>
</template>
