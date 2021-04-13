<template>
    <app-layout>
        <template #header>
            <div class="mx-auto max-w-6xl">
                <div
                    class="flex flex-col-reverse sm:flex-row justify-between sm:items-center"
                >
                    <h2 class="text-3xl">Discover cool events</h2>
                </div>
            </div>
        </template>

        <div
            class="pb-4 mx-auto max-w-6xl grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-4"
        >
            <a
                :href="`event/${event.id}`"
                class="block pb-4 rounded-lg overflow-hidden hover:bg-gray-100"
                v-for="event in events"
                :key="`event-${event.id}`"
            >
                <div class="relative">
                    <img
                        :src="'/'+event.image"
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
                <div class="px-2">
                    <p class="text-lg font-semibold">{{ event.title }}</p>

                    <div>
                        <span class="uppercase">{{ formatDate(event.start_time) }}</span>
                    </div>
                </div>
            </a>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import {formatDate} from "./../utils.js"

export default {
    components: {
        AppLayout,
        // Link,
    },
    props: ["events"],
    methods: {
        formatDate(date) {return formatDate(date) }
    }
};
</script>

<style lang="css" scoped>
.location {
    backdrop-filter: blur(10px);
    background: #00000030;
}
</style>
