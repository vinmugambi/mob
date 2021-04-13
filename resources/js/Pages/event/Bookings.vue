<template>
    <app-layout>
        <template #header>
            <div class="mx-auto max-w-6xl">
                <h2 class="text-3xl">Events you have booked</h2>
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
                        class="w-full object-cover"
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
                        <span class="uppercase">{{ event.start_time }}</span>
                    </div>

                    <div class="mt-auto">
                        <button
                            type="button"
                            @click="cancel(event.booking_id)"
                            class="inline-flex items-center mt-auto px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-grey-800 uppercase tracking-widest hover:bg-red-200 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition"
                        >
                            Cancel this booking
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

export default {
    props: ["events"],
    components: { AppLayout },
    methods: {
        cancel(id) {
            Inertia.delete(`/booking/${id}`);
        },
    },
};
</script>
