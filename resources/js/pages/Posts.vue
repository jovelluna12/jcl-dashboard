<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/vue3';
import type { AxiosError } from 'axios';
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';

interface Post {
    id: number;
    title: string;
    content: string;
    author: number;
    created_at: string;
    updated_at: string;
}

const page = usePage();
const currentUser = computed(() => page.props.auth.user);
const isBusy = ref(false);

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

const posts = ref<Post[]>([]);

// Modal control
const showModal = ref(false);

// New post form state
const newPostTitle = ref('');
const newPostContent = ref('');
const isLoading = ref(false); // <-- 🔄 Loading state

function openModal() {
    showModal.value = true;
}

function closeModal() {
    showModal.value = false;
    newPostTitle.value = '';
    newPostContent.value = '';
    isLoading.value = false;
}

async function fetchPosts() {
    try {
        const response = await axios.get<{ success: boolean; data: Post[] }>(
            '/all-posts',
        );
        posts.value = response.data.data;
    } catch (error) {
        console.error('Failed to fetch posts:', error);
    }
}

async function addPost() {
    if (!newPostTitle.value.trim() || !newPostContent.value.trim()) return;

    isBusy.value = true;

    try {
        await axios.post('/posts', {
            title: newPostTitle.value,
            content: newPostContent.value,
            author: currentUser.value?.id,
        });

        await fetchPosts();
        closeModal();
    } catch (err) {
        const error = err as AxiosError;

        if (error.response) {
            console.error('Server responded with:', error.response.data);
        } else if (error.request) {
            console.error('No response received:', error.request);
        } else {
            console.error('Error setting up request:', error.message);
        }
    } finally {
        isBusy.value = false;
    }
}

async function deletePost(id: number) {
    isBusy.value = true;
    try {
        await axios.delete('/post/' + id);
        await fetchPosts();
    } catch (err) {
        const error = err as AxiosError;
        if (error.response) {
            console.error('Server responded with:', error.response.data);
        } else if (error.request) {
            console.error('No response received:', error.request);
        } else {
            console.error('Error setting up request:', error.message);
        }
    } finally {
        isBusy.value = false;
    }
}

onMounted(() => {
    fetchPosts();
});
</script>

<template>
    <Head title="Posts" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-4"
        >
            <!-- Posts List -->
            <div class="rounded-lg bg-white p-4 shadow">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold">Posts</h2>
                    <button
                        type="button"
                        @click="openModal"
                        class="rounded-md bg-indigo-600 px-3 py-1.5 text-sm text-white hover:bg-indigo-700"
                    >
                        Add Post
                    </button>
                </div>

                <div v-if="posts.length > 0" class="space-y-4">
                    <div
                        v-for="post in posts"
                        :key="post.id"
                        class="rounded-md border p-4"
                    >
                        <div class="flex flex-row justify-between">
                            <h3 class="text-md font-bold">{{ post.title }}</h3>
                            <button
                                @click="deletePost(post.id)"
                                class="ml-4 text-red-600 hover:text-red-800"
                                aria-label="Delete post"
                                title="Delete post"
                            >
                                <!-- Simple trash icon SVG -->
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
                        </div>
                        <p class="text-gray-700">{{ post.content }}</p>
                    </div>
                </div>
                <div v-else class="text-gray-500">No posts available.</div>
            </div>
        </div>

        <!-- Modal -->
        <div
            v-if="showModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-gray-700/50"
        >
            <div class="mx-4 w-full max-w-md rounded-lg bg-white p-6 shadow-lg">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Add New Post</h3>
                    <button
                        @click="closeModal"
                        class="text-xl text-gray-500 hover:text-gray-700"
                    >
                        &times;
                    </button>
                </div>

                <form @submit.prevent="addPost" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Title</label
                        >
                        <input
                            v-model="newPostTitle"
                            type="text"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Enter post title"
                        />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700"
                            >Content</label
                        >
                        <textarea
                            v-model="newPostContent"
                            rows="4"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Enter post content"
                        ></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button
                            type="button"
                            @click="closeModal"
                            class="rounded-md bg-gray-200 px-4 py-2 text-sm hover:bg-gray-300"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="isLoading"
                            class="rounded-md bg-indigo-600 px-4 py-2 text-sm text-white hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            <span v-if="isLoading">Saving...</span>
                            <span v-else>Save</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Full screen loading overlay -->
        <div
            v-if="isBusy"
            class="fixed inset-0 z-[100] flex items-center justify-center bg-black opacity-[0.9]"
        >
            <svg
                class="h-12 w-12 animate-spin text-white"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
            >
                <circle
                    class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4"
                ></circle>
                <path
                    class="opacity-75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                ></path>
            </svg>
        </div>
    </AppLayout>
</template>
