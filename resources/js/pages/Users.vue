<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import { Head, router, usePage } from '@inertiajs/vue3';
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
    role: any;
}

const page = usePage();
const currentUser = computed(() => page.props.auth.user);
const users = computed(() => page.props.users as User[]);

function deleteUser(id: number) {
    router.delete(`/users/${id}`);
}

</script>

<template>
    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl bg-white p-4 shadow dark:bg-gray-900">
            <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-gray-100">User Management</h2>


            <table
                v-if="users && users.length"
                class="min-w-full table-auto border-collapse border border-gray-200 dark:border-gray-700"
            >

                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-800">
                        <th class="border border-gray-300 px-4 py-2 text-left dark:border-gray-700 dark:text-gray-200">

                            ID
                        </th>
                        <th class="border border-gray-300 px-4 py-2 text-left dark:border-gray-700 dark:text-gray-200">
                            Name
                        </th>

                        <th class="border border-gray-300 px-4 py-2 text-left dark:border-gray-700 dark:text-gray-200">
                            Role
                        </th>

                        <th class="border border-gray-300 px-4 py-2 text-left dark:border-gray-700 dark:text-gray-200">
                            Email
                        </th>

                        <th class="border border-gray-300 px-4 py-2 text-left dark:border-gray-700 dark:text-gray-200">
                            Action
                        </th>

                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="user in users"
                        :key="user.id"
                        class="hover:bg-gray-50 dark:hover:bg-gray-800"
                    >

                        <td class="border border-gray-300 px-4 py-2 dark:border-gray-700 dark:text-gray-100">
                            {{ user.id }}
                        </td>


                        <td class="border border-gray-300 px-4 py-2 dark:border-gray-700 dark:text-gray-100">
                            {{ user.name }}
                        </td>


                        <td class="border border-gray-300 px-4 py-2 dark:border-gray-700 dark:text-gray-100">
                            {{ user.role.name }}
                        </td>


                        <td class="border border-gray-300 px-4 py-2 dark:border-gray-700 dark:text-gray-100">
                            {{ user.email }}
                        </td>

                        <td class="border border-gray-300 px-4 py-2 dark:border-gray-700 dark:text-gray-100">
                            <button
                                    v-if="user.id !== currentUser.id"
                                    @click="deleteUser(user.id)"
                                    class="rounded-md p-1.5 text-red-600 hover:bg-red-50 hover:text-red-800 dark:hover:bg-red-900/30"
                                    aria-label="Delete user"
                                    title="Delete user"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4"
                                        />
                                    </svg>
                                </button>
                        </td>

                    </tr>
                </tbody>
            </table>

            <div
                v-else
                class="py-10 text-center text-gray-500 dark:text-gray-400">

                No users available.
            </div>
        </div>
    </AppLayout>
</template>