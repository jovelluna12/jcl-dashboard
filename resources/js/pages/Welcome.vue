<script setup lang="ts">
import { dashboard, login, register } from '@/routes';
import { Head, Link } from '@inertiajs/vue3';

const features = [
    {
        icon: '🔐',
        title: 'Authentication',
        description: 'Secure API authentication powered by Laravel Sanctum.',
    },
    {
        icon: '📝',
        title: 'Post Management',
        description: 'Create, edit, organize, and publish content through an intuitive dashboard.',
    },
    {
        icon: '🔗',
        title: 'API First',
        description: 'Expose your content through a clean RESTful API for any frontend.',
    },
];

const techStack = [
    'Laravel 13+',
    'Vue 3',
    'Inertia.js',
    'TypeScript',
    'Tailwind CSS',
    'Sanctum',
    'REST API',
    'MySQL',
];
</script>

<template>
    <Head title="JCL Dashboard">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div class="min-h-screen bg-white text-slate-900">
        <!-- Header -->
        <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/90 backdrop-blur">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 font-bold text-white"
                    >
                        J
                    </div>

                    <div>
                        <h1 class="text-lg font-bold">JCL Dashboard</h1>
                        <p class="text-xs text-slate-500">Laravel Headless CMS</p>
                    </div>
                </div>

                <nav class="flex items-center gap-3">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="rounded-lg bg-indigo-600 px-5 py-2 text-sm font-medium text-white transition hover:bg-indigo-700"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="login()"
                            class="rounded-lg px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100"
                        >
                            Login
                        </Link>

                        <Link
                            :href="register()"
                            class="rounded-lg bg-indigo-600 px-5 py-2 text-sm font-medium text-white transition hover:bg-indigo-700"
                        >
                            Register
                        </Link>
                    </template>
                </nav>
            </div>
        </header>

        <main>
            <!-- Hero -->
            <section class="mx-auto max-w-7xl px-6 py-24">
                <div class="mx-auto max-w-4xl text-center">
                    <span
                        class="inline-flex rounded-full bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-700"
                    >
                        🚀 Laravel Headless CMS
                    </span>

                    <h2
                        class="mt-8 text-5xl font-extrabold tracking-tight text-slate-900 lg:text-7xl"
                    >
                        Build Once.
                        <br />
                        <span class="text-indigo-600">
                            Deliver Content Everywhere.
                        </span>
                    </h2>

                    <p
                        class="mx-auto mt-8 max-w-2xl text-lg leading-8 text-slate-600"
                    >
                        JCL Dashboard is a modular Headless CMS built with Laravel.
                        Manage content from a beautiful administration dashboard and
                        expose everything through a secure RESTful API for websites,
                        mobile applications, and third-party services.
                    </p>

                    <div class="mt-10 flex flex-wrap justify-center gap-4">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="dashboard()"
                            class="rounded-xl bg-indigo-600 px-8 py-4 font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                        >
                            Open Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="register()"
                                class="rounded-xl bg-indigo-600 px-8 py-4 font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                            >
                                Get Started
                            </Link>

                            <Link
                                :href="login()"
                                class="rounded-xl border border-slate-300 bg-white px-8 py-4 font-semibold text-slate-700 transition hover:bg-slate-50"
                            >
                                Login
                            </Link>
                        </template>
                    </div>
                </div>
            </section>

            <!-- Features -->
            <section class="border-y border-slate-200 bg-slate-50 py-20">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="text-center">
                        <h3 class="text-3xl font-bold text-slate-900">
                            Everything You Need
                        </h3>

                        <p class="mt-3 text-slate-600">
                            Built for developers who want a clean and scalable
                            content management solution.
                        </p>
                    </div>

                    <div class="mt-12 grid gap-6 md:grid-cols-3">
                        <div
                            v-for="feature in features"
                            :key="feature.title"
                            class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-lg"
                        >
                            <div class="text-4xl">
                                {{ feature.icon }}
                            </div>

                            <h4 class="mt-5 text-xl font-semibold">
                                {{ feature.title }}
                            </h4>

                            <p class="mt-3 leading-7 text-slate-600">
                                {{ feature.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Tech Stack -->
            <section class="py-20">
                <div class="mx-auto max-w-7xl px-6">
                    <div
                        class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm"
                    >
                        <div class="grid lg:grid-cols-2">
                            <div class="p-10 lg:p-14">
                                <h3 class="text-3xl font-bold">
                                    Built with Modern Technologies
                                </h3>

                                <p class="mt-4 leading-8 text-slate-600">
                                    JCL Dashboard follows an API-first architecture
                                    powered by Laravel, making it easy
                                    to integrate with web, mobile, or any
                                    frontend stack.
                                </p>

                                <div class="mt-8 flex flex-wrap gap-3">
                                    <span
                                        v-for="tech in techStack"
                                        :key="tech"
                                        class="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-700"
                                    >
                                        {{ tech }}
                                    </span>
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-center bg-gradient-to-br from-indigo-50 to-white p-10"
                            >
                                <div
                                    class="w-full max-w-sm rounded-2xl border border-slate-200 bg-white p-8 shadow-lg"
                                >
                                    <div
                                        class="mb-6 flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-600 text-2xl text-white"
                                    >
                                        🚀
                                    </div>

                                    <h4 class="text-xl font-bold">
                                        API-first Development
                                    </h4>

                                    <p class="mt-3 text-slate-600">
                                        Manage content from one place while serving
                                        multiple frontend applications with a clean
                                        RESTful API.
                                    </p>

                                    <div class="mt-8 space-y-3">
                                        <div class="flex items-center gap-3">
                                            <span class="text-green-600">✓</span>
                                            Laravel 13+
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <span class="text-green-600">✓</span>
                                            Sanctum Authentication
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <span class="text-green-600">✓</span>
                                            RESTful API
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <span class="text-green-600">✓</span>
                                            Modular CMS
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <section class="bg-slate-50 py-20">
                <div class="mx-auto max-w-3xl px-6 text-center">
                    <h3 class="text-4xl font-bold">
                        Ready to manage your content?
                    </h3>

                    <p class="mt-4 text-lg leading-8 text-slate-600">
                        Start building modern applications with a centralized
                        content management system powered by Laravel.
                    </p>

                    <div class="mt-8">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="dashboard()"
                            class="inline-flex rounded-xl bg-indigo-600 px-8 py-4 font-semibold text-white transition hover:bg-indigo-700"
                        >
                            Go to Dashboard
                        </Link>

                        <Link
                            v-else
                            :href="register()"
                            class="inline-flex rounded-xl bg-indigo-600 px-8 py-4 font-semibold text-white transition hover:bg-indigo-700"
                        >
                            Create an Account
                        </Link>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-slate-200 bg-white">
            <div
                class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-6 py-8 text-sm text-slate-500 md:flex-row"
            >
                <p>© {{ new Date().getFullYear() }} JCL Dashboard</p>

                <p>Built with Laravel • Vue • Inertia.js</p>
            </div>
        </footer>
    </div>
</template>