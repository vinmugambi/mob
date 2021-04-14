<template>
    <div class="max-w-2xl py-8 mx-auto px-4">
        <div v-if="canLogin" class="py-4 mx-auto flex justify-between">
            <logo></logo>
            <div>
                <inertia-link
                    v-if="$page.props.user"
                    href="/dashboard"
                    class="text-sm text-gray-700 underline"
                >
                    Events
                </inertia-link>
                <div class="" v-else>
                    <inertia-link
                        :href="route('login')"
                        class="text-sm text-gray-700 underline"
                    >
                        Log in
                    </inertia-link>
                    <inertia-link
                        v-if="canRegister"
                        :href="route('register')"
                        class="ml-4 text-sm text-gray-700 underline"
                    >
                        Register
                    </inertia-link>
                </div>
            </div>
        </div>
        <main class="pt-24">
            <h1 class="text-4xl mb-6">Discover and book amazing events</h1>
            <inertia-link
                v-if="canRegister"
                :href="route('register')"
                class="inline-block px-4 py-2 rounded text-white font-semibold bg-indigo-500 uppercase"
            >
                Get started
            </inertia-link>
        </main>
    </div>
</template>

<script>
import Logo from "../Jetstream/ApplicationLogo.vue";
export default {
    components: { Logo },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
    },
};
</script>
