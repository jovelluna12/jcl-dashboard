<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'User Management',
        href: '#',
    },
];

interface User {
    id: number;
    name: string;
    email: string;
    role: string;
}

const page = usePage();
const currentUser = computed(() => page.props.auth.user);
const users = computed(() => page.props.users as User[]);

</script>

<template>
    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl bg-white p-4 shadow">
            <h2 class="mb-4 text-xl font-semibold">User Management</h2>

            <table
                v-if="users && users.length"
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
                            Role
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left">
                            Email
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left">
                            Action
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
                            {{ user.role }}
                        </td>

                        <td class="border border-gray-300 px-4 py-2">
                            {{ user.email }}
                        </td>

                        <td class="border border-gray-300 px-4 py-2">
                        </td>
                    </tr>
                </tbody>
            </table>

            <div
                v-else
                class="py-10 text-center text-gray-500">
                No users available.
            </div>
        </div>
    </AppLayout>
</template>