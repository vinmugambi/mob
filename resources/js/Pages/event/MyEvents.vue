<template>
    <app-layout>
        <template #header>
            <div class="mx-auto max-w-6xl">
                <div
                    class="flex flex-col-reverse sm:flex-row justify-between sm:items-center"
                >
                    <h2 class="text-3xl">My events</h2>

                    <a
                        href="/event/create"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition"
                        >Create an event</a
                    >
                </div>
                <p>A list of events you have created</p>
            </div>
        </template>

        <div
            class="pb-4 mx-auto max-w-6xl grid grid-cols-1 sm:grid-cols-2 gap-4"
        >
            <div
                class="grid grid-cols-2 gap-4 rounded-lg overflow-hidden bg-gray-100"
                v-for="event in events"
                :key="`event-${event.id}`"
            >
                <div class="relative">
                    <img
                        :src="'/' + event.image"
                        class="w-full object-cover h-36"
                        :alt="`Cover image of ${event.title}`"
                    />
                    <div
                        class="location absolute text-white bottom-0 left-0 right-0 px-2 text-sm"
                    >
                        <span>{{ event.address }}</span
                        >, &Tab; <span>{{ event.city }}</span>
                    </div>
                </div>
                <div class="flex flex-col pt-2 pb-4">
                    <a
                        :href="`event/${event.id}`"
                        class="text-lg font-semibold hover:underline"
                        >{{ event.title }}</a
                    >

                    <div>
                        <span class="uppercase">{{
                            formatDate(event.start_time)
                        }}</span>
                    </div>

                    <div class="mt-auto">
                        <a
                            class="inline-flex items-center mr-2 px-4 py-1 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition"
                            :href="`event/${event.id}/edit`"
                            >Edit</a
                        >
                        <button
                            type="button"
                            @click="deleteEvent(event.id)"
                            class="inline-flex items-center mt-auto px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-grey-800 uppercase tracking-widest hover:bg-red-200 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { Inertia } from "@inertiajs/inertia";

function formatDate(date) {
    return new Date(date).toLocaleString("en-GB", {
        day: "numeric",
        month: "short",
    });
}

export default {
    components: {
        AppLayout,
    },
    props: ["events"],
    methods: {
        formatDate(date) {
            return formatDate(date);
        },
        deleteEvent(id) {
            Inertia.delete(`/event/${id}`);
        },
    },
};
</script>

<style lang="css" scoped>
.location {
    backdrop-filter: blur(10px);
    background: #00000030;
}
</style>
