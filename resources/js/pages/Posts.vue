<script setup lang="ts">
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
    {
        title: 'Posts',
        href: '#',
    },
];

// Dummy post data (replace with props or fetch from backend)
const posts = ref([
    { id: 1, title: 'First Post', content: 'This is the first post.' },
    { id: 2, title: 'Second Post', content: 'This is another post.' },
]);

// Modal control
const showModal = ref(false);

// New post form state
const newPostTitle = ref('');
const newPostContent = ref('');

function openModal() {
    showModal.value = true;
}

function closeModal() {
    showModal.value = false;
    newPostTitle.value = '';
    newPostContent.value = '';
}

function addPost() {
    if (!newPostTitle.value.trim() || !newPostContent.value.trim()) return;

    const newId = posts.value.length + 1;
    posts.value.push({
        id: newId,
        title: newPostTitle.value,
        content: newPostContent.value,
    });

    // Clear form and close modal
    closeModal();
}
</script>

<template>
    <Head title="Posts" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-4">
            
            <!-- Posts List -->
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold">Posts</h2>
                    <button
                        type="button"
                        @click="openModal"
                        class="text-sm px-3 py-1.5 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                    >
                        Add Post
                    </button>
                </div>

                <div v-if="posts.length > 0" class="space-y-4">
                    <div
                        v-for="post in posts"
                        :key="post.id"
                        class="border rounded-md p-4"
                    >
                        <h3 class="text-md font-bold">{{ post.title }}</h3>
                        <p class="text-gray-700">{{ post.content }}</p>
                    </div>
                </div>
                <div v-else class="text-gray-500">
                    No posts available.
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div
            v-if="showModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-700/50"
        >
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Add New Post</h3>
                    <button @click="closeModal" class="text-gray-500 hover:text-gray-700 text-xl">&times;</button>
                </div>

                <form @submit.prevent="addPost" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input
                            v-model="newPostTitle"
                            type="text"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter post title"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea
                            v-model="newPostContent"
                            rows="4"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter post content"
                        ></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button
                            type="button"
                            @click="closeModal"
                            class="px-4 py-2 text-sm bg-gray-200 rounded-md hover:bg-gray-300"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="px-4 py-2 text-sm bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
