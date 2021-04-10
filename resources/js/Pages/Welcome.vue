<template>
    <div v-if="canLogin" class="px-6 py-4 max-w-2xl mx-auto flex justify-between">
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
